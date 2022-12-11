<?php

namespace App\Entity;

use SJR\Database\sqlRun;

class _taglinks
{
    private $TagLinksID;
    private $ItemTypeID;
    private $ItemID;
    private $TagTypeID;
    private $TagID;
    private $TagLinksValid = 1;

    //  Additional Fields
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

    private function tagsLinksArray()
    {
        return array(
            0 => 'TagLinksID',
            1 => 'ItemTypeID',
            2 => 'ItemID',
            3 => 'TagTypeID',
            4 => 'TagID',
            5 => 'TagLinksValid',
        );
    }

    /**
     * @return mixed
     */
    public function getTagLinksID()
    {
        return $this->TagLinksID;
    }

    /**
     * @param mixed $TagLinksID
     */
    public function setTagLinksID($TagLinksID): void
    {
        $this->TagLinksID = $TagLinksID;
    }

    /**
     * @return mixed
     */
    public function getItemTypeID()
    {
        return $this->ItemTypeID;
    }

    /**
     * @param mixed $ItemTypeID
     */
    public function setItemTypeID($ItemTypeID): void
    {
        $this->ItemTypeID = $ItemTypeID;
    }

    /**
     * @return mixed
     */
    public function getItemID()
    {
        return $this->ItemID;
    }

    /**
     * @param mixed $ItemID
     */
    public function setItemID($ItemID): void
    {
        $this->ItemID = $ItemID;
    }

    /**
     * @return mixed
     */
    public function getTagTypeID()
    {
        return $this->TagTypeID;
    }

    /**
     * @param mixed $TagTypeID
     */
    public function setTagTypeID($TagTypeID): void
    {
        $this->TagTypeID = $TagTypeID;
    }

    /**
     * @return mixed
     */
    public function getTagID()
    {
        return $this->TagID;
    }

    /**
     * @param mixed $TagID
     */
    public function setTagID($TagID): void
    {
        $this->TagID = $TagID;
    }

    /**
     * @return int
     */
    public function getTagLinksValid(): int
    {
        return $this->TagLinksValid;
    }

    /**
     * @param int $TagLinksValid
     */
    public function setTagLinksValid(int $TagLinksValid): void
    {
        $this->TagLinksValid = $TagLinksValid;
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
        foreach($this->tagsLinksArray() AS $key=>$value){
            $insert[':' .$value] = $this->$value;
        }
        $this->Insert  = sqlRun::sqlRun('insert', 'taglinks', $insert, 'MYWORLD', false);
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
        foreach($this->tagsLinksArray() AS $key=>$value){
            $set[':' .$value] = $this->$value;
        }
        $update = array(
            'SET' => $set,
            'WHERE' => array(
                ':FileID' => $this->FileID,
            ),
        );
        $this->Update  = sqlRun::sqlRun('update', 'taglinks', $update, 'MYWORLD', false);
    }




}