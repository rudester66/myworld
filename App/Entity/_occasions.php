<?php

namespace App\Entity;

use App\Models\Occasion;
use App\Models\TagLink;
use SJR\Database\sqlRun;

class _occasions
{
    private $OccasionsID;
    private $OccasionsName;
    private $OccasionsDate;
    private $OccasionsNotes;
    private $OccasionsValid = 1;

    //  Additional Fields

    //  Functions
    private $SelectOne;
    private $SelectMany;
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

    private function occassionsArray(){
        return array(
            0 => 'OccasionsID',
            1 => 'OccasionsName',
            2 => 'OccasionsDate',
            3 => 'OccasionsNotes',
            4 => 'OccasionsValid',
        );
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

    /**
     * @return mixed
     */
    public function getSelectOne()
    {
        return $this->SelectOne;
    }

    /**
     * @param mixed $SelectOne
     */
    public function setSelectOne($id): void
    {
        $results = Occasion::getOccasion($id);
        foreach($this->occassionsArray() AS $key=>$value){
            $prop = 'set' .$value;
            $this->$prop($results[$value]);
        }
    }

    /**
     * @return mixed
     */
    public function getSelectMany()
    {
        return $this->SelectMany;
    }

    /**
     * @param mixed $SelectMany
     */
    public function setSelectMany($SelectMany): void
    {
        $this->SelectMany = $SelectMany;
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
        foreach($this->occassionsArray() AS $key=>$value){
            $insert[':' .$value] = $this->$value;
        }
        $this->Insert  = sqlRun::sqlRun('insert', 'occasions', $insert, 'MYWORLD', false);
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
    public function setUpdate(): void
    {
        $set = array();
        foreach($this->occassionsArray() AS $key=>$value){
            $set[':' .$value] = $this->$value;
        }
        $update = array(
            'SET' => $set,
            'WHERE' => array(
                ':OccasionsID' => $this->OccasionsID,
            ),
        );
        $this->Update  = sqlRun::sqlRun('update', 'occasions', $update, 'MYWORLD', false);
    }




}