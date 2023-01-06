<?php

namespace App\Models;

class Tag
{

    static public function searchTable($table, $txt){
        $class = '\App\Models\\' .rtrim($table, "s");
        return $class::searchTable($txt);
    }


    static public function searchInput($name){
        return "<input type='text' name='{$name}Text' class='uk-width-1-1 searchInput' table='{$name}' placeholder='Search for {$name}' >";
    }





}