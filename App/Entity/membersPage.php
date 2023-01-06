<?php

namespace App\Entity;

class membersPage
{
    private $MemberID;


    public function __construct(array $inArray)
    {
        $loop = array_keys($inArray);
        foreach ($loop as $key => $value) {
            if (property_exists($this, $value)) {
                $this->$value = $inArray[$value];
            }
        }
        self::setAllTags();
    }



}