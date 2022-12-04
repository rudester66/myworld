<?php

namespace Core\Databases\sjr;

class _filesFields
{
    private $FileID;
    private $FileName;
    private $FileType;
    private $FileLink;
    private $FileDate;
    private $FileRotation;
    private $FileSorted;
    private $FloraFaunaSorted;
    private $FileValid;

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
    public function getFileID()
    {
        return $this->FileID;
    }

    /**
     * @param mixed $FileID
     */
    public function setFileID($FileID): void
    {
        $this->FileID = $FileID;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->FileName;
    }

    /**
     * @param mixed $FileName
     */
    public function setFileName($FileName): void
    {
        $this->FileName = $FileName;
    }

    /**
     * @return mixed
     */
    public function getFileType()
    {
        return $this->FileType;
    }

    /**
     * @param mixed $FileType
     */
    public function setFileType($FileType): void
    {
        $this->FileType = $FileType;
    }

    /**
     * @return mixed
     */
    public function getFileLink()
    {
        return $this->FileLink;
    }

    /**
     * @param mixed $FileLink
     */
    public function setFileLink($FileLink): void
    {
        $this->FileLink = $FileLink;
    }

    /**
     * @return mixed
     */
    public function getFileDate()
    {
        return $this->FileDate;
    }

    /**
     * @param mixed $FileDate
     */
    public function setFileDate($FileDate): void
    {
        $this->FileDate = $FileDate;
    }

    /**
     * @return mixed
     */
    public function getFileRotation()
    {
        return $this->FileRotation;
    }

    /**
     * @param mixed $FileRotation
     */
    public function setFileRotation($FileRotation): void
    {
        $this->FileRotation = $FileRotation;
    }

    /**
     * @return mixed
     */
    public function getFileSorted()
    {
        return $this->FileSorted;
    }

    /**
     * @param mixed $FileSorted
     */
    public function setFileSorted($FileSorted): void
    {
        $this->FileSorted = $FileSorted;
    }

    /**
     * @return mixed
     */
    public function getFloraFaunaSorted()
    {
        return $this->FloraFaunaSorted;
    }

    /**
     * @param mixed $FloraFaunaSorted
     */
    public function setFloraFaunaSorted($FloraFaunaSorted): void
    {
        $this->FloraFaunaSorted = $FloraFaunaSorted;
    }

    /**
     * @return mixed
     */
    public function getFileValid()
    {
        return $this->FileValid;
    }

    /**
     * @param mixed $FileValid
     */
    public function setFileValid($FileValid): void
    {
        $this->FileValid = $FileValid;
    }


}