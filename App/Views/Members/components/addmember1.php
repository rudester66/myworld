<div>
    <label class="uk-form-label">Forename</label>
    <div class="uk-form-controls">
        <input type="text" name="Forename" class="uk-width-4-5" required>
    </div>
</div>
<div>
    <label class="uk-form-label">Middlename</label>
    <div class="uk-form-controls">
        <input type="text" name="Middlename" class="uk-width-4-5" >
    </div>
</div>
<div>
    <label class="uk-form-label">Surname</label>
    <div class="uk-form-controls">
        <input type="text" name="Surname" class="uk-width-4-5" required>
    </div>
</div>
<div>
    <label class="uk-form-label">Date of Birth</label>
    <div class="uk-form-controls">
        <input type="date" name="DOB" value="<?php echo null ?>" >
    </div>
</div>
<div>
    <label class="uk-form-label">Date of Death</label>
    <div class="uk-form-controls">
        <input type="date" name="DOD" value="<?php echo null ?>" >
    </div>
</div>
<div>
    <label class="uk-form-label">Sex</label>
    <div class="uk-form-controls">
        <?php  echo MF('M');  ?>
    </div>
</div>
<div>
    <label class="uk-form-label">Relationship</label>
    <div class="uk-form-controls">
        <input type="text" name="Relationship" class="uk-width-4-5" required>
    </div>
</div>
<div>
    <label class="uk-form-label">Definitely Related</label>
    <div class="uk-form-controls">
        <?php  echo YN('DefinitelyRelated','0');  ?>
    </div>
</div>
