<?php

namespace SJR\Database;

use SJR\Database\sqlRun;

class definedDB
{

    /**
     * Returns an array of all the databases
     * @return array
     */
    public static function databases(){
        $sql = "SHOW DATABASES; ";
        $results =  sqlRun::sqlRun($sql, '', array(), 'MYWORLD', true);
        $array = array();
        foreach($results AS $key=>$value){
            $prop = $value["Database"];
            $array[$prop] = $prop;
        }
        return $array;
    }

    /**
     * Returns an array of all the tables in smi
     * @return array
     */
    public static function MYWORLD(){
        return static::getMYSQLTables('MYWORLD');
    }



    private static function getMYSQLTables($database){
        $sql = "SHOW TABLES; ";
        $results =  sqlRun::sqlRun($sql, '', array(), $database, true);
        $array = array();
        foreach($results AS $key=>$value){
            $prop = $value["Tables_in_" .strtolower($database)];
            $array[$prop] = $prop;
        }
        return $array;
    }


}