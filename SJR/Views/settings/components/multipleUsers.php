<?php

use SJR\Configs\cipher;
use SJR\Models\User;

?>
<div style="width: 90vw; height: 90vh; margin-left: 5vw; margin-top: 5vh; padding:0; border: 1px solid darkblue">
    <div class="uk-modal-header uk-text-large uk-text-center">Add / Amend Users Details</div>
    <div style="padding-left: 40px;">
        <table class="uk-table uk-table-small">
            <thead>
            <tr>
                <th>Forename</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Password</th>
                <th>User Level</th>
                <th>Valid</th>
            </tr>
            </thead>
            <tbody>
            <form>
                <input type="hidden" name="mode" value="insertUser">
                <tr>
                    <td><input type="text" name="Forename" required value=""></td>
                    <td><input type="text" name="Surname" required value=""></td>
                    <td><input type="email" name="Email" required value=""></td>
                    <td><input type="password" name="Password" required value=""></td>
                    <td><?php echo User::userLevelCombo(0) ?></td>
                    <td><?php echo User::userValidCombo(1) ?></td>
                    <td><?php echo sjrButton('button', 'primary', '', 'add', 'Add New User', '', '') ?></td>
                </tr>
            </form>
            <?php
            $users = $obj->getSettings()->getAllUsers();
            foreach ($users as $key => $user) { ?>
                <form>
                    <input type="hidden" name="mode" value="updateUser">
                    <input type="hidden" name="UserID" value="<?php echo $user->getUserID(); ?>">
                    <tr>
                        <td><input type="text" name="Forename" value="<?php echo $user->getForename(); ?>"></td>
                        <td><input type="text" name="Surname" value="<?php echo $user->getSurname(); ?>"></td>
                        <td><input type="email" name="Email" value="<?php echo $user->getEmail(); ?>"></td>
                        <td><input type="password" name="Password" value="<?php echo cipher::uncipher($user->getPassword()); ?>"></td>
                        <td><?php echo User::userLevelCombo($user->getUserLevel()) ?></td>
                        <td><?php echo User::userValidCombo($user->getUserValid()) ?></td>
                        <td><?php echo sjrButton('button', 'primary', '', 'upload', 'Update User', '', '') ?></td>
                    </tr>
                </form>
            <?php } ?>
            </tbody>
            <tfoot></tfoot>
        </table>

    </div>
</div>

