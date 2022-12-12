<style>
    #occasionImage {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
</style>
<?php
echo sjrButton('a', 'primary', '#', 'upload', ' Upload File', '', ' id="uploadFileButton"');
include VIEW_PATH . "/Occasions/components/uploadFile.php";
if ($obj->getOccasions()->getFileTags()) {
    ?>
    <div uk-grid class="uk-width-1-1">
        <div class="uk-text-center " style="width: 100%; height: 70vh; margin-top: 2vh;">
            <?php
            $file = $obj->getOccasions()->getFileTags()[$obj->getRequests()['fileNo']];
//            viewArray($file['FileType']);
            if (strpos($file['FileType'], 'image') > -1) {
                ?>
                <img src="Core/Uploads/<?php echo $file['FileID'] . $file['FileFormat'] ?>" id="occasionImage">
            <?php } else if (strpos($file['FileType'], 'video') > -1) { ?>
                <video id="sampleMovie" width="640" height="360" preload controls>
                    <source src="Core/Uploads/<?php echo $file['FileID'] . $file['FileFormat'] ?>"
                            type="video/mov"/>
                    <source src="Core/Uploads/<?php echo $file['FileID'] . $file['FileFormat'] ?>"
                            type="video/mp4"/>
                </video>
            <?php } else { ?>
                not image or video
            <?php } ?>
        </div>
        <div class="uk-text-center " style="width: 100%; ">
            <?php
            $href = "/Occasions?occasionID=" . $obj->getRequests()['occasionID'];
            include VIEW_PATH . "/Generics/pages/filePagination.php";
            ?>
        </div>
    </div>
<?php } ?>