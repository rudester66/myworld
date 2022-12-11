<?php $monthOccasions = $obj->getOccasions()->getMonthOccasions(); ?>
<div id="occasionsDate">
    <?php include VIEW_PATH . '/Occasions/components/occasionsDate.php'; ?>
</div>
<?php if ($obj->getRequests()['occasionID'] == '' && $obj->getRequests()['month'] != '') { ?>
    <div id="occasionsImage">
        <?php include VIEW_PATH . '/Occasions/components/dayOccasions.php'; ?>
    </div>
<?php } ?>

