<?php 
namespace Admin\Report\Models;
use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table = '';
    protected $DBGroup      = '';
    protected $allowedFields = [];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get_yearly_count($table, $year) {

        $builder=$this->db->table($table);
        $builder->select("count(DISTINCT(survey_id)) as No_of_Households");
        if($table == 'hh_basic_details') {
            $builder->like("modified_date_time", $year);
        }else{
            $builder->where("year", $year);
        }

        $res = $builder->get()->getRowArray();
        if($res){
            return array(
                'status' => TRUE,
                'count' => $res['No_of_Households']
            );
        }else{
            return array(
                'status' => false,
                'count' => 0
            );
        }
    }

    public function get_cluster_count($cluster) {
        $builder=$this->db->table("hh_basic_details");
        $builder->select("*");
        $builder->where("cluster", $cluster);
        $result = $builder->get()->getResult();
        if (!$result) {
            return array(
                'status' => FALSE,
                'message' => []
            );
        } else {
            return array(
                'status' => TRUE,
                'message' => $result
            );
        }

    }

    public function get_activity_count($table) {

        $count = "";
        $builder=$this->db->table($table);

        for ($i = 5; $i >= 0; $i -= 1) {
            //echo date('Y-m', strtotime("-$i month")) . '<br/>';
            $builder->select("*");
            $builder->like("modified_date_time", date('Y-m', strtotime(date('Y-m') . " -$i month")));
            $count = $count . $builder->countAllResults().',';
        }
        $count = substr($count, 0, -1);
        return $count;
    }

    public function getLocalisation($data=[]){
        $select="SELECT";
        $object=" FROM district d";
        $where=" where 1=1";
        if($data['district']){
            $select.=" d.name AS district";
            $where.=' and  d.code = "'.$data['district'].'"';
        }
        if($data['block']){
            $select.=",b.name AS block";
            $object.=" CROSS JOIN block b";
            $where.=' and  b.code = "'.$data['block'].'"';
        }
        if($data['grampanchayat']){
            $select.=",g.name AS grampanchayat";
            $object.=" CROSS JOIN grampanchayat g";
            $where.=' and  g.code = "'.$data['grampanchayat'].'"';
        }
        if($data['village']){
            $select.=",v.name AS village";
            $object.=" CROSS JOIN village v";
            $where.=' and  v.code = "'.$data['village'].'"';
        }
        if($select!="SELECT") {
            $sql = $select . $object . $where;
            $sql .= " GROUP BY d.code";
            //echo $sql;
            return $this->db->query($sql)->getRowArray();
        }else{
            return [];
        }
    }

}