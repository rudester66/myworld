<?php

namespace App\Entity;

use SJR\Database\sqlRun;

class _members
{

    private $MemberID;
    private $Forename;
    private $Middlename;
    private $Surname;
    private $DOB;
    private $DOD;
    private $Sex;
    private $Relationship;
    private $ProfileImage;
    private $DefinitelyRelated;
    private $MemberNotes;
    private $LifeStory;
    private $MemberValid;

    private $Insert;
    private $Update;

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


    private function privateArray(){
        return [
            0 => 'MemberID',
            1 => 'Forename',
            2 => 'Middlename',
            3 => 'Surname',
            4 => 'DOB',
            5 => 'DOD',
            6 => 'Sex',
            7 => 'Relationship',
            8 => 'ProfileImage',
            9 => 'DefinitelyRelated',
            10 => 'MemberNotes',
            11 => 'LifeStory',
            12 => 'MemberValid',
        ];
    }

    /**
     * @return mixed
     */
    public function getMemberID()
    {
        return $this->MemberID;
    }

    /**
     * @param mixed $MemberID
     */
    public function setMemberID($MemberID): void
    {
        $this->MemberID = $MemberID;
    }

    /**
     * @return mixed
     */
    public function getForename()
    {
        return $this->Forename;
    }

    /**
     * @param mixed $Forename
     */
    public function setForename($Forename): void
    {
        $this->Forename = $Forename;
    }

    /**
     * @return mixed
     */
    public function getMiddlename()
    {
        return $this->Middlename;
    }

    /**
     * @param mixed $Middlename
     */
    public function setMiddlename($Middlename): void
    {
        $this->Middlename = $Middlename;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->Surname;
    }

    /**
     * @param mixed $Surname
     */
    public function setSurname($Surname): void
    {
        $this->Surname = $Surname;
    }

    /**
     * @return mixed
     */
    public function getDOB()
    {
        return $this->DOB;
    }

    /**
     * @param mixed $DOB
     */
    public function setDOB($DOB): void
    {
        $this->DOB = $DOB;
    }

    /**
     * @return mixed
     */
    public function getDOD()
    {
        return $this->DOD;
    }

    /**
     * @param mixed $DOD
     */
    public function setDOD($DOD): void
    {
        $this->DOD = $DOD;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->Sex;
    }

    /**
     * @param mixed $Sex
     */
    public function setSex($Sex): void
    {
        $this->Sex = $Sex;
    }

    /**
     * @return mixed
     */
    public function getRelationship()
    {
        return $this->Relationship;
    }

    /**
     * @param mixed $Relationship
     */
    public function setRelationship($Relationship): void
    {
        $this->Relationship = $Relationship;
    }

    /**
     * @return mixed
     */
    public function getProfileImage()
    {
        return $this->ProfileImage;
    }

    /**
     * @param mixed $ProfileImage
     */
    public function setProfileImage($ProfileImage): void
    {
        $this->ProfileImage = $ProfileImage;
    }

    /**
     * @return mixed
     */
    public function getDefinitelyRelated()
    {
        return $this->DefinitelyRelated;
    }

    /**
     * @param mixed $DefinitelyRelated
     */
    public function setDefinitelyRelated($DefinitelyRelated): void
    {
        $this->DefinitelyRelated = $DefinitelyRelated;
    }

    /**
     * @return mixed
     */
    public function getMemberNotes()
    {
        return $this->MemberNotes;
    }

    /**
     * @param mixed $MemberNotes
     */
    public function setMemberNotes($MemberNotes): void
    {
        $this->MemberNotes = $MemberNotes;
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
    public function getMemberValid()
    {
        return $this->MemberValid;
    }

    /**
     * @param mixed $MemberValid
     */
    public function setMemberValid($MemberValid): void
    {
        $this->MemberValid = $MemberValid;
    }

    /**
     * @return mixed
     */
    public function getInsert()
    {
        return $this->Insert;
    }

    /**
     * @param mixed $Insert
     */
    public function setInsert(): void
    {
        $insert = array();
        foreach($this->privateArray() AS $key=>$value){
            $insert[':' .$value] = $this->$value;
        }
        $this->Insert  = sqlRun::sqlRun('insert', 'members', $insert, 'MYWORLD', false);

    }

    /**
     * @return mixed
     */
    public function getUpdate()
    {
        return $this->Update;
    }

    /**
     * @param mixed $Update
     */
    public function setUpdate($Update): void
    {
        $set = array();
        foreach($this->privateArray() AS $key=>$value){
            $set[':' .$value] = $this->$value;
        }
        $update = array(
            'SET' => $set,
            'WHERE' => array(
                ':MemberID' => $this->MemberID,
            ),
        );
        $this->Update  = sqlRun::sqlRun('update', 'members', $update, 'MYWORLD', false);
    }




}