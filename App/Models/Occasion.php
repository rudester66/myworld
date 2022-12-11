<?php

namespace App\Models;

use App\Entity\_occasions;
use App\Entity\occasionsPage;
use SJR\Database\databaseObjFunction;
use SJR\Database\sqlRun;
use SJR\Models\pageVariables;


class Occasion
{

    /**
     * Occasion constructor.
     * @param string $function
     * @param array $requests
     */
    public static function construct(string $function, array $requests)
    {
        $requests = static::setDefaults($requests);    //  checks the requests, setting defaults if necessary
        $runFunction = static::$function($requests);      //  runs the requested function

        return $runFunction;
    }

    private static function main($requests)
    {
        $inArray['monthOccasions'] = self::getMonthOccasions($requests);
        $inArray['dayOccasions'] = ($requests['occasionDate'] == ''?'':$inArray['monthOccasions'][date("d", strtotime($requests['occasionDate']))]);
        $occasion = new _occasions(array());
        if($requests['occasionID'] != ''){
            $occasion->setSelectOne($requests['occasionID']);
        }
        $inArray['occasion'] = $occasion;
        $inArray['occasionID'] = $requests['occasionID'];
        $array = array(
            'requests' => $requests,
            'Occasions' => new occasionsPage($inArray),
            'component' => VIEW_PATH .'/Occasions/pages/main.php',
            'CSS' => array(
                0 => 'Core/CSS/Occasions.css',
            ),
            'JS' => array(
                0 => 'Core/JS/Occasions.js',
            ),
        );
//        viewArray($array);exit;
        $obj = new pageVariables($array);

        return $obj;
    }

    static public function getOccasion($id){
        $db = databaseObjFunction::getMYWORLD();
        $occasions = $db->getOccasionsFields();
        $sql = "SELECT * 
                    FROM {$db->getOccasions()}
                    WHERE {$occasions->getOccasionsID()} = :id ";
        return sqlRun::sqlRun($sql, '', array(':id' => $id), 'MYWORLD', true)[0];
    }

    private static function addOccasion($requests)
    {
        $array = array(
            'requests' => $requests,
            'component' => VIEW_PATH .'/Occasions/pages/addOccasion.php',
            'CSS' => array(
                0 => 'Core/CSS/Occasions.css',
            ),
            'JS' => array(
                0 => 'Core/JS/Occasions.js',
            ),
        );
//        viewArray($array);exit;
        $obj = new pageVariables($array);

        return $obj;
    }

    static public function insertOccasion($requests){
        $obj = new _occasions($requests);
        $obj->setInsert($obj);
        return $obj->getInsert();
    }

    static public function updateOccasion($requests){
        $obj = new _occasions($requests);
        $obj->setUpdate();
    }


    /**
     * Returns an array of objects of all the occasions using the occasion entity
     * @return array of objects
     */
    public static function getMonthOccasions($requests)
    {
        $obj = databaseObjFunction::getMYWORLD();
        $occasions = $obj->getOccasionsFields();
        $sql = "SELECT *
                    FROM {$obj->getOccasions()}
                    WHERE {$occasions->getOccasionsDate()} BETWEEN :dateFrom AND :dateTo
                        AND {$occasions->getOccasionsValid()} = 1
                    ORDER BY {$occasions->getOccasionsDate()} ASC


        ";
        $results = sqlRun::sqlRun($sql, '', array(':dateFrom' => $requests['dateFrom'], ':dateTo' => $requests['dateTo']), 'MYWORLD', true);
        $returns = [];
        foreach ($results as $key => $value) {
            $day = date("d", strtotime($value['OccasionsDate']));
            $occasion = new _occasions($value);
            $returns[$day][] = $occasion;
        }
        return $returns;
    }

    public static function getAnniversaries()
    {
        $month = date("m");
        $day = date("d");

        $db = databaseObjFunction::getMYWORLD();
        $occasions = $db->getOccasionsFields();
        $sql = "SELECT *
                    FROM {$db->getOccasions()}
                    WHERE
                            MONTH({$occasions->getOccasionsDate()}) = :mth
                        AND DAY({$occasions->getOccasionsDate()}) = :dy
                        AND {$occasions->getOccasionsValid()} = 1
                    ";

        $results = sqlRun::sqlRun($sql, '', array(':mth' => $month, ':dy' => $day), 'MYWORLD', true);
        $array = [];
        foreach ($results as $key => $value) {
            $array[date("Y", strtotime($value['OccasionsDate']))][] = new _occasions($value);
        }
        ksort($array);
        return $array;
    }

//    public static function getOccasionTags($TableLinkID, $TableID)
//    {
//        $tagID = TagLinks::getSpecificTagLinks(2, $TableLinkID, $TableID);
//        $database = getDatabaseObj();
//        $tables = $database->getSjrTables();
//        $tagLinks = $tables->getOccasionsFields();
//        $tags =[];
//        foreach($tagID['array'] AS $key=>$tag) {
//            $sql = "SELECT *
//                        FROM {$tables->getOccasions()}
//                        WHERE
//                            {$tagLinks->getOccasionsID()} = :tagTableID
//            ";
//            $results = sqlRun::sqlRun($sql, '', array(':tagTableID' => $tag->getTagID()), 'sjr', true);
//            foreach ($results as $key => $value) {
//                $value['TagLinkID'] = $tag->getTagLinksID();
//                $tags[] = new _occasions($value);
//            }
//        }
//        return $tags;
//    }



//    private static function occasions($requests)
//    {
//        $array = array(
//            'requests' => $requests,
//            'Occasions' => static::getAllOccasions(),
//        );
//        $obj = new pageVariables($array);
//
//        return $obj;
//    }
//
//
//    private static function occasion($requests)
//    {
//        $array = array(
//            'CSS'=> array(
//                0=> 'App/CSS/ancestry.css',
//                1=> 'App/CSS/files.css',
//            ),
//            'requests' => $requests,
//            'Occasions' => static::getOccasion($requests['id']),
//        );
//        $obj = new pageVariables($array);
//
//        return $obj;
//    }


//    /**
//     * Returns an array of objects of all the occasions using the occasion entity
//     * @return array of objects
//     */
//    public static function getAllOccasions()
//    {
//        $databases = getDatabaseObj();
//        $tables = $databases->getOccasions();
//        $occasions = $tables->getOccasionsFields();
//        $sql = "SELECT *
//                    FROM {$tables->getOccasions()}
//                    WHERE 1
//                    ORDER BY {$occasions->getOccasionsDate()} DESC ";
//
//        $results = sqlRun::sqlRun($sql, '', array(), 'SJR', true);
//
//        $returns = [];
//        foreach ($results as $key => $value) {
//            $occasion = new _occasions($value);
//            $returns[] = $occasion;
//        }
//        return $returns;
//    }


//    /**
//     * Returns an array of objects of all the occasions using the occasion entity
//     * @return array of objects
//     */
//    public static function getDayYearOccasions($requests)
//    {
//        $returns = [];
//        for ($mth = 1; $mth < 13; $mth++) {
//            for ($dy = 1; $dy < 32; $dy++) {
//                $returns[$mth][$dy] = 0;
//            }
//        }
//        $sql = "select DAY(OccasionsDate) AS DY, MONTH(OccasionsDate) AS MTH, COUNT(OccasionsID) AS CT
//                    from occasions
//                    where OccasionsDate BETWEEN :dateFrom AND :dateTo
//                        AND OccasionsValid = 1
//                    GROUP BY DY, MTH ";
//
//        $results = sqlRun::sqlRun($sql, '', array(':dateFrom' => $requests['year'] . "-01-01", ':dateTo' => $requests['year'] . "-12-31"), 'SJR', true);
//        foreach ($results as $key => $value) {
//            $returns[$value['MTH']][$value['DY']] = (int)$value['CT'];
//        }
//
//        return $returns;
//    }
//
//
//    /**
//     * Return an object of the specified occasion
//     * @param $id
//     * @return object
//     */
//    public static function getOccasion($id, $tagLinks = true, $reverseTags = true)
//    {
//        $database = getDatabaseObj();
//        $tables = $database->getSjrTables();
//        $occasion = $tables->getOccasionsFields();
//        $sql = "SELECT *
//                    FROM {$tables->getOccasions()}
//                    WHERE {$occasion->getOccasionsID()} = :id  ";
//        $results = sqlRun::sqlRun($sql, '', array(':id' => $id), 'SJR', true);
//        if (empty($results)) {
//            return '';
//        } else {
//            $occasion = new _occasions($results[0]);
//            return $occasion;
//        }
//    }
//
//    /**
//     * Checks if occasion exists, if not then inserts into the database
//     * @param $requests
//     * @return void
//     */
//    public static function insertOccasion($requests)
//    {
//        $insert = [
//            ':OccasionsName' => $requests['OccasionsName'],
//            ':OccasionsDate' => $requests['OccasionsDate'],
//        ];
//        $id = sqlRun::sqlRun('insert', 'occasions', $insert, 'SJR', false);
//
//        //  Refresh browser
//        header("Refresh: 0; url=/Occasions?year=" . date("Y", strtotime($requests['OccasionsDate'])));
//    }
//
//    /**
//     * Function to update a member's details in the database
//     * @param $requests
//     * @return void
//     */
//    public static function updateOccasion($requests)
//    {
//        $update['SET'] = [
//            ':OccasionsName' => $requests['OccasionsName'],
//            ':OccasionsDate' => $requests['OccasionsDate'],
//            ':OccasionsNotes' => $requests['OccasionsNotes'],
//        ];
//
//        $update['WHERE'] = [
//            ':OccasionsID' => $requests['OccasionID'],
//        ];
//
////        viewArray($update);
//        sqlRun::sqlRun('update', 'occasions', $update, 'SJR', false);
//
//        //  Refresh browser
////        header("Refresh: 0; url=/Occasions");
//        echo "<script>window.close();</script>";
//    }
//
//
//    /**
//     * Returns the pageVariables for the specified occasion for the EDIT OCCASION page
//     * @param $requests
//     * @return pageVariables
//     */
//    private static function editOccasion($requests)
//    {
//        $array = array(
//            'requests' => $requests,
//            'Occasions' => static::getOccasion($requests['id']),
//        );
//        $obj = new pageVariables($array);
//
//        return $obj;
//    }
//
//    public static function getMemberOccasions($MemberID)
//    {
//        $sql = "SELECT *
//                    from taglinks t
//                    where TagID = :member
//                        and TagTableID  = 1
//                        and TablesLinkID = 2
//                        and TagLinksValid = 1 ";
//        $results = sqlRun::sqlRun($sql, '', array(':member'=>$MemberID), 'SJR', true);
//        $array = [];
//        foreach($results AS $key=>$value){
//             $occasion = static::getOccasion($value['TablesID'], false, false);
//            $array[date("Y", strtotime($occasion->getOccasionsDate()))][$occasion->getOccasionsDate()][] = $occasion;
//        }
//        ksort($array);
//
//        return $array;
//    }
//
//    public static function findSpecifiedOccasion($tagName, $member)
//    {
//        //  Get TagId of the requested TAGNAME
//        $tagID = Tags::checkTagName($tagName, false);
//        //  Get Occasion that is linked to the above and also the MEMBER
//        $sql = "SELECT TablesID, COUNT(TablesID) as CT
//                    FROM taglinks
//                    WHERE (TagTableID = 0 AND TagID = :tag and TagLinksValid = 1)
//                       OR (TagTableID = 1 AND TagID = :member and TagLinksValid = 1)
//                    and TablesLinkID = 2
//                    group by TablesID
//                    having CT > 1";
//        $occasionID = sqlRun::sqlRun($sql, '', array(':tag' => $tagID['TagsID'], ':member' => $member), 'SJR', true);
//
//        return $occasionID;
//
//    }
//
//    /**
//     * Get all the members linked to an OCCASION
//     * @param $occasionID
//     * @return void
//     */
//    public static function getOccasionMembers($occasionID, $full = false)
//    {
//        $array = array(':occasion' => $occasionID);
//        $sql = "SELECT *
//                FROM taglinks
//                WHERE TablesLinkID = 2
//                    AND TagTableID = 1
//                    AND TablesID = :occasion ";
//        $results = sqlRun::sqlRun($sql, '', $array, 'SJR', true);
////viewArray($hideMember, $results); exit;
//        $return = [];
//        foreach ($results as $key => $value) {
//            if ($full) {
//                $member = Member::getMember($value['TagID']);
//                $member->setFullname($member);
//
//                $return[$key] = $member;
//            } else {
//                $return[$key] = $value['TagID'];
//            }
//        }
//        return $return;
//    }
//
//
//    public static function getAnniversaries()
//    {
//        $month = date("m");
//        $day = date("d");
//
//        $databases = getDatabaseObj();
//        $tables = $databases->getSjrTables();
//        $occasions = $tables->getOccasionsFields();
//        $sql = "SELECT *
//                    FROM {$tables->getOccasions()}
//                    WHERE
//                            MONTH({$occasions->getOccasionsDate()}) = :mth
//                        AND DAY({$occasions->getOccasionsDate()}) = :dy
//                        AND {$occasions->getOccasionsValid()} = 1
//                    ";
//
//        $results = sqlRun::sqlRun($sql, '', array(':mth' => $month, ':dy' => $day), 'SJR', true);
//        $array = [];
//        foreach ($results as $key => $value) {
//            $array[date("Y", strtotime($value['OccasionsDate']))][] = new _occasions($value);
//        }
//        ksort($array);
//        return $array;
//    }
//
//    public static function getOccasionsByLocation($LocationID){
//        $sql = "SELECT *
//                    FROm taglinks
//                    WHERE TagTableID = 4
//                        AND TagID = :location
//                        AND TablesLinkID = 2
//                        ";
//        $results = sqlRun::sqlRun($sql, '', array(':location'=>$LocationID), 'SJR', true);
//        $occasions = [];
//        foreach($results As $key=>$value){
//            $occasions[$key] = Occasion::getOccasion($value['TablesID']);
//        }
//
//        return $occasions;
//
//    }


    /**
     * Sets the required defaults variables needed for this controller and mode
     *      a) Checks all passed variables by $_REQUESTS
     *      b) NO variable passed then set a default
     */
    private static function setDefaults($requests)
    {
        if (!isset($requests['year'])) {
            $requests['year'] = date("Y");
        }

        $requests['controller'] = 'Occasions';
        return $requests;
    }


}