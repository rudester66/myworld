<?php

namespace Core\Databases\sjr;

class _tagsFields
{
    private $TagsID;
    private $TagsName;
    private $TagsValid;

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
    public function getTagsID()
    {
        return $this->TagsID;
    }

    /**
     * @param mixed $TagsID
     */
    public function setTagsID($TagsID): void
    {
        $this->TagsID = $TagsID;
    }

    /**
     * @return mixed
     */
    public function getTagsName()
    {
        return $this->TagsName;
    }

    /**
     * @param mixed $TagsName
     */
    public function setTagsName($TagsName): void
    {
        $this->TagsName = $TagsName;
    }

    /**
     * @return mixed
     */
    public function getTagsValid()
    {
        return $this->TagsValid;
    }

    /**
     * @param mixed $TagsValid
     */
    public function setTagsValid($TagsValid): void
    {
        $this->TagsValid = $TagsValid;
    }



}