
<?php
    use App\Models\File;
if($obj->getOccasions()->getFileTags()) {
    //  If image file
    if(strpos($file['FileType'], 'image') > -1){
        $exif = @exif_read_data(UPLOADS_PATH . "/" . $file['FileID'] . $file['FileFormat'], 1, true);
        echo File::sortEXIF($exif);

    }
    echo "HERE";
}