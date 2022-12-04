<?php

namespace Core\Databases\sjr;

class _taglinksFields
{
    private $TagLinksID;
    private $TagTableID;
    private $TagID;
    private $TablesLinkID;
    private $TablesID;
    private $TagLinksValid;

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
    public function getTagTableID()
    {
        return $this->TagTableID;
    }

    /**
     * @param mixed $TagTableID
     */
    public function setTagTableID($TagTableID): void
    {
        $this->TagTableID = $TagTableID;
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
    public function getTablesLinkID()
    {
        return $this->TablesLinkID;
    }

    /**
     * @param mixed $TablesLinkID
     */
    public function setTablesLinkID($TablesLinkID): void
    {
        $this->TablesLinkID = $TablesLinkID;
    }

    /**
     * @return mixed
     */
    public function getTablesID()
    {
        return $this->TablesID;
    }

    /**
     * @param mixed $TablesID
     */
    public function setTablesID($TablesID): void
    {
        $this->TablesID = $TablesID;
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