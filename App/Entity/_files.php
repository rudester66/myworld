<?php

namespace App\Entity;

use SJR\Database\sqlRun;

class _files
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
     * @return int
     */
    public function getFileValid(): int
    {
        return $this->FileValid;
    }

    /**
     * @param int $FileValid
     */
    public function setFileValid(int $FileValid): void
    {
        $this->FileValid = $FileValid;
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
        foreach($this->filesArray() AS $key=>$value){
            $insert[':' .$value] = $this->$value;
        }
        $this->Insert  = sqlRun::sqlRun('insert', 'files', $insert, 'MYWORLD', false);
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
        foreach($this->filesArray() AS $key=>$value){
            $set[':' .$value] = $this->$value;
        }
        $update = array(
            'SET' => $set,
            'WHERE' => array(
                ':FileID' => $this->FileID,
            ),
        );
        $this->Update  = sqlRun::sqlRun('update', 'files', $update, 'MYWORLD', false);
    }




}