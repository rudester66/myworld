<div class="uk-modal-header uk-text-large">User Settings</div>
<form class="uk-form uk-form-stacked">
    <input type="hidden" name="mode" value="updateUser">
    <input type="hidden" name="UserID" value="<?php echo $obj->getRequests()['UserID'] ?>">
    <div>
        <label class="uk-form-label">Occasion Name</label>
        <div class="uk-form-controls">
            <input type="text" class="uk-width-1-1" name="OccasionsName"
                   value="<?php echo ''; ?>">
        </div>
    </div>

</form>