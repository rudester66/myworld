<?php

namespace App\Entity;

use App\Models\TagLink;

class occasionsPage
{
    private $occasionID;
    private $monthOccasions;
    private $dayOccasions;
    private $occasion;
    private $AllTags;
    private $FileTags;

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

    /**
     * @return mixed
     */
    public function getOccasionID()
    {
        return $this->occasionID;
    }

    /**
     * @param mixed $occasionID
     */
    public function setOccasionID($occasionID): void
    {
        $this->occasionID = $occasionID;
    }

    /**
     * @return mixed
     */
    public function getMonthOccasions()
    {
        return $this->monthOccasions;
    }

    /**
     * @param mixed $monthOccasions
     */
    public function setMonthOccasions($monthOccasions): void
    {
        $this->monthOccasions = $monthOccasions;
    }

    /**
     * @return mixed
     */
    public function getDayOccasions()
    {
        return $this->dayOccasions;
    }

    /**
     * @param mixed $dayOccasions
     */
    public function setDayOccasions($dayOccasions): void
    {
        $this->dayOccasions = $dayOccasions;
    }

    /**
     * @return mixed
     */
    public function getOccasion()
    {
        return $this->occasion;
    }

    /**
     * @param mixed $occasion
     */
    public function setOccasion($occasion): void
    {
        $this->occasion = $occasion;
    }

    /**
     * @return mixed
     */
    public function getAllTags()
    {
        return $this->AllTags;
    }

    /**
     * @param mixed $AllTags
     */
    public function setAllTags(): void
    {
        $this->AllTags = TagLink::getAllTags(0, $this->getOccasionID());

    }

    /**
     * @return mixed
     */
    public function getFileTags()
    {
        if(array_key_exists(1, $this->AllTags)){
            return $this->AllTags[1];
        } else {
            return $this->FileTags;
        }
    }

    /**
     * @param mixed $FileTags
     */
    public function setFileTags($FileTags): void
    {
        $this->FileTags = $FileTags;
    }



}