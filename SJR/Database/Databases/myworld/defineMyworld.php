<?php

namespace SJR\Database\Databases\myworld;

use SJR\Database\sqlRun;

class defineMyworld
{

    static public function getTables()
    {
        $sql = "SHOW TABLES";
        $results = sqlRun::sqlRun($sql, '', array(), 'MYWORLD', true);
        $array = [];
        foreach($results AS $key=>$value){
            $array[$value['Tables_in_myworld']] = "myworld." .$value['Tables_in_myworld'];
        }
        return $array;
    }

    static public function getFields($table){
        $sql = "SELECT COLUMN_NAME
                      FROM INFORMATION_SCHEMA.COLUMNS
                      WHERE TABLE_SCHEMA = 'myworld' AND TABLE_NAME = '" .$table ."'";

        $results = sqlRun::sqlRun($sql, '', array(), 'MYWORLD', true);
        $array = [];
        foreach($results AS $key=>$value){
            $array[$value['COLUMN_NAME']] = $table ."." .$value['COLUMN_NAME'];
        }
        return $array;
    }

}



