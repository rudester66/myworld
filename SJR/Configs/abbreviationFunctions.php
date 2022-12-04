<?php

//  Date format
function d($date)
{
    return date("d/m/Y", strtotime($date));
}

//  Full Date Format
function fd($date)
{
    return date("l d/m/Y", strtotime($date));
}

//  Full Date Format in text
function td($date)
{
    return date("l jS F Y", strtotime($date));
}

//  Add slashes
function e($str)
{
    return addslashes($str);
}

function si($img, $h, $w)
{
    $details = getImageHeightWidth($img, $h, $w);

    return $details;
}

function redirect_to($location) {
    header("Location: " . $location);
    exit;
}

function trueFalse($value){
    if($value == 1){
        return 'true';
    } else {
        return 'false';
    }
}

function yesNo($value){
    if($value == 1){
        return 'yes';
    } else {
        return 'no';
    }
}


function Years($dateFrom, $dateTo){

    $d1 = new DateTime($dateFrom);
    $d2 = new DateTime($dateTo);

    $diff = $d2->diff($d1);

    return $diff->y;
}


