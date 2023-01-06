<?php

namespace App\Controllers;

use App\Models\Member;
use SJR\Controllers\RenderViews;

class Members
{
    public function __construct(){}

    /**
     *      Checks is a mode variable to passed, is so then run the function
     *          otherwise run the default
     */
    static public function main()
    {
        $requests = self::setDefaults($_REQUEST);
        if (array_key_exists('mode', $requests)) {
            $functionName = $requests['mode'];
            self::$functionName($requests);
        } else {
            $variables = Member::construct('main', $requests);
             RenderViews::renderPage(BASE_PAGE_INDEX, $variables);
        }
    }

    static private function addMember($requests){
        $variables = Member::construct('addMember', $requests);
        RenderViews::renderPage(BASE_PAGE_INDEX, $variables);
    }

    static private function insertMember($requests){
        Member::insertMember($requests);
        header('Location: /Members?error=New Member Added');
    }

    static private function updateMember($requests){
        Member::updateMember($requests);
        header('Location: /Members?error=Member Updated');
    }





    static private function setDefaults($requests)
    {
        if(!isset($requests['MemberID'])){
            $requests['MemberID'] = '1';
        }
        if(!isset($requests['error'])){
            $requests['error'] = '';
        }
        return $requests;
    }



}