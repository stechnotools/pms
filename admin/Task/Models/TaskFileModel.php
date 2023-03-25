<?php

namespace Admin\Task\Models;

use CodeIgniter\Model;

class TaskFileModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'task_files';
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
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public $icons = [
        'jpg' => 'ri-image-line',
        'png' => 'ri-image-line',
        'doc' => 'ri-file-word-2-line',
        'docx' => 'ri-file-word-2-line',
        'xls' => 'ri-file-word-2-line',
        'xlsx' => 'ri-file-excel-2-line',
        'ppt' => 'ri-file-ppt-2-line',
        'pptx' => 'ri-file-ppt-2-line',
        'other' => 'ri-attachment-2'
    ];
}
