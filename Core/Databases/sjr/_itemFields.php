<?php

namespace Core\Databases\sjr;

class _itemFields
{
    private $ItemID;
    private $ProgramID;
    private $ItemName;
    private $LatinName;
    private $ItemNotes;
    private $ItemLink;
    private $ItemValid;

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
    public function getProgramID()
    {
        return $this->ProgramID;
    }

    /**
     * @param mixed $ProgramID
     */
    public function setProgramID($ProgramID): void
    {
        $this->ProgramID = $ProgramID;
    }

    /**
     * @return mixed
     */
    public function getItemName()
    {
        return $this->ItemName;
    }

    /**
     * @param mixed $ItemName
     */
    public function setItemName($ItemName): void
    {
        $this->ItemName = $ItemName;
    }

    /**
     * @return mixed
     */
    public function getLatinName()
    {
        return $this->LatinName;
    }

    /**
     * @param mixed $LatinName
     */
    public function setLatinName($LatinName): void
    {
        $this->LatinName = $LatinName;
    }

    /**
     * @return mixed
     */
    public function getItemNotes()
    {
        return $this->ItemNotes;
    }

    /**
     * @param mixed $ItemNotes
     */
    public function setItemNotes($ItemNotes): void
    {
        $this->ItemNotes = $ItemNotes;
    }

    /**
     * @return mixed
     */
    public function getItemLink()
    {
        return $this->ItemLink;
    }

    /**
     * @param mixed $ItemLink
     */
    public function setItemLink($ItemLink): void
    {
        $this->ItemLink = $ItemLink;
    }

    /**
     * @return mixed
     */
    public function getItemValid()
    {
        return $this->ItemValid;
    }

    /**
     * @param mixed $ItemValid
     */
    public function setItemValid($ItemValid): void
    {
        $this->ItemValid = $ItemValid;
    }



}