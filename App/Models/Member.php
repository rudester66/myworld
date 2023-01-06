<?php

namespace App\Models;

use App\Entity\_members;
use SJR\Database\databaseObjFunction;
use SJR\Database\sqlRun;
use SJR\Models\pageVariables;

class Member
{


    /**
     * Member constructor.
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
        $array = array(
            'requests' => $requests,
            'component' => VIEW_PATH . '/Members/pages/main.php',
            'CSS' => array(
                0 => 'Core/CSS/Members.css',
            ),
            'JS' => array(
                0 => 'Core/JS/Members.js',
            ),
        );
//        viewArray($array);exit;
        $obj = new pageVariables($array);

        return $obj;
    }

    private static function addMember($requests)
    {
        $array = array(
            'requests' => $requests,
            'component' => VIEW_PATH . '/Members/pages/addMember.php',
            'CSS' => array(
                0 => 'Core/CSS/Members.css',
            ),
            'JS' => array(
                0 => 'Core/JS/Members.js',
            ),
        );
        $obj = new pageVariables($array);

        return $obj;
    }


    static public function searchTable($txt)
    {
        $db = databaseObjFunction::getMYWORLD();
        $members = $db->getMembersFields();
        //  Split the text
        $misc = explode(" ", $txt);
        $sql = "SELECT *
                    FROM {$db->getMembers()}
                    WHERE ( ";
        foreach ($misc as $key => $value) {
            if ($key > 0) {
                $sql .= " AND ";
            }
            $sql .= " CONCAT({$members->getConcat()}) LIKE '%" . $value . "%' ";
        }
        $sql .= ") ";
        return sqlRun::sqlRun($sql, '', array(), 'MYWORLD');
    }


    static public function insertMember($requests)
    {
        $member = new _members($requests);
        if($member->getDOB() == ''){
            $member->setDOB(null);
        }
        if($member->getDOD() == ''){
            $member->setDOD(null);
        }
        $member->setInsert();
        viewArray($member);

    }


    /**
     * Sets the required defaults variables needed for this controller and mode
     *      a) Checks all passed variables by $_REQUESTS
     *      b) NO variable passed then set a default
     */
    private static function setDefaults($requests)
    {

        $requests['controller'] = 'Members';
        return $requests;
    }


}