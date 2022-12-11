<?php

namespace App\Controllers;

use App\Models\File;
use App\Models\Occasion;
use SJR\Controllers\RenderViews;

class Occasions
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
            $variables = Occasion::construct('main', $requests);
             RenderViews::renderPage(BASE_PAGE_INDEX, $variables);
        }
    }

    static private function addOccasion($requests){
        $variables = Occasion::construct('addOccasion', $requests);
        RenderViews::renderPage(BASE_PAGE_INDEX, $variables);
    }

    static private function insertOccasion($requests){
        Occasion::insertOccasion($requests);
        $month = date("Y-m", strtotime($requests['OccasionsDate']));
        header('Location: /Occasions?month=' .$month ."&error=New Occassion Added");
    }

    static private function updateOccasion($requests){
        Occasion::updateOccasion($requests);
        $month = date("Y-m", strtotime($requests['OccasionsDate']));
        header('Location: /Occasions?month=' .$month ."&error=Occassion Updated");
    }



    static private function uploadImagesFiles($requests){
        ob_clean();
        $requests['ItemType'] = 0;
        $requests['ItemID'] = $requests['occasionID'];
        File::uploadFile($requests);
    }

    static private function setDefaults($requests)
    {
        if(!isset($requests['month'])){
            $requests['month'] = date("Y-m");
        }
        if(!isset($requests['occasionID'])){
            $requests['occasionID'] = '';
        }
        if(!isset($requests['occasionDate'])){
            $requests['occasionDate'] = '';
        }
        if(!isset($requests['error'])){
            $requests['error'] = '';
        }
        if(!isset($requests['fileNo'])){
            $requests['fileNo'] = 0;
        }
        $requests['dateFrom'] = $requests['month'] . "-01";
        $requests['dateTo'] = date("Y-m-t", strtotime($requests['month'] . "-01"));

        return $requests;
    }



}