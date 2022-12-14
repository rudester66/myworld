<?php

namespace Core\Databases\sjr;

use SJR\Database\sqlRun;

class _filesFields
{
    private $FileID;
    private $FileName;
    private $FileSize;
    private $FileHeight;
    private $FileWidth;
    private $FileFormat;
    private $FileType;
    private $FileValid = 1;

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

    private function filesArray(){
        return array(
            0 => 'FileID',
            1 => 'FileName',
            2 => 'FileSize',
            3 => 'FileHeight',
            4 => 'FileWidth',
            5 => 'FileFormat',
            6 => 'FileType',
            7 => 'FileValid',
        );
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
    public function getFileSize()
    {
        return $this->FileSize;
    }

    /**
     * @param mixed $FileSize
     */
    public function setFileSize($FileSize): void
    {
        $this->FileSize = $FileSize;
    }

    /**
     * @return mixed
     */
    public function getFileHeight()
    {
        return $this->FileHeight;
    }

    /**
     * @param mixed $FileHeight
     */
    public function setFileHeight($FileHeight): void
    {
        $this->FileHeight = $FileHeight;
    }

    /**
     * @return mixed
     */
    public function getFileWidth()
    {
        return $this->FileWidth;
    }

    /**
     * @param mixed $FileWidth
     */
    public function setFileWidth($FileWidth): void
    {
        $this->FileWidth = $FileWidth;
    }


    /**
     * @return mixed
     */
    public function getFileFormat()
    {
        return $this->FileFormat;
    }

    /**
     * @param mixed $FileFormat
     */
    public function setFileFormat($FileFormat): void
    {
        $this->FileFormat = $FileFormat;
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