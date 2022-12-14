<?php

namespace Core\Databases\sjr;

use SJR\Database\sqlRun;

class _taglinksFields
{
    private $TagLinksID;
    private $ItemTypeID;
    private $ItemID;
    private $TagTypeID;
    private $TagID;
    private $TagLinksValid;


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
     * @return mixed
     */
    public function getTagLinksValid()
    {
        return $this->TagLinksValid;
    }

    /**
     * @param mixed $TagLinksValid
     */
    public function setTagLinksValid($TagLinksValid): void
    {
        $this->TagLinksValid = $TagLinksValid;
    }



}