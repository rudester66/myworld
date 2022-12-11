<?php

namespace App\Models;

use App\Entity\_files;
use App\Entity\_taglinks;
use Core\Configs\sqlRun;

class File
{


    public static function uploadFile($requests)
    {
        $tmpFile = $_FILES['files'];
        $FileName = $tmpFile['name'][0];
        $FileFormat = substr($FileName, strrpos($FileName, "."), 10);
        $file_tmpname = $tmpFile['tmp_name'][0];
        $imagesize = getimagesize($file_tmpname);
        $file = new _files(array());
        $file->setFileName($FileName);
        $file->setFileSize($tmpFile['size'][0]);
        $file->setFileWidth($imagesize[0]);
        $file->setFileHeight($imagesize[1]);
        $file->setFileFormat($FileFormat);
        $file->setFileType($tmpFile['type'][0]);
        $file->setInsert();

        $fileID = $file->getInsert();
viewArray($fileID);
        //  If a number number (ID) is returned, move file and add tags
        if(is_numeric($fileID)){
            //  Copy files into the uploads directory
            move_uploaded_file($file_tmpname, UPLOADS_PATH . '/' . $fileID .$FileFormat);

            //  Insert TagLink and ReverseTagLink into table
            $ItemTypeID = $requests['ItemType'];
            $ItemID = $requests['ItemID'];
            $tagLink = new _taglinks(array());
            $tagLink->setItemTypeID($ItemTypeID);
            $tagLink->setItemID($ItemID);
            $tagLink->setTagTypeID(1);
            $tagLink->setTagID($fileID);
            $tagLink->setInsert();

            //  Reverse TagLink
            $tagLink->setItemTypeID(1);
            $tagLink->setItemID($fileID);
            $tagLink->setTagTypeID($ItemTypeID);
            $tagLink->setTagID($ItemID);
            $tagLink->setInsert();
        }
        viewArray($_FILES, $fileID, $file);

    }



}