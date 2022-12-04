<?php

namespace SJR\Database;

class settingsPage
{
    private $UserSettings;
    private $UsersSetting;

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
    public function getUserSettings()
    {
        return $this->UserSettings;
    }

    /**
     * @param mixed $UserSettings
     */
    public function setUserSettings($UserSettings): void
    {
        $this->UserSettings = $UserSettings;
    }

    /**
     * @return mixed
     */
    public function getUsersSetting()
    {
        return $this->UsersSetting;
    }

    /**
     * @param mixed $UsersSetting
     */
    public function setUsersSetting($UsersSetting): void
    {
        $this->UsersSetting = $UsersSetting;
    }



}