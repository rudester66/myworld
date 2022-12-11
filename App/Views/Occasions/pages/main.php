<?php
if ($obj->getRequests()['error'] != '') { ?>
    <script>
        window.addEventListener("load", function () {
            showSnackBar("<?php echo $obj->getRequests()['error']; ?>");
        })
    </script>
<?php } ?>
<div uk-grid class="uk-width-1-1">
    <?php if ($obj->getRequests()['occasionID'] != '') {
        include VIEW_PATH . '/Occasions/components/main.php';
    } else {
        include VIEW_PATH . '/Occasions/components/calendar.php';
    } ?>

</div>