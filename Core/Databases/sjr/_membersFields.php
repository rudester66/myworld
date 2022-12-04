<?php

namespace Core\Databases\sjr;

class _membersFields
{
    private $MemberID;
    private $Forename;
    private $Middlename;
    private $Surname;
    private $Sex;
    private $Relationship;
    private $ProfileImage;
    private $DefinitelyRelated;
    private $MemberNotes;
    private $LifeStory;
    private $MemberValid;

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



}