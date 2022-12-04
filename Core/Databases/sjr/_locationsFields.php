<?php

namespace Core\Databases\sjr;

class _locationsFields
{
    private $LocationID;
    private $LocationName;
    private $IconName;
    private $LocationAddress;
    private $LocationNotes;
    private $Latitude;
    private $Longitude;
    private $LocationValid;

    //  Additional Fields

    public function __construct(array $inArray)
    {
        if (is_array($inArray)) {
            $loop = array_keys($inArray);
            foreach ($loop as $key => $value) {
                if (property_exists($this, $value)) {
                    $this->$value = $inArray[$value];
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getLocationID()
    {
        return $this->LocationID;
    }

    /**
     * @param mixed $LocationID
     */
    public function setLocationID($LocationID): void
    {
        $this->LocationID = $LocationID;
    }

    /**
     * @return mixed
     */
    public function getLocationName()
    {
        return $this->LocationName;
    }

    /**
     * @param mixed $LocationName
     */
    public function setLocationName($LocationName): void
    {
        $this->LocationName = $LocationName;
    }

    /**
     * @return mixed
     */
    public function getIconName()
    {
        return $this->IconName;
    }

    /**
     * @param mixed $IconName
     */
    public function setIconName($IconName): void
    {
        $this->IconName = $IconName;
    }

    /**
     * @return mixed
     */
    public function getLocationAddress()
    {
        return $this->LocationAddress;
    }

    /**
     * @param mixed $LocationAddress
     */
    public function setLocationAddress($LocationAddress): void
    {
        $this->LocationAddress = $LocationAddress;
    }

    /**
     * @return mixed
     */
    public function getLocationNotes()
    {
        return $this->LocationNotes;
    }

    /**
     * @param mixed $LocationNotes
     */
    public function setLocationNotes($LocationNotes): void
    {
        $this->LocationNotes = $LocationNotes;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->Latitude;
    }

    /**
     * @param mixed $Latitude
     */
    public function setLatitude($Latitude): void
    {
        $this->Latitude = $Latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->Longitude;
    }

    /**
     * @param mixed $Longitude
     */
    public function setLongitude($Longitude): void
    {
        $this->Longitude = $Longitude;
    }

    /**
     * @return mixed
     */
    public function getLocationValid()
    {
        return $this->LocationValid;
    }

    /**
     * @param mixed $LocationValid
     */
    public function setLocationValid($LocationValid): void
    {
        $this->LocationValid = $LocationValid;
    }


}