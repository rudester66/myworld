<?php
if ($obj->getRequests()['error'] != '') { ?>
    <script>
        window.addEventListener("load", function () {
            showSnackBar("<?php echo $obj->getRequests()['error']; ?>");
        })
    </script>
<?php }
viewArray($obj);
$monthOccasions = $obj->getOccasions()->getMonthOccasions();
?>
<div uk-grid class="uk-width-1-1">
    <?php if ($obj->getRequests()['occasionID'] != '') { ?>
        <div id="occasionsEdit">
           <?php include VIEW_PATH ."/Occasions/components/occasionEdit.php"; ?>
        </div>

        <div id="occasionsImage">
            Image
        </div>

        <div id="occasionsImageEdit">
            image edit
        </div>
    <?php } else { ?>
        <div id="occasionsDate">
            <?php include VIEW_PATH . '/Occasions/components/occasionsDate.php'; ?>
        </div>
        <?php if ($obj->getRequests()['occasionID'] == '' && $obj->getRequests()['month'] != '') { ?>
            <div id="occasionsImage">
                <?php include VIEW_PATH . '/Occasions/components/dayOccasions.php'; ?>
            </div>
        <?php } ?>
    <?php } ?>

</div>