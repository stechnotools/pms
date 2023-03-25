<?php

namespace Admin\Task\Models;

use CodeIgniter\Model;

class TaskCommentModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'task_comments';
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
	protected $updatedField         = '';
	protected $deletedField         = 'deleted_at';

	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = ['dateFormat'];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

    public function dateFormat($result) {

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
        $obj->created_at = ymdToEng($obj->created_at);
        $obj->updated_at = ymdToEng($obj->updated_at);
    }

    public function getComment($id=0) {
        $sql = "SELECT
  ptc.id comment_id,
  ptc.comment,
  ptc.user_id,
  pu.username,
  pu.firstname,
  pu.lastname,
  pu.email,
  pu.image,
  pu.color,
  ptc.created_at
FROM pms_task_comments ptc
  LEFT JOIN pms_user pu
    ON ptc.user_id = pu.id
WHERE ptc.deleted_at IS NULL AND ptc.id=".$id;

        return $this->db->query($sql)->getFirstRow();
    }

    public function getComments($filter=[]) {
        $sql = "SELECT
  ptc.id comment_id,
  ptc.comment,
  ptc.user_id,
  pu.username,
  pu.firstname,
  pu.lastname,
  pu.email,
  pu.image,
  pu.color,
  ptc.created_at
FROM pms_task_comments ptc
  LEFT JOIN pms_user pu
    ON ptc.user_id = pu.id
WHERE ptc.deleted_at IS NULL";

        if(!empty($filter['user_id'])){
            $sql .= " AND user_id = ".$filter['user_id'];
        }
        if(!empty($filter['task_id'])){
            $sql .= " AND task_id = ".$filter['task_id'];
        }

        return $this->db->query($sql)->getResult();
    }
}
