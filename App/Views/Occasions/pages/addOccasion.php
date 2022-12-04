<?php include BASE_COMPONENTS . '/header.php'; ?>


<div id="addOccasionDiv">
    <span>Add Occasion</span>

    <form class="uk-form-stacked">
        <input type="hidden" name="mode" value="insertOccasion">
        <div>
            <label class="uk-form-label">Name</label>
            <div class="uk-form-controls">
                <input type="text" name="OccasionsName" class="uk-width-4-5" required>
            </div>
        </div>
        <div>
            <label class="uk-form-label">Date</label>
            <div class="uk-form-controls">
                <input type="date" name="OccasionsDate" value="<?php echo date("Y-m-d") ?>" required>
            </div>
        </div>
        <div>
            <label class="uk-form-label">Note</label>
            <div class="uk-form-controls">
                <textarea name="OccasionsNotes" class="uk-width-4-5" rows="6" ></textarea>
            </div>
        </div>
        <div>
            <div class="uk-form-controls">
                <br>
                <hr>
                <?php echo sjrButton('button', 'primary', '', 'calendar', 'Add New Occasion', 'uk-link', '') ?>
            </div>
        </div>
    </form>
</div>
<?php include BASE_COMPONENTS . '/footer.php'; ?>

