<?php $occasion = $obj->getOccasions()->getOccasion(); ?>

<div class="uk-modal-header uk-text-large">Edit Occasion</div>
<form class="uk-form uk-form-stacked">
    <input type="hidden" name="mode" value="updateOccasion">
    <input type="hidden" name="OccasionsID" value="<?php echo $occasion->getOccasionsID() ?>">
    <div>
        <label class="uk-form-label">Occasion Name</label>
        <div class="uk-form-controls">
            <input type="text" class="uk-width-1-1" name="OccasionsName"
                   value="<?php echo $occasion->getOccasionsName() ?>">
        </div>
    </div>

    <div>
        <label class="uk-form-label">Occasion Date</label>
        <div class="uk-form-controls">
            <input type="date" class="uk-width-1-2" name="OccasionsDate"
                   value="<?php echo $occasion->getOccasionsDate() ?>">
        </div>
    </div>

    <div>
        <label class="uk-form-label">Occasion Note</label>
        <div class="uk-form-controls">
            <textarea type="date" class="uk-width-1-1" rows="6" name="OccasionsNotes"
                      value="<?php echo $occasion->getOccasionsNotes() ?>"><?php echo $occasion->getOccasionsNotes() ?></textarea>
        </div>
    </div>

    <div>
        <hr>
        <div class="uk-form-controls">
            <?php echo sjrButton('button', 'primary', '#', 'check', 'Update Occasion', '', '') ?>
        </div>
    </div>


</form>