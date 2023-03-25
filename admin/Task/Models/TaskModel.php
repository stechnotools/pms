<?php

namespace Admin\Task\Models;

use Admin\Users\Models\UserModel;
use CodeIgniter\Model;

class TaskModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tasks';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDelete        = true;
	protected $protectFields        = false;
	protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		'name' => [
			'label' => 'Name', 
			'rules' => 'trim|required|max_length[100]'
		]
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = ['sortOrder'];
	protected $afterInsert          = ['addHistory','generateSlug'];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = ['addHistory'];
	protected $beforeFind           = [];
	protected $afterFind            = ['format','addMeta'];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public $priorities = [
	    '' => [
	        'text' => 'Not set',
	        'class' => 'bg-secondary',
        ],
        'low' => [
	        'text' => 'Low',
	        'class' => 'bg-success',
        ],
        'medium' => [
	        'text' => 'Medium',
	        'class' => 'bg-warning',
        ],
        'high' => [
	        'text' => 'High',
	        'class' => 'bg-danger',
        ],
    ];

    public function format($result) {

        if($result['singleton']){
            $this->_dateFormat($result['data']);
            $this->_priority($result['data']);
            $this->_addMeta($result['data']);
        } else {
            foreach ($result['data'] as $obj) {
                $this->_dateFormat($obj);
                $this->_priority($obj);
                $this->_addMeta($obj);
            }
        }

        return $result;
	}

    public function sortOrder($result) {

        $task = $this->db->query("SELECT MAX(sort_order) max_sort_order FROM ".$this->db->prefixTable($this->table)." WHERE user_id=".$result['data']['user_id'])->getFirstRow();

        $sort_order = (int)($task->max_sort_order+1);
        $result['data']['sort_order'] = $sort_order;
        return $result;
	}

    public function generateSlug($result) {
        $id = sprintf("%04s",$result['id']);
        $slug = 'tsk-'.strtolower(date('M')).'-'.date('y').'-'.$id;
        $this->update($result['id'],[
            'slug' => $slug
        ]);
        $result['data']['slug'] = $slug;
        return $result;
	}

	private function _dateFormat(&$obj){

        if(is_array($obj)) {
            $obj['created_at'] = ymdToEng($obj['created_at']);
            $obj['due_date_text'] = $obj['due_date'] ? ymdToEng($obj['due_date']) : '';
            $obj['finish_date'] = $obj['finish_date'] ? ymdToEng($obj['finish_date']) : '';
            $obj['start_date'] = $obj['start_date'] ? ymdToEng($obj['start_date']) : '';
            $obj['updated_at'] = ymdToEng($obj['updated_at']);
        } else {
            $obj->created_at = ymdToEng($obj->created_at);
            $obj->due_date_text = $obj->due_date ? ymdToEng($obj->due_date) : '';
            $obj->finish_date = $obj->finish_date ? ymdToEng($obj->finish_date) : '';
            $obj->start_date = $obj->start_date ? ymdToEng($obj->start_date) : '';
            $obj->updated_at = ymdToEng($obj->updated_at);
        }
    }

	private function _priority(&$obj){
        if(is_array($obj)) {
            $obj['priority_class']= $this->priorities[$obj['priority']]['class'];
            $obj['priority_text']= $this->priorities[$obj['priority']]['text'];
        } else {
            $obj->priority_class = $this->priorities[$obj->priority]['class'];
            $obj->priority_text = $this->priorities[$obj->priority]['text'];
        }
    }

	private function _addMeta(&$obj){
	    if(is_array($obj)){
            $obj['task_id'] = $obj['id'];
            $obj['task_title'] = $obj['title'];
            $obj['total_comments'] = (new TaskCommentModel())->where('task_id',$obj['task_id'])->countAllResults();
            $user = (new UserModel())->where('id',$obj['user_id'])->first();
            $obj['user_initials'] = initialName($user->firstname.' '.$user->lastname);
            $obj['task_user'] = $user->firstname.' '.$user->lastname;
            $obj['user_image'] = $user->image;
            $users = (new TaskUserModel())->where('task_id',$obj['task_id'])->countAllResults();
            $obj['task_users'] = $users;
            $status = $this->getStatus($obj['status_id']);
            $obj['status_text'] = $status->title;
        } else {
            $obj->task_id = $obj->id;
            $obj->task_title = $obj->title;
            $obj->total_comments = (new TaskCommentModel())->where('task_id',$obj->task_id)->countAllResults();
            $user = (new UserModel())->where('id',$obj->user_id)->first();
            $obj->user_initials = initialName($user->firstname.' '.$user->lastname);
            $obj->task_user = $user->firstname.' '.$user->lastname;
            $obj->user_image = $user->image;
            $users = (new TaskUserModel())->where('task_id',$obj->task_id)->countAllResults();
            $obj->task_users = $users;
            $status = $this->getStatus($obj->status_id);
            $obj->status_text = $status->title;
        }
    }

    //add history
    public function addHistory($param) {
        return $param;
    }

    public function addMeta($result) {
        if($result['singleton']){

        } else {
            foreach ($result['data'] as $obj) {

            }
        }

        return $result;
    }

    public function getTasks($filter = []) {
        $sql = "SELECT
  pt.id task_id,
  pt.status_id,
  pt.title task_title,
  pt.slug,
  COALESCE(cmt.total,0) total_comments,
  pt.created_at,
  pt.updated_at,
  pt.start_date,
  pt.due_date,
  pt.finish_date,
  pt.project_id,
  pt.description,
  pt.priority,
  pt.duration,
  pt.color task_color,
  pt.user_id,
  CONCAT(pu.firstname, ' ', pu.lastname) task_user,
  COALESCE(tusers.total,0) task_users,
  pu.image user_image,
  pt.thematic_id,
  pt.image,
  pt.parent_id,
  pt.tag,
  subtask.total subtasks,
  ptu.user_id assigned_user
FROM pms_tasks pt LEFT JOIN pms_task_users ptu ON pt.id = ptu.task_id
    LEFT JOIN (SELECT
      ptc.task_id,
      COUNT(id) total
    FROM pms_task_comments ptc
    GROUP BY ptc.task_id) cmt
    ON cmt.task_id = pt.id
  LEFT JOIN pms_user pu
    ON pt.user_id = pu.id
  LEFT JOIN (SELECT
      pt.id task_id,
      COUNT(ptc.id) total
    FROM pms_tasks pt
      LEFT JOIN pms_task_checklists ptc
        ON pt.id = ptc.task_id
    WHERE ptc.deleted_at IS NULL) subtask
    ON subtask.task_id = pt.id
     LEFT JOIN (SELECT ptu.task_id,COUNT(ptu.id) total
     FROM pms_task_users ptu GROUP BY ptu.task_id) 
     tusers ON tusers.task_id=pt.id
WHERE pt.deleted_at IS NULL
AND pt.parent_id = 0";
        if(!empty($filter['user_id'])){
            $sql .= " AND pt.user_id=".$filter['user_id']." OR ptu.user_id=".$filter['user_id'];
        }
        if(!empty($filter['project_id'])){
            $sql .= " AND pt.project_id=".$filter['project_id'];
        }
        $sql .= " GROUP BY task_id";
        $sql .= " ORDER BY pt.sort_order";

        $tasks = $this->db->query($sql)->getResult();

        foreach ($tasks as &$task) {
            $this->_priority($task);
            $this->_dateFormat($task);
            $task->user_initials = initialName($task->task_user);
        }

        return $tasks;
    }

    public function getStatus($id) {
        return $this->db->table('task_statuses')->where(['id'=>$id])->get()->getRow();
    }

    public function getStatuses() {
        return $this->db->table('task_statuses')->get()->getResult();
    }
}
