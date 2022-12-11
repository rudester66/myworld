<?php

namespace Core\Databases\sjr;

class _occasionsFields
{
    private $OccasionsID;
    private $OccasionsName;
    private $OccasionsDate;
    private $OccasionsNotes;
    private $OccasionsValid ;

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
    public function getOccasionsID()
    {
        return $this->OccasionsID;
    }

    /**
     * @param mixed $OccasionsID
     */
    public function setOccasionsID($OccasionsID): void
    {
        $this->OccasionsID = $OccasionsID;
    }

    /**
     * @return mixed
     */
    public function getOccasionsName()
    {
        return $this->OccasionsName;
    }

    /**
     * @param mixed $OccasionsName
     */
    public function setOccasionsName($OccasionsName): void
    {
        $this->OccasionsName = $OccasionsName;
    }

    /**
     * @return mixed
     */
    public function getOccasionsDate()
    {
        return $this->OccasionsDate;
    }

    /**
     * @param mixed $OccasionsDate
     */
    public function setOccasionsDate($OccasionsDate): void
    {
        $this->OccasionsDate = $OccasionsDate;
    }

    /**
     * @return mixed
     */
    public function getOccasionsNotes()
    {
        return $this->OccasionsNotes;
    }

    /**
     * @param mixed $OccasionsNotes
     */
    public function setOccasionsNotes($OccasionsNotes): void
    {
        $this->OccasionsNotes = $OccasionsNotes;
    }

    /**
     * @return mixed
     */
    public function getOccasionsValid()
    {
        return $this->OccasionsValid;
    }

    /**
     * @param mixed $OccasionsValid
     */
    public function setOccasionsValid($OccasionsValid): void
    {
        $this->OccasionsValid = $OccasionsValid;
    }




}