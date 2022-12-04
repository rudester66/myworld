<?php

namespace SJR\Models;

class pageVariables
{
    private $requests;
    private $component;
    private $CSS;
    private $JS;

    private $Members;
    private $Locations;
    private $Occasions;
    private $Tags;
    private $Users;
    private $Settings;

    private $Files;
    private $Notes;

    //  Additional required file properties
    private $LowestID;
    private $HighestID;
    private $LastTags;
    private $MembersCombo;

    //  additional ancestry properties
    private $Censuses;
    private $LifeStory;
    private $Tree;

    //  additional florfauna
    private $Program;
    private $Category;
    private $ClassName;
    private $Item;
    private $File;

    public function __construct(array $inArray)
    {
        if(is_array($inArray))
        {
            $loop = array_keys($inArray);
            foreach($loop AS $key=>$value)
            {
                if(property_exists($this, $value)){
                    $this->$value = $inArray[$value];
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @param mixed $requests
     */
    public function setRequests($requests): void
    {
        $this->requests = $requests;
    }

    /**
     * @return mixed
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * @param mixed $component
     */
    public function setComponent($component): void
    {
        $this->component = $component;
    }

    /**
     * @return mixed
     */
    public function getCSS()
    {
        return $this->CSS;
    }

    /**
     * @param mixed $CSS
     */
    public function setCSS($CSS): void
    {
        $this->CSS = $CSS;
    }

    /**
     * @return mixed
     */
    public function getJS()
    {
        return $this->JS;
    }

    /**
     * @param mixed $JS
     */
    public function setJS($JS): void
    {
        $this->JS = $JS;
    }

    /**
     * @return mixed
     */
    public function getMembers()
    {
        return $this->Members;
    }

    /**
     * @param mixed $Members
     */
    public function setMembers($Members): void
    {
        $this->Members = $Members;
    }

    /**
     * @return mixed
     */
    public function getLocations()
    {
        return $this->Locations;
    }

    /**
     * @param mixed $Locations
     */
    public function setLocations($Locations): void
    {
        $this->Locations = $Locations;
    }



    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->Files;
    }

    /**
     * @param mixed $Files
     */
    public function setFiles($Files): void
    {
        $this->Files = $Files;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->Notes;
    }

    /**
     * @param mixed $Notes
     */
    public function setNotes($Notes): void
    {
        $this->Notes = $Notes;
    }


    /**
     * @return mixed
     */
    public function getLowestID()
    {
        return $this->LowestID;
    }

    /**
     * @param mixed $LowestID
     */
    public function setLowestID($LowestID): void
    {
        $this->LowestID = $LowestID;
    }

    /**
     * @return mixed
     */
    public function getHighestID()
    {
        return $this->HighestID;
    }

    /**
     * @param mixed $HighestID
     */
    public function setHighestID($HighestID): void
    {
        $this->HighestID = $HighestID;
    }

    /**
     * @return mixed
     */
    public function getOccasions()
    {
        return $this->Occasions;
    }

    /**
     * @param mixed $Occasions
     */
    public function setOccasions($Occasions): void
    {
        $this->Occasions = $Occasions;
    }

    /**
     * @return mixed
     */
    public function getLastTags()
    {
        return $this->LastTags;
    }

    /**
     * @param mixed $lastTags
     */
    public function setLastTags($lastTags): void
    {
        $this->LastTags = $lastTags;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->Tags;
    }

    /**
     * @param mixed $Tags
     */
    public function setTags($Tags): void
    {
        $this->Tags = $Tags;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->Users;
    }

    /**
     * @param mixed $Users
     */
    public function setUsers($Users): void
    {
        $this->Users = $Users;
    }

    /**
     * @return mixed
     */
    public function getSettings()
    {
        return $this->Settings;
    }

    /**
     * @param mixed $Settings
     */
    public function setSettings($Settings): void
    {
        $this->Settings = $Settings;
    }


    /**
     * @return mixed
     */
    public function getMembersCombo()
    {
        return $this->MembersCombo;
    }

    /**
     * @param mixed $MembersCombo
     */
    public function setMembersCombo($MembersCombo): void
    {
        $this->MembersCombo = $MembersCombo;
    }

    /**
     * @return mixed
     */
    public function getCensuses()
    {
        return $this->Censuses;
    }

    /**
     * @param mixed $Censuses
     */
    public function setCensuses($Censuses): void
    {
        $this->Censuses = $Censuses;
    }

    /**
     * @return mixed
     */
    public function getProgram()
    {
        return $this->Program;
    }

    /**
     * @param mixed $Program
     */
    public function setProgram($Program): void
    {
        $this->Program = $Program;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->Category;
    }

    /**
     * @param mixed $Category
     */
    public function setCategory($Category): void
    {
        $this->Category = $Category;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->ClassName;
    }

    /**
     * @param mixed $ClassName
     */
    public function setClassName($ClassName): void
    {
        $this->ClassName = $ClassName;
    }

    /**
     * @return mixed
     */
    public function getItem()
    {
        return $this->Item;
    }

    /**
     * @param mixed $Item
     */
    public function setItem($Item): void
    {
        $this->Item = $Item;
    }

    /**
     * @return mixed
     */
    public function getLifeStory()
    {
        return $this->LifeStory;
    }

    /**
     * @param mixed $LifeStory
     */
    public function setLifeStory($LifeStory): void
    {
        $this->LifeStory = $LifeStory;
    }

    /**
     * @return mixed
     */
    public function getTree()
    {
        return $this->Tree;
    }

    /**
     * @param mixed $Tree
     */
    public function setTree($Tree): void
    {
        $this->Tree = $Tree;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->File;
    }

    /**
     * @param mixed $File
     */
    public function setFile($File): void
    {
        $this->File = $File;
    }











}