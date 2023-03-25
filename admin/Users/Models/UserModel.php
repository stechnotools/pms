<?php
namespace Admin\Users\Models;

use Admin\Localisation\Models\BlockModel;
use Admin\Localisation\Models\DistrictModel;
use Admin\Localisation\Models\GrampanchayatModel;
use CodeIgniter\Model;

class UserModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'user';
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
        'firstname' => array(
            'label' => 'Name',
            'rules' => 'trim|required|max_length[100]'
        ),

        'email' =>array(
            'label' => 'Email',
            'rules' => 'required',
            'rules' => "trim|required|valid_email|max_length[255]|is_unique[user.email,id,{id}]"
        ),

        'username' =>array(
                'label' => 'Username',
                'rules' => "required|is_unique[user.username,id,{id}]"
        ),
        'password' =>array(
            'label' => 'Password',
            'rules' => 'required'
        )
    ];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
    protected $beforeInsert         = ['setPassword'];
	protected $afterInsert          = [];
	protected $beforeUpdate         = ['setPassword'];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = ['addRole'];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

    public function getAll($data=[]) {
        $builder=$this->db->table("{$this->table} u");
        $builder->join("user_group ug","ug.id = u.user_group_id","left");
        $this->filter($builder,$data);
        $builder->select("u.*,ug.name role");

        if (isset($data['sort']) && $data['sort']) {
            $sort = $data['sort'];
        } else {
            $sort = "u.firstname";
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

        $results = $builder->get()->getResult();

        return $results;
	}

    public function getTotal($data=[]) {
        $builder=$this->db->table("{$this->table} u");
        $this->filter($builder,$data);
        $count = $builder->countAllResults();
        return $count;

	}


    protected  function setPassword(array $data){
//        $data['data']['show_password']=$data['data']['password'];
	    $data['data']['password']=password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }

    protected  function resetAssign(array $data){
        unset($data['data']['form_assign']);
        //printr($data);
        return $data;

    }
	
	protected function localisation(array $data){

        if($data['data']['district']) {
            $districtModel=new DistrictModel();
            $district=$districtModel->getDistrictByCode($data['data']['district']);
            $data['data']['district_id']=$district?$district['id']:0;
        }
        if($data['data']['block']) {
            $blockModel=new BlockModel();
            $block=$blockModel->getBlockByCode($data['data']['block']);
            $data['data']['block_id']=$block?$block['id']:0;
        }
        if(isset($data['data']['gp'])){
            $gpModel=new GrampanchayatModel();
			$gp=$gpModel->getGPByCode($data['data']['gp']);
			$data['data']['gp_id']=$gp?$gp['ids']:'';
		}

		return $data;
		
	}

    private function filter($builder,$data){

        if (!empty($data['filter_search'])) {
            $builder->where("
                (concat_ws(' ', u.firstname, u.lastname) LIKE '%{$data['filter_search']}%'
            OR u.email LIKE '%{$data['filter_search']}%'
            OR u.username LIKE '%{$data['filter_search']}%')"
            );
        }
        if (!empty($data['filter_id'])) {
            $builder->whereIn('u.id',$data['filter_id']);
        }
    }

    protected function addRole($data) {

        if(is_array($data['data'])){
            $data['data']['role'] = (new UserGroupModel())->find($data['data']['user_group_id'])->name;
        } else {
            $data['data']->role = (new UserGroupModel())->find($data['data']->user_group_id)->name;
        }

        return $data;
    }
}
