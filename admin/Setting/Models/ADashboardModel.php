<?php
/**
 * AIO ADMIN
 *
 * @author      Niranjan
 * @copyright   Copyright (c) 2012
 * @license     MIT License
 * @link        http://aioadmin.com
 */
namespace Admin\Setting\Models;
use CodeIgniter\Model;

class ADashboardModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'dashboard_report';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = false;
    protected $protectFields        = false;
    //protected $allowedFields        = [];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name' => array(
            'label' => 'Route',
            'rules' => 'trim|required'
        ),
        'col' => array(
            'label' => 'Width',
            'rules' => "trim|required"
        ),

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
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];


	public function editADashboard($module, $data) {
        $builder=$this->db->table("{$this->table}");
        $builder->where("module",$module);
	    $builder->delete();

		foreach ($data as $key => $value) {
			//echo substr($key, 0, strlen($module));
			if (substr($key, 0, strlen($module)) == $module) {
				
				if (!is_array($value)) {
					$builder->insert(array("key"=>$key,"value"=>$value,"module"=>$module));
				} else {
                    $builder->insert(array("key"=>$key,"value"=>json_encode(array_values($value), true),"module"=>$module,"serialized"=>1));
				}
			}
		}
		//exit;	
	}
    public function getADashboardReports($dashboard=1) {
        $builder=$this->db->table("dashboard_report");

        //$builder->where("status",1);
        $builder->where("dashboard",$dashboard);

        $res=$builder->get()->getResult();
        return $res;
    }
    public function saveADashboard($id,$data){
        $builder=$this->db->table("dashboard_report");
        $builder->where("id",$id);
        $builder->update($data);
    }
}
