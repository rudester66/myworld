<style>

</style>
<?php include BASE_COMPONENTS . '/header.php'; ?>

<div id="newAdminUserDiv">
    <span>Add New Admin User</span>

    <form class="uk-form-stacked">
        <input type="hidden" name="mode" value="insertAdminUser">
        <input type="hidden" name="UserLevel" value="99">
        <div>
            <label class="uk-form-label">Forename</label>
            <div class="uk-form-controls">
                <input type="text" name="Forename" required>
            </div>
        </div>
        <div>
            <label class="uk-form-label">Surname</label>
            <div class="uk-form-controls">
                <input type="text" name="Surname" required>
            </div>
        </div>
        <div>
            <label class="uk-form-label">Email</label>
            <div class="uk-form-controls">
                <input type="email" name="Email" required>
            </div>
        </div>
        <div>
            <label class="uk-form-label">Password</label>
            <div class="uk-form-controls">
                <input type="password" name="Password" required>
            </div>
        </div>
        <div>
            <div class="uk-form-controls">
                <hr>
                <input type="submit" value="Add new Admin User">
            </div>
        </div>


    </form>
</div>

<?php include BASE_COMPONENTS . '/footer.php'; ?>