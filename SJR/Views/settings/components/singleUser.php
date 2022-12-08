<?php

use SJR\Configs\cipher;
use SJR\Models\User;

$user = $obj->getSettings()->getCurrentUser();
?>
<div style="width: 20vw; height: 50vh; margin-left: 40vw; margin-top: 5vh; padding:0; border: 1px solid darkblue">
    <div class="uk-modal-header uk-text-large uk-text-center">Amend User Details</div>
    <div style="padding-left: 40px;">
        <form class="uk-form-stacked">
            <input type="hidden" name="mode" value="updateUser">
            <input type="hidden" name="UserID" value="<?php echo $user->getUserID(); ?>">
            <div>
                <label class="uk-form-label">Forename</label>
                <div class="uk-form-controls">
                    <input type="text" name="Forename" required value="<?php echo $user->getForename(); ?>">
                </div>
            </div>
            <div>
                <label class="uk-form-label">Surname</label>
                <div class="uk-form-controls">
                    <input type="text" name="Surname" required value="<?php echo $user->getSurname(); ?>">
                </div>
            </div>
            <div>
                <label class="uk-form-label">Email</label>
                <div class="uk-form-controls">
                    <input type="email" name="Email" required value="<?php echo $user->getEmail(); ?>">
                </div>
            </div>
            <div>
                <label class="uk-form-label">Password</label>
                <div class="uk-form-controls">
                    <input type="password" name="Password" required
                           value="<?php echo cipher::uncipher($user->getPassword()); ?>">
                </div>
            </div>
            <div>
                <label class="uk-form-label">User Level</label>
                <div class="uk-form-controls">
                    <?php echo User::userLevelCombo($user->getUserLevel()) ?>
                </div>
            </div>
            <div>
                <label class="uk-form-label">Valid</label>
                <div class="uk-form-controls">
                    <?php echo User::userValidCombo($user->getUserValid()) ?>
                </div>
            </div>
            <div>
                <label class="uk-form-label">
                    <hr>
                </label>
                <div class="uk-form-controls">
                    <?php echo sjrButton('button', 'primary', '', 'upload', 'Update User', '', '') ?>
                </div>
            </div>
        </form>
    </div>
</div>

