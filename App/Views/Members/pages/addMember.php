<?php include BASE_COMPONENTS . '/header.php'; ?>


<div id="addMemberDiv">
    <span>Add Member</span>

    <form class="uk-form-stacked">
        <input type="hidden" name="mode" value="insertMember">
<div uk-grid class="uk-width-1-1">

        <div class="uk-width-1-3">
            <?php include VIEW_PATH .'/Members/components/addmember1.php';  ?>
        </div>
        <div class="uk-width-2-3">
            <?php include VIEW_PATH .'/Members/components/addmember2.php';  ?>
        </div>
</div>

    </form>
</div>
<?php include BASE_COMPONENTS . '/footer.php'; ?>

