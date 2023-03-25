<?php
namespace Admin\Thematic\Models;

use CodeIgniter\Model;

class ThematicModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'thematics';
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
        $results = $builder->get()->getResult();
        //echo $this->db->getLastQuery();
        return $results;
//        return
	}

    public function getTotal($data=[]) {
        $builder=$this->db->table("{$this->table} u");
        $this->filter($builder,$data);
        $count = $builder->countAllResults();
        return $count;

	}

    private function filter($builder,$data){

        if (!empty($data['filter_search'])) {
            $builder->where("
                (concat_ws(' ', u.firstname, u.lastname) LIKE '%{$data['filter_search']}%'
            OR u.email LIKE '%{$data['filter_search']}%'
            OR u.username LIKE '%{$data['filter_search']}%'
            OR d.name LIKE '%{$data['filter_search']}%'
            OR c.name LIKE '%{$data['filter_search']}%'
            OR ug.name LIKE '%{$data['filter_search']}%')"
            );
        }
    }

}
