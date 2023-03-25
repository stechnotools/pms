<?php 
namespace Admin\Report\Models;
use CodeIgniter\Model;

class TentativefarmerModel extends Model
{
    protected $table = '';
    protected $DBGroup      = 'odk';
    protected $allowedFields = [];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    
    public function __construct()
    {
        parent::__construct();
    }



    public function getTentativefarmerByStates($filter=[]){
        $sql="SELECT
  t1.DISTRICT,
  t1.TOTAL_TENTATIVE,
  t1.TOTAL_MALE,
  t1.TOTAL_FEMALE,
  t2.TOTAL_SUBMISSION,
  IFNULL(t3.TOTAL_MIGRATE_SUBMISSION, 0) TOTAL_MIGRATE_SUBMISSION
  
FROM (SELECT
      tfc1.district,
      COUNT(tfc1._URI) TOTAL_TENTATIVE,
      SUM(tfc1.FARMER_INFO_GENDER = 'male') TOTAL_MALE,
      SUM(tfc1.FARMER_INFO_GENDER = 'female') TOTAL_FEMALE
    FROM tentative_farmers_core tfc1
    WHERE tfc1.DELETED = 0
    GROUP BY tfc1.district) t1
  LEFT JOIN (SELECT
      tfc1.district,
      COUNT(tfc1._URI) TOTAL_SUBMISSION
    FROM tentative_farmers_core tfc1
    WHERE tfc1.DELETED = 0
    AND tfc1._SUBMISSION_DATE >= '2022-04-01'
    AND tfc1._SUBMISSION_DATE <= '2023-03-31'
    GROUP BY tfc1.district) t2
    ON (t1.district = t2.district)
  LEFT JOIN (SELECT
      tfc1.district,
      COUNT(tfc1.farmer_id) TOTAL_MIGRATE_SUBMISSION
    FROM tentative_farmer_migrate tfc1
    WHERE 1 = 1
    AND tfc1.migrate_financial_year >= '2022-04-01'
    AND tfc1.migrate_financial_year <= '2023-03-31'
    GROUP BY tfc1.district) t3
    ON (t1.district = t3.district)";
    }
    public function getTentativefarmerByState($filter=[]){

        $sql="SELECT
  ac.code,
  ac.name AS NAME,
  t1.TOTAL_BLOCK,
  t2.TOTAL_GP,
  t3.TOTAL_VILLAGE,
  t7.TOTAL_TENTATIVE,
  t7.TOTAL_MALE,
  t7.TOTAL_FEMALE,
  IFNULL(t6.TOTAL_MIGRATE_SUBMISSION,0) TOTAL_MIGRATE_SUBMISSION,
  t4.TOTAL_SUBMISSION,
  IFNULL(t5.TOTAL_DUPLICATE,0) TOTAL_DUPLICATE
FROM (SELECT 
    v1.DISTRICT,
    COUNT(v1.BLOCK) TOTAL_BLOCK 
    FROM (SELECT tfc1.district DISTRICT,tfc1.code BLOCK FROM block tfc1) AS v1 GROUP BY v1.district) t1
  LEFT JOIN (SELECT
      v2.DISTRICT,
      COUNT(v2.GRAMPANCHAYAT) TOTAL_GP
    FROM (SELECT
        tfc1.DISTRICT,
        tfc1.code GRAMPANCHAYAT
      FROM grampanchayat tfc1 ) AS v2
    GROUP BY v2.DISTRICT) t2
    ON (t1.DISTRICT = t2.DISTRICT)
  LEFT JOIN (SELECT
      v3.DISTRICT,
      COUNT(v3.VILLAGE) TOTAL_VILLAGE
    FROM (SELECT
        tfc1.DISTRICT,
        tfc1.code VILLAGE
      FROM village tfc1 ) AS v3
    GROUP BY v3.DISTRICT) t3
    ON (t1.DISTRICT = t3.DISTRICT)
  LEFT JOIN (SELECT
      tfc1.DISTRICT,
      COUNT(tfc1._URI) TOTAL_TENTATIVE,
	  SUM(tfc1.FARMER_INFO_GENDER = 'male') TOTAL_MALE,
      SUM(tfc1.FARMER_INFO_GENDER = 'female') TOTAL_FEMALE
    FROM tentative_farmers_core tfc1 WHERE tfc1.DELETED=0
    GROUP BY tfc1.DISTRICT) t7
    ON (t1.DISTRICT = t7.DISTRICT)
  LEFT JOIN (SELECT
      tfc1.DISTRICT,
      COUNT(tfc1._URI) TOTAL_SUBMISSION
    FROM tentative_farmers_core tfc1 WHERE tfc1.DELETED=0";
        if($filter['year']){
            $sql.=" AND tfc1._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc1._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc1.DISTRICT) t4
    ON (t1.DISTRICT = t4.DISTRICT)
  LEFT JOIN (SELECT
      tfc1.district,
      COUNT(tfc1.farmer_id) TOTAL_MIGRATE_SUBMISSION
    FROM tentative_farmer_migrate tfc1 WHERE 1=1";
        if($filter['year']){
            $sql.=" AND tfc1.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfc1.migrate_financial_year <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc1.district) t6
    ON (t1.DISTRICT = t6.district)
  LEFT JOIN (SELECT
      v4.DISTRICT,
      SUM(v4.dp) TOTAL_DUPLICATE
    FROM (SELECT
        tfc1.DISTRICT,
        tfc1.FARMER_BANK_ACCOUNT_NO,
        COUNT(tfc1.FARMER_BANK_ACCOUNT_NO) AS dp
      FROM tentative_farmers_core tfc1 WHERE tfc1.DELETED=0";
        if($filter['year']){
            $sql.=" AND tfc1._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc1._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
      GROUP BY tfc1.FARMER_BANK_ACCOUNT_NO
      HAVING COUNT(tfc1.FARMER_BANK_ACCOUNT_NO) > 1) AS v4
    GROUP BY v4.DISTRICT) t5
    ON (t1.DISTRICT = t5.DISTRICT)
  RIGHT JOIN district ac
    ON (t1.DISTRICT = ac.code)";
       //echo $sql;
        return $this->db->query($sql)->getResultArray();

    }

    public function getTentativefarmerByDistrict($filter=[]){

        $sql="SELECT
  ac.code,
  ac.name AS NAME,
  t1.TOTAL_GP,
  t2.TOTAL_VILLAGE,
  t7.TOTAL_TENTATIVE,
  t7.TOTAL_MALE,
  t7.TOTAL_FEMALE,
  IFNULL(t6.TOTAL_MIGRATE_SUBMISSION,0) TOTAL_MIGRATE_SUBMISSION,
  t3.TOTAL_SUBMISSION,
  IFNULL(t4.TOTAL_DUPLICATE, 0) TOTAL_DUPLICATE
FROM (SELECT
    v1.BLOCK,
    COUNT(v1.GRAMPANCHAYAT) TOTAL_GP
  FROM (SELECT
      tfc1.BLOCK,
      tfc1.code GRAMPANCHAYAT
    FROM grampanchayat tfc1 WHERE tfc1.DISTRICT = '".$filter['district']."') AS v1
  GROUP BY v1.BLOCK) t1
  LEFT JOIN (SELECT
      v2.BLOCK,
      COUNT(v2.VILLAGE) TOTAL_VILLAGE
    FROM (SELECT
        tfc1.BLOCK,
        tfc1.code VILLAGE
      FROM village tfc1  WHERE tfc1.DISTRICT = '".$filter['district']."') AS v2
    GROUP BY v2.BLOCK) t2
    ON (t1.BLOCK = t2.BLOCK)
  LEFT JOIN (SELECT
      tfc1.BLOCK,
      COUNT(tfc1._URI) TOTAL_TENTATIVE,
	  SUM(tfc1.FARMER_INFO_GENDER = 'male') TOTAL_MALE,
      SUM(tfc1.FARMER_INFO_GENDER = 'female') TOTAL_FEMALE
    FROM tentative_farmers_core tfc1 WHERE tfc1.DELETED=0
	AND tfc1.DISTRICT = '".$filter['district']."'
    GROUP BY tfc1.BLOCK) t7
    ON (t1.BLOCK = t7.BLOCK)
  LEFT JOIN (SELECT
      tfc1.block,
      COUNT(tfc1.farmer_id) TOTAL_MIGRATE_SUBMISSION
    FROM tentative_farmer_migrate tfc1 WHERE 1=1 
	AND tfc1.district = '".$filter['district']."'";
        if($filter['year']){
            $sql.=" AND tfc1.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfc1.migrate_financial_year <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc1.block) t6
    ON (t1.BLOCK = t6.block)
  LEFT JOIN (SELECT
      tfc1.BLOCK,
      COUNT(tfc1._URI) TOTAL_SUBMISSION
    FROM tentative_farmers_core tfc1
    WHERE tfc1.DELETED = 0
    AND tfc1.DISTRICT = '".$filter['district']."'";
        if($filter['year']){
            $sql.=" AND tfc1._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc1._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    
    GROUP BY tfc1.BLOCK) t3
    ON (t1.BLOCK = t3.BLOCK)
  LEFT JOIN (SELECT
      v3.BLOCK,
      SUM(v3.dp) TOTAL_DUPLICATE
    FROM (SELECT
        tfc1.BLOCK,
        tfc1.FARMER_BANK_ACCOUNT_NO,
        COUNT(tfc1.FARMER_BANK_ACCOUNT_NO) AS dp
      FROM tentative_farmers_core tfc1
      WHERE tfc1.DELETED = 0
      AND tfc1.DISTRICT = '".$filter['district']."'";
        if($filter['year']){
            $sql.=" AND tfc1._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc1._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
      GROUP BY tfc1.FARMER_BANK_ACCOUNT_NO
      HAVING COUNT(tfc1.FARMER_BANK_ACCOUNT_NO) > 1) AS v3
    GROUP BY v3.BLOCK) t4
    ON (t1.BLOCK = t4.BLOCK)
  RIGHT JOIN block ac 
    ON (t1.BLOCK = ac.code) where ac.district = '".$filter['district']."'";
        // echo $sql;
        return $this->db->query($sql)->result_array();

    }

    public function getTentativefarmerByBlock($filter=[]){

        $sql="SELECT
  t1.GRAMPANCHAYAT,
  ac.name AS NAME,
  t1.TOTAL_VILLAGE,
  t7.TOTAL_TENTATIVE,
  t7.TOTAL_MALE,
  t7.TOTAL_FEMALE,
  IFNULL(t6.TOTAL_MIGRATE_SUBMISSION,0) TOTAL_MIGRATE_SUBMISSION,
  t2.TOTAL_SUBMISSION,
  IFNULL(t3.TOTAL_DUPLICATE, 0) TOTAL_DUPLICATE
FROM (SELECT
    v1.GRAMPANCHAYAT,
    COUNT(v1.VILLAGE) TOTAL_VILLAGE
  FROM (SELECT
      tfc1.GRAMPANCHAYAT,
      tfc1.code VILLAGE
    FROM village tfc1
    WHERE tfc1.DISTRICT = '".$filter['district']."'
    AND tfc1.BLOCK = '".$filter['block']."') AS v1
  GROUP BY v1.GRAMPANCHAYAT) t1
  LEFT JOIN (SELECT
      tfc1.GRAMPANCHAYAT,
      COUNT(tfc1._URI) TOTAL_TENTATIVE,
	  SUM(tfc1.FARMER_INFO_GENDER = 'male') TOTAL_MALE,
      SUM(tfc1.FARMER_INFO_GENDER = 'female') TOTAL_FEMALE
    FROM tentative_farmers_core tfc1 WHERE tfc1.DELETED=0
	AND tfc1.DISTRICT = '".$filter['district']."'
	AND tfc1.BLOCK = '".$filter['block']."'
    GROUP BY tfc1.GRAMPANCHAYAT) t7
    ON (t1.GRAMPANCHAYAT = t7.GRAMPANCHAYAT)
LEFT JOIN (SELECT
      tfc1.grampanchayat,
      COUNT(tfc1.farmer_id) TOTAL_MIGRATE_SUBMISSION
    FROM tentative_farmer_migrate tfc1 WHERE 1=1 
	AND tfc1.district = '".$filter['district']."' 
	AND tfc1.block = '".$filter['block']."'";
        if($filter['year']){
            $sql.=" AND tfc1.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfc1.migrate_financial_year <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc1.grampanchayat) t6
    ON (t1.GRAMPANCHAYAT = t6.grampanchayat)
  LEFT JOIN (SELECT
      tfc1.GRAMPANCHAYAT,
      COUNT(tfc1._URI) TOTAL_SUBMISSION
    FROM tentative_farmers_core tfc1
    WHERE tfc1.DELETED = 0
    AND tfc1.DISTRICT = '".$filter['district']."'
    AND tfc1.BLOCK = '".$filter['block']."'";
        if($filter['year']){
            $sql.=" AND tfc1._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc1._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc1.GRAMPANCHAYAT) t2
    ON (t1.GRAMPANCHAYAT = t2.GRAMPANCHAYAT)
  LEFT JOIN (SELECT
      v2.GRAMPANCHAYAT,
      SUM(v2.dp) TOTAL_DUPLICATE
    FROM (SELECT
        tfc1.GRAMPANCHAYAT,
        tfc1.FARMER_BANK_ACCOUNT_NO,
        COUNT(tfc1.FARMER_BANK_ACCOUNT_NO) AS dp
      FROM tentative_farmers_core tfc1
      WHERE tfc1.DELETED = 0
      AND tfc1.DISTRICT = '".$filter['district']."' 
	  AND tfc1.BLOCK = '".$filter['block']."'";
        if($filter['year']){
            $sql.=" AND tfc1._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc1._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
      GROUP BY tfc1.FARMER_BANK_ACCOUNT_NO
      HAVING COUNT(tfc1.FARMER_BANK_ACCOUNT_NO) > 1) AS v2
    GROUP BY v2.GRAMPANCHAYAT) t3
    ON (t1.GRAMPANCHAYAT = t3.GRAMPANCHAYAT)
  LEFT JOIN grampanchayat ac
    ON (t1.GRAMPANCHAYAT = ac.code)
			 ";
        //echo $sql;
        return $this->db->query($sql)->result_array();

    }

    public function getTentativefarmerByGP($filter=[]){
        $sql="SELECT
  t1.VILLAGE,
  ac.name AS NAME,
  t1.TOTAL_TENTATIVE,
  t1.TOTAL_MALE,
  t1.TOTAL_FEMALE,
  IFNULL(t6.TOTAL_MIGRATE_SUBMISSION,0) TOTAL_MIGRATE_SUBMISSION,
  t7.TOTAL_SUBMISSION,
  IFNULL(t2.TOTAL_DUPLICATE, 0) TOTAL_DUPLICATE
FROM (SELECT
      tfc1.VILLAGE,
      COUNT(tfc1._URI) TOTAL_TENTATIVE,
	  SUM(tfc1.FARMER_INFO_GENDER = 'male') TOTAL_MALE,
      SUM(tfc1.FARMER_INFO_GENDER = 'female') TOTAL_FEMALE
    FROM tentative_farmers_core tfc1 WHERE tfc1.DELETED=0
	AND tfc1.DISTRICT = '".$filter['district']."'
	AND tfc1.BLOCK = '".$filter['block']."'
	AND tfc1.GRAMPANCHAYAT = '".$filter['grampanchayat']."'
    GROUP BY tfc1.VILLAGE) t1
	LEFT JOIN (SELECT
    tfc1.VILLAGE,
    COUNT(tfc1._URI) TOTAL_SUBMISSION
  FROM tentative_farmers_core tfc1
  WHERE tfc1.DELETED = 0
  AND tfc1.DISTRICT = '".$filter['district']."' 
  AND tfc1.BLOCK = '".$filter['block']."'
  AND tfc1.GRAMPANCHAYAT = '".$filter['grampanchayat']."'";
        if($filter['year']){
            $sql.=" AND tfc1._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc1._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
  GROUP BY tfc1.VILLAGE) t7
    ON (t1.VILLAGE = t7.VILLAGE)
LEFT JOIN (SELECT
      tfc1.village,
      COUNT(tfc1.farmer_id) TOTAL_MIGRATE_SUBMISSION
    FROM tentative_farmer_migrate tfc1 WHERE 1=1 
	AND tfc1.district = '".$filter['district']."' 
	AND tfc1.block = '".$filter['block']."' 
	AND tfc1.grampanchayat = '".$filter['grampanchayat']."'";
        if($filter['year']){
            $sql.=" AND tfc1.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfc1.migrate_financial_year <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc1.village) t6
    ON (t1.VILLAGE = t6.village)
  LEFT JOIN (SELECT
      v1.VILLAGE,
      SUM(v1.dp) TOTAL_DUPLICATE
    FROM (SELECT
        tfc1.VILLAGE,
        tfc1.FARMER_BANK_ACCOUNT_NO,
        COUNT(tfc1.FARMER_BANK_ACCOUNT_NO) AS dp
      FROM tentative_farmers_core tfc1
      WHERE tfc1.DELETED = 0
      AND tfc1.DISTRICT = '".$filter['district']."' 
	  AND tfc1.BLOCK = '".$filter['block']."'
	  AND tfc1.GRAMPANCHAYAT = '".$filter['grampanchayat']."'";
        if($filter['year']){
            $sql.=" AND tfc1._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc1._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
      GROUP BY tfc1.FARMER_BANK_ACCOUNT_NO
      HAVING COUNT(tfc1.FARMER_BANK_ACCOUNT_NO) > 1) AS v1
    GROUP BY v1.VILLAGE) t2
    ON (t1.VILLAGE = t2.VILLAGE)
  LEFT JOIN village ac
    ON (t1.VILLAGE = ac.code)
			 ";
        //echo $sql;
        return $this->db->query($sql)->result_array();

    }

    public function getTentativefarmerByVillage($filter=[]){

        $sql="SELECT
		t1.TOTAL_TENTATIVE,
		t1.TOTAL_MALE,
		t1.TOTAL_FEMALE,
		t1.TOTAL_MIGRATE_SUBMISSION,
  t1.TOTAL_SUBMISSION,
  t1.TOTAL_DUPLICATE
FROM (SELECT
    COUNT(tfc1._URI) TOTAL_SUBMISSION,
	(SELECT
        COUNT(tfc1._URI) TOTAL_TENTATIVE,
		SUM(tfc1.FARMER_INFO_GENDER = 'male') TOTAL_MALE,
		SUM(tfc1.FARMER_INFO_GENDER = 'female') TOTAL_FEMALE
      FROM tentative_farmers_core tfc1
        WHERE tfc1.DELETED=0 
		AND tfc1.DISTRICT = '".$filter['district']."'
		AND tfc1.BLOCK = '".$filter['block']."'
		AND tfc1.GRAMPANCHAYAT = '".$filter['grampanchayat']."'
		AND tfc1.VILLAGE = '".$filter['village']."') TOTAL_TENTATIVE,
	(SELECT
      COUNT(tfc1.farmer_id) TOTAL_MIGRATE_SUBMISSION
    FROM tentative_farmer_migrate tfc1 WHERE 1=1 
	AND tfc1.district = '".$filter['district']."' 
	AND tfc1.block = '".$filter['block']."' 
	AND tfc1.grampanchayat = '".$filter['grampanchayat']."'
	AND tfc1.village = '".$filter['village']."'";
        if($filter['year']){
            $sql.=" AND tfc1.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfc1.migrate_financial_year <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" ) TOTAL_MIGRATE_SUBMISSION,
	
    (SELECT
        SUM(v1.dp) TOTAL_DUPLICATE
      FROM (SELECT
          tfc1.FARMER_BANK_ACCOUNT_NO,
          COUNT(tfc1.FARMER_BANK_ACCOUNT_NO) AS dp
        FROM tentative_farmers_core tfc1
        WHERE tfc1.DELETED=0 
		AND tfc1.DISTRICT = '".$filter['district']."'
		AND tfc1.BLOCK = '".$filter['block']."'
		AND tfc1.GRAMPANCHAYAT = '".$filter['grampanchayat']."'
		AND tfc1.VILLAGE = '".$filter['village']."'";
        if($filter['year']){
            $sql.=" AND tfc1._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc1._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
        GROUP BY tfc1.FARMER_BANK_ACCOUNT_NO
        HAVING COUNT(tfc1.FARMER_BANK_ACCOUNT_NO) > 1) AS v1) TOTAL_DUPLICATE

  FROM tentative_farmers_core tfc1
  WHERE tfc1.DELETED=0 
  AND tfc1.DISTRICT = '".$filter['district']."'
  AND tfc1.BLOCK = '".$filter['block']."'
  AND tfc1.GRAMPANCHAYAT = '".$filter['grampanchayat']."'
  AND tfc1.VILLAGE = '".$filter['village']."'";
        if($filter['year']){
            $sql.=" AND tfc1._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc1._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" ) t1";

        return $this->db->query($sql)->result_array();

    }

    public function getCTentativefarmerByState($filter=[]){

        $sql="SELECT
  d.code,
  d.name AS NAME,
  t1.TOTAL_SUBMISSION,
  IFNULL(t2.TOTAL_MIGRATE_SUBMISSION,0) TOTAL_MIGRATE_SUBMISSION,
  t3.TOTAL_ST,
  t3.TOTAL_SC,
  t3.TOTAL_OBC,
  t3.TOTAL_GENERAL

  FROM (SELECT
      tfc.DISTRICT,
      COUNT(tfc._URI) TOTAL_SUBMISSION
    FROM tentative_farmers_core tfc WHERE 1=1";
        if($filter['year']){
            $sql.=" AND tfc._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc.DISTRICT) t1
 
  LEFT JOIN (SELECT
      tfc.district,
      COUNT(tfc.farmer_id) TOTAL_MIGRATE_SUBMISSION
    FROM tentative_farmer_migrate tfc WHERE 1=1";
        if($filter['year']){
            $sql.=" AND tfc.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfc.migrate_financial_year <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc.district) t2
    ON (t1.DISTRICT = t2.district)
 LEFT JOIN 
		(SELECT tfc.DISTRICT, SUM(tfc.FARMER_INFO_CASTE = 'st') TOTAL_ST,SUM(tfc.FARMER_INFO_CASTE = 'sc') TOTAL_SC,SUM(tfc.FARMER_INFO_CASTE = 'obc') TOTAL_OBC,SUM(tfc.FARMER_INFO_CASTE = 'general') TOTAL_GENERAL FROM tentative_farmers_core tfc where 1=1";
        if($filter['year']){
            $sql.=" AND ((tfc._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."')";
        }
        $sql.=" OR (tfc._URI IN (select farmer_id from tentative_farmer_migrate tfm where 1=1";
        if($filter['year']){
            $sql.=" AND (tfm.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfm.migrate_financial_year <= '".$filter['financial_year']['end_date']."'))";
        }
        $sql.=")) GROUP BY tfc.DISTRICT) as t3	
		ON (t1.DISTRICT=t3.DISTRICT)
  RIGHT JOIN district d
    ON (t1.DISTRICT = d.code)";
        // echo $sql;
        return $this->db->query($sql)->result_array();

    }

    public function getCTentativefarmerByDistrict($filter=[]){

        $sql="SELECT
  b.code,
  b.name AS NAME,
  t1.TOTAL_SUBMISSION,
  IFNULL(t2.TOTAL_MIGRATE_SUBMISSION,0) TOTAL_MIGRATE_SUBMISSION,
  t3.TOTAL_ST,
  t3.TOTAL_SC,
  t3.TOTAL_OBC,
  t3.TOTAL_GENERAL

  FROM (SELECT
      tfc.BLOCK,
      COUNT(tfc._URI) TOTAL_SUBMISSION
    FROM tentative_farmers_core tfc WHERE 1=1 
	AND tfc.DISTRICT = '".$filter['district']."'";
        if($filter['year']){
            $sql.=" AND tfc._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc.BLOCK) t1
 
  LEFT JOIN (SELECT
      tfc.block,
      COUNT(tfc.farmer_id) TOTAL_MIGRATE_SUBMISSION
    FROM tentative_farmer_migrate tfc WHERE 1=1 
	AND tfc.DISTRICT = '".$filter['district']."'";
        if($filter['year']){
            $sql.=" AND tfc.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfc.migrate_financial_year <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc.block) t2
    ON (t1.BLOCK = t2.block)
 LEFT JOIN 
		(SELECT tfc.BLOCK, SUM(tfc.FARMER_INFO_CASTE = 'st') TOTAL_ST,SUM(tfc.FARMER_INFO_CASTE = 'sc') TOTAL_SC,SUM(tfc.FARMER_INFO_CASTE = 'obc') TOTAL_OBC,SUM(tfc.FARMER_INFO_CASTE = 'general') TOTAL_GENERAL FROM tentative_farmers_core tfc where 1=1 
		AND tfc.DISTRICT = '".$filter['district']."'";
        if($filter['year']){
            $sql.=" AND ((tfc._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."')";
        }
        $sql.=" OR (tfc._URI IN (select farmer_id from tentative_farmer_migrate tfm where 1=1";
        if($filter['year']){
            $sql.=" AND (tfm.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfm.migrate_financial_year <= '".$filter['financial_year']['end_date']."'))";
        }
        $sql.=")) GROUP BY tfc.BLOCK) as t3	
		ON (t1.BLOCK=t3.BLOCK)
  RIGHT JOIN block b
    ON (t1.BLOCK = b.code) where b.district = '".$filter['district']."'";
        // echo $sql;
        return $this->db->query($sql)->result_array();

    }

    public function getCTentativefarmerByBlock($filter=[]){

        $sql="SELECT
  g.code,
  g.name AS NAME,
  t1.TOTAL_SUBMISSION,
  IFNULL(t2.TOTAL_MIGRATE_SUBMISSION,0) TOTAL_MIGRATE_SUBMISSION,
  t3.TOTAL_ST,
  t3.TOTAL_SC,
  t3.TOTAL_OBC,
  t3.TOTAL_GENERAL

  FROM (SELECT
      tfc.GRAMPANCHAYAT,
      COUNT(tfc._URI) TOTAL_SUBMISSION
    FROM tentative_farmers_core tfc WHERE 1=1 
	AND tfc.DISTRICT = '".$filter['district']."'
    AND tfc.BLOCK = '".$filter['block']."'";
        if($filter['year']){
            $sql.=" AND tfc._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc.GRAMPANCHAYAT) t1
 
  LEFT JOIN (SELECT
      tfc.grampanchayat,
      COUNT(tfc.farmer_id) TOTAL_MIGRATE_SUBMISSION
    FROM tentative_farmer_migrate tfc WHERE 1=1 
	AND tfc.DISTRICT = '".$filter['district']."'
    AND tfc.BLOCK = '".$filter['block']."'";
        if($filter['year']){
            $sql.=" AND tfc.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfc.migrate_financial_year <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc.grampanchayat) t2
    ON (t1.GRAMPANCHAYAT = t2.grampanchayat)
 LEFT JOIN 
		(SELECT tfc.GRAMPANCHAYAT, SUM(tfc.FARMER_INFO_CASTE = 'st') TOTAL_ST,SUM(tfc.FARMER_INFO_CASTE = 'sc') TOTAL_SC,SUM(tfc.FARMER_INFO_CASTE = 'obc') TOTAL_OBC,SUM(tfc.FARMER_INFO_CASTE = 'general') TOTAL_GENERAL FROM tentative_farmers_core tfc where 1=1 
		AND tfc.DISTRICT = '".$filter['district']."' 
		AND tfc.BLOCK = '".$filter['block']."'";
        if($filter['year']){
            $sql.=" AND ((tfc._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."')";
        }
        $sql.=" OR (tfc._URI IN (select farmer_id from tentative_farmer_migrate tfm where 1=1";
        if($filter['year']){
            $sql.=" AND (tfm.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfm.migrate_financial_year <= '".$filter['financial_year']['end_date']."'))";
        }
        $sql.=")) GROUP BY tfc.GRAMPANCHAYAT) as t3	
		ON (t1.GRAMPANCHAYAT=t3.GRAMPANCHAYAT)
 LEFT JOIN grampanchayat g
    ON (t1.GRAMPANCHAYAT = g.code)";
        // echo $sql;
        return $this->db->query($sql)->result_array();

    }

    public function getCTentativefarmerByGP($filter=[]){

        $sql="SELECT
  v.code,
  v.name AS NAME,
  t1.TOTAL_SUBMISSION,
  IFNULL(t2.TOTAL_MIGRATE_SUBMISSION,0) TOTAL_MIGRATE_SUBMISSION,
  t3.TOTAL_ST,
  t3.TOTAL_SC,
  t3.TOTAL_OBC,
  t3.TOTAL_GENERAL

  FROM (SELECT
      tfc.VILLAGE,
      COUNT(tfc._URI) TOTAL_SUBMISSION
    FROM tentative_farmers_core tfc WHERE 1=1 
	AND tfc.DISTRICT = '".$filter['district']."'
    AND tfc.BLOCK = '".$filter['block']."' 
	AND tfc.GRAMPANCHAYAT = '".$filter['grampanchayat']."'";

        if($filter['year']){
            $sql.=" AND tfc._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc.VILLAGE) t1
 
  LEFT JOIN (SELECT
      tfc.village,
      COUNT(tfc.farmer_id) TOTAL_MIGRATE_SUBMISSION
    FROM tentative_farmer_migrate tfc WHERE 1=1 
	AND tfc.DISTRICT = '".$filter['district']."'
    AND tfc.BLOCK = '".$filter['block']."' 
	AND tfc.GRAMPANCHAYAT = '".$filter['grampanchayat']."'";
        if($filter['year']){
            $sql.=" AND tfc.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfc.migrate_financial_year <= '".$filter['financial_year']['end_date']."'";
        }
        $sql.=" 
    GROUP BY tfc.village) t2
    ON (t1.VILLAGE = t2.village)
 LEFT JOIN 
		(SELECT tfc.VILLAGE, SUM(tfc.FARMER_INFO_CASTE = 'st') TOTAL_ST,SUM(tfc.FARMER_INFO_CASTE = 'sc') TOTAL_SC,SUM(tfc.FARMER_INFO_CASTE = 'obc') TOTAL_OBC,SUM(tfc.FARMER_INFO_CASTE = 'general') TOTAL_GENERAL FROM tentative_farmers_core tfc where 1=1 
		AND tfc.DISTRICT = '".$filter['district']."' 
		AND tfc.BLOCK = '".$filter['block']."' 
		AND tfc.GRAMPANCHAYAT = '".$filter['grampanchayat']."'";
        if($filter['year']){
            $sql.=" AND ((tfc._SUBMISSION_DATE >= '".$filter['financial_year']['start_date']."' AND tfc._SUBMISSION_DATE <= '".$filter['financial_year']['end_date']."')";
        }
        $sql.=" OR (tfc._URI IN (select farmer_id from tentative_farmer_migrate tfm where 1=1";
        if($filter['year']){
            $sql.=" AND (tfm.migrate_financial_year >= '".$filter['financial_year']['start_date']."' AND tfm.migrate_financial_year <= '".$filter['financial_year']['end_date']."'))";
        }
        $sql.=")) GROUP BY tfc.VILLAGE) as t3	
		ON (t1.VILLAGE=t3.VILLAGE)
 LEFT JOIN village v
    ON (t1.VILLAGE = v.code)";
        // echo $sql;
        return $this->db->query($sql)->result_array();

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
        $select="SELECT * ";
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
        $sql=$select.$object.$where;
        $sql.=" GROUP BY d.code";
        //echo $sql;
        return $this->db->query($sql)->getRowArray();
    }

}