<?php
namespace Admin\project\Models;
use CodeIgniter\Model;

class projectModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'projects';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDeletes        = true;
	protected $protectFields        = false;
//	protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
        'name' => array(
            'label' => 'Name',
            'rules' => 'trim|required|max_length[100]'
        )
    ];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
    protected $beforeInsert         = ['dateFormat'];
	protected $afterInsert          = [];
	protected $beforeUpdate         = ['dateFormat'];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = ['format'];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

    public function getAll($data=[]) {
        $builder=$this->db->table("{$this->table} p");
        $this->filter($builder,$data);

        $builder->select("p.*");

        if (isset($data['sort']) && $data['sort']) {
            $sort = $data['sort'];
        } else {
            $sort = "p.name";
        }

        if (isset($data['order']) && ($data['order'] == 'desc')) {
            $order = "desc";
        } else {
            $order = "asc";
        }
        $builder->orderBy($sort, $order);

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 10;
            }
            $builder->limit((int)$data['limit'],(int)$data['start']);
        }
        //$builder->where($this->deletedField, null);

        $res = $builder->get()->getResult();

        return $res;
    }

    public function getTotal($data=[]) {
        $builder=$this->db->table("{$this->table} p");
        $this->filter($builder,$data);
        $count = $builder->countAllResults();
        return $count;

    }

    private function filter($builder,$data){

        if (!empty($data['filter_search'])) {
            $builder->where("p.name LIKE '%{$data['filter_search']}%'");
        }
    }

    public function getProjectUser($projct_id){
        $sql="SELECT
        pu.*
      FROM pms_task_users ptu
        LEFT JOIN pms_tasks pt
          ON ptu.task_id = pt.id
        LEFT JOIN pms_projects pp
          ON pt.project_id = pp.id
        LEFT JOIN pms_user pu
          ON ptu.user_id = pu.id
      WHERE pt.project_id = $projct_id";
      return $this->db->query($sql)->getResult();
    }

    public function getProjectComments($projct_id){
        $sql="SELECT
        pu.*
      FROM pms_task_users ptu
        LEFT JOIN pms_tasks pt
          ON ptu.task_id = pt.id
        LEFT JOIN pms_projects pp
          ON pt.project_id = pp.id
        LEFT JOIN pms_user pu
          ON ptu.user_id = pu.id
      WHERE pt.project_id = $projct_id";
      return $this->db->query($sql)->getResult();
    }


    public function dateFormat(array $data){
        $data['data']['start_date']=date('Y-m-d',strtotime($data['data']['start_date']));
        $data['data']['end_date']=date('Y-m-d',strtotime($data['data']['end_date']));
        return $data;
    }

    public function format($result){
        if($result['singleton']){
            $this->_dateFormat($result['data']);
        } else {
            foreach ($result['data'] as $obj) {
                $this->_dateFormat($obj);
            }
        }
        return $result;
    }

    private function _dateFormat(&$obj){
        if(is_array($obj)) {
            $obj['end_date'] = $obj['end_date'] ? ymdToDmy($obj['end_date']) : '';
            $obj['start_date'] = $obj['start_date'] ? ymdToDmy($obj['start_date']) : '';
        } else {
            $obj->end_date = $obj->end_date ? ymdToDmy($obj->end_date) : '';
            $obj->start_date = $obj->start_date ? ymdToDmy($obj->start_date) : '';
        }
    }
}
