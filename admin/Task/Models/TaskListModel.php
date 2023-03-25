<?php

namespace Admin\Task\Models;

use CodeIgniter\Model;

class TaskListModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'task_statuses';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDelete        = false;
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
		'title' => [
			'label' => 'Title',
			'rules' => 'trim|required|max_length[100]'
		]
	];
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
}
