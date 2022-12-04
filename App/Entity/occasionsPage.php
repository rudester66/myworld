<?php

namespace App\Entity;

class occasionsPage
{
    private $monthOccasions;
    private $dayOccasions;
    private $occasion;

    public function __construct(array $inArray)
    {
        $loop = array_keys($inArray);
        foreach ($loop as $key => $value) {
            if (property_exists($this, $value)) {
                $this->$value = $inArray[$value];
            }
        }
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


}