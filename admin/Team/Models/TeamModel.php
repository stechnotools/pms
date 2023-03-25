<?php
namespace Admin\Team\Models;
use CodeIgniter\Model;
class TeamModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'teams';
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
            'label' => 'Team Name',
            'rules' => 'trim|required|max_length[100]'
        )
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

    public function getAll($data=[]) {
        $builder=$this->db->table("{$this->table} t");
        $this->filter($builder,$data);

        $builder->select("t.*");

        if (isset($data['sort']) && $data['sort']) {
            $sort = $data['sort'];
        } else {
            $sort = "t.name";
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

    public function getTotals($data=[]) {
        $builder=$this->db->table("{$this->table} u");
        $this->filter($builder,$data);
        $count = $builder->countAllResults();
        return $count;

	}

    private function filter($builder,$data){

        if (!empty($data['filter_search'])) {
            $builder->where("u.name LIKE '%{$data['filter_search']}%'");
        }
    }
    
    public function getTeamUser($team_id){
        $sql="SELECT
        pu.*,ug.name as role
      FROM pms_team_users ptu
        LEFT JOIN pms_user pu
          ON ptu.user_id = pu.id
        LEFT JOIN pms_user_group ug
          ON ug.id = pu.user_group_id
      WHERE ptu.team_id = $team_id";
      return $this->db->query($sql)->getResult();
    }
    
    public function getTotalTaskByTeam($team_id){
        $builder=$this->db->table("pms_task_users ptu");
        $builder->join("pms_team_users ptu1","ptu.user_id = ptu1.user_id","left");
        $builder->where("ptu1.team_id",$team_id);
        $count = $builder->countAllResults();
        return $count;
    }

}
