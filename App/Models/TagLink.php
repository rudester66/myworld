<?php

namespace App\Models;

use App\Entity\_taglinks;
use SJR\Database\databaseObjFunction;
use SJR\Database\sqlRun;

class TagLink
{


    static public function tagTypeArray()
    {
        return [
            0 => [
                'name' => 'Occasion',
                'button' => [
                    0 => ':OccasionsName',
                ],
            ],
            1 => [
                'name' => 'Files',
                'button' => [
                    0 => ':FileName',
                ],
            ],
            2 => [
                'name' => 'Members',
                'button' => [
                    0 => ':Forename',
                    1 => ' ',
                    2 => ':Middlename',
                    3 => ' ',
                    4 => ':Surname',
                ],
            ],
            3 => [
                'name' => 'Tags',
                'button' => [
                    0 => ':TagName',
                ],
            ],
        ];
    }

    static private function tagsArray()
    {
        $tagTypeArray = self::tagTypeArray();
        $return = [];
        foreach ($tagTypeArray as $key => $value) {
            $return[$key] = array();
        }
        return $return;
    }

    static public function getAllTags($ItemID)
    {
        $tags = self::tagsArray();
        if ($ItemID != '') {
            $db = databaseObjFunction::getMYWORLD();
            $tagLinks = $db->getTagLinksFields();
            $sql = "SELECT * 
                    FROM {$db->getTaglinks()}
                    WHERE {$tagLinks->getItemTypeID()} = :itemID
                        OR {$tagLinks->getItemID()} = :itemID ";
            $results = sqlRun::sqlRun($sql, '', array(':itemID' => $ItemID), 'MYWORLD', true);
            //  Groups them in the same Tag Type
            foreach ($results as $key => $value) {
                $function = 'tagType' . $value['TagTypeID'];
                $tags[$value['TagTypeID']][] = self::$function($value['TagID']);
            }
        }
        return $tags;
    }

    /**
     * OCCASION TAG - retrieve required information
     *      return File name - tagID and fie format
     * @return void
     */
    static private function tagType0($tagID)
    {
        $sql = "SELECT *
                    FROM occasions
                    WHERE OccasionsID = :tagID ";
        return sqlRun::sqlRun($sql, '', array(':tagID' => $tagID), 'MYWORLD', true)[0];
    }

    /**
     * FILE TAG - retrieve required information
     *      return File name - tagID and fie format
     * @return void
     */
    static private function tagType1($tagID)
    {
        $sql = "SELECT *
                    FROM files
                    WHERE FileID = :tagID ";
        return sqlRun::sqlRun($sql, '', array(':tagID' => $tagID), 'MYWORLD', true)[0];
    }


    /**
     * MEMBER TAG - retrieve required information
     *      return Full name
     * @return void
     */
    static private function tagType2($tagID)
    {
        $sql = "SELECT *
                    FROM members
                    WHERE MemberID = :tagID ";
        return sqlRun::sqlRun($sql, '', array(':tagID' => $tagID), 'MYWORLD', true)[0];
    }


    static public function getLastThree()
    {
        $return = [];
        foreach (self::tagsArray() as $key => $value) {
            $return[$key] = [];
            $db = databaseObjFunction::getMYWORLD();
            $tagLinks = $db->getTagLinksFields();
            $sql = "SELECT DISTINCT({$tagLinks->getItemID()}) AS item,  {$tagLinks->getItemTypeID()}
                    FROM {$db->getTaglinks()}
                    WHERE {$tagLinks->getItemTypeID()} = :ItemTypeID
                    ORDER BY {$tagLinks->getItemTypeID()} DESC
                    LIMIT 0, 3 
                    ";
            $results = sqlRun::sqlRun($sql, '', array(':ItemTypeID' => $key), 'MYWORLD', true);
            foreach ($results as $k => $v) {
                $function = 'tagType' . $key;
                $return[$key][] = self::$function($v['item']);
            }
        }
        return $return;
    }


    static public function getTagInputs($tagType, $tagID)
    {
        $tagArray = self::tagTypeArray();
        $lastThree = self::getLastThree();
//viewArray($lastThree);exit;
        $str = '';

        foreach ($tagArray as $key => $value) {
            if ($key != $tagType ) {

                $str .= '<div class="uk-width-1-2">
                    <h4>' . $value['name'] . ' Tags</h4> ';
                $str .= Tag::searchInput($value['name']) ." <br>";
                $str .= "Last Three <br>";
                $str .= "All Tags <br>";

//                    ' . Tag::searchInput($value['name']);
//                foreach($lastThree[$key] AS $last=>$three){
//                    $buttonName = self::buttonName($value['button'], $three);
//                    $str .= sjrButton('button', 'primary', '#', 'plus', $buttonName , '', ''). " ";
//                }

             $str .= '</div>';
            }
        }
        return $str;
    }


    static private function buttonName($button, $value){
        $buttonName = '';
        foreach($button AS $key=>$val){
            if(substr($val, 0,1 ) == ":"){
                $buttonName .= $value[str_replace(":","", $val)];
            } else {
                $buttonName .= $val;
            }
        }
        return $buttonName;
    }

}