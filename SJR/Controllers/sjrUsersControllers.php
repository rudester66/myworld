<?php

namespace SJR\Controllers;

use SJR\Controllers\RenderViews;
use SJR\Models\abstractDefaults;
use SJR\Models\sjr;

class sjrUsersControllers extends abstractDefaults
{

    public function __construct(array $requests){ }

    /**
     * If no mode is passed, then defaults to the MAIN DIARY page,  showing all members and ADD DIARY
     * @return void
     */
    public function main()
    {
        $requests = static::setDefaults($_REQUEST);
        if (array_key_exists('mode', $requests)) {
            $functionName = $this->requests['mode'];
            self::$functionName($requests);
        } else {

        }
    }


    private function AddNewAdminUser($requests){
        viewArray($requests);exit;
//        $requests['component'] = VIEW_PATH .'/Ancestry/Pages/ancestry.php';
//        $variables = sjr::construct('main', $requests);
//        RenderViews::renderPage(BASE_PAGE_INDEX, $variables);

    }

    public function setDefaults(array $requests): array
    {
        if(!isset($requests['MemberID'])){
            $requests['MemberID'] = 1;
        }

        return $requests;
    }


}