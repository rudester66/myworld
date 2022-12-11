<?php

namespace App\Models;

use SJR\Database\databaseObjFunction;
use SJR\Database\sqlRun;

class TagLink
{


    static public function taGTypeArray(){
        return [
            0 => 'Occasion',
            1 =>'Files',
        ];
    }

    static public function getAllTags($ItemTypeID, $ItemID){
        $db = databaseObjFunction::getMYWORLD();
        $tagLinks = $db->getTagLinksFields();
        $sql = "SELECT * 
                    FROM {$db->getTaglinks()}
                    WHERE {$tagLinks->getItemTypeID()} = :ItemTypeID
                        AND {$tagLinks->getItemID()} = :itemID ";
        $results = sqlRun::sqlRun($sql, '', array(':ItemTypeID' => $ItemTypeID, ':itemID' => $ItemID), 'MYWORLD', true);
        $tags = [];
        //  Groups thenm in the same Tag Type
        foreach($results AS $key=>$value){
            $function ='tagType' .$value['TagTypeID'];
            $tags[$value['TagTypeID']][] = self::$function($value['TagID']);
        }
        return $tags;
    }

    /**
     * FILE TAG - retrieve required information
     *      return File name - tagID and fie format
     * @return void
     */
    static private function tagType1($tagID){
        $sql = "SELECT *
                    FROM files
                    WHERE FileID = :tagID ";
        return sqlRun::sqlRun($sql, '', array(':tagID' => $tagID), 'MYWORLD', true)[0];
    }



}