<?php
namespace App\Validation;

use Config\Database;

class CustomRules{

    // Rule is to validate mobile number digits
    public function is_cluster($str, string $field, array $data):bool{

        [$field, $ignoreField, $ignoreValue] = array_pad(explode(',', $field), 3, null);
        $uri=service('uri');
        $ignoreValue=$uri->getSegment(4);

        // Break the table and field apart
        sscanf($field, '%[^.].%[^.]', $table, $field);
        //print_r($ignoreValue);
        //exit;
        $db = Database::connect($data['DBGroup'] ?? null);

        $builder  = $db->table($table)
            ->select('1')
            ->whereIn($field, $str)
            ->limit(1);

        if (! empty($ignoreField) && ! empty($ignoreValue) && ! preg_match('/^\{(\w+)\}$/', $ignoreValue)) {
            $builder->where("{$ignoreField} !=", $ignoreValue);
        }
        $query   = $builder->get();
        //echo $db->getLastQuery();
        //exit;
        //print_r($query->getRow());
        //exit;
        if($query->getRow()){
            return false;
        }else{
            return true;
        }
       // return $row->get()->getRow() === null;
    }
}