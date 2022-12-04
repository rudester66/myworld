<?php

namespace SJR\Database;

/**
 *  Creates an object for each required database
 */
class databaseObjFunction
{
    public static function getMYWORLD(){
        $database = databaseObj::getDatabaseObj();
        return $database->getMYWORLD();
    }


}