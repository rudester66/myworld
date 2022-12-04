<?php include BASE_COMPONENTS . '/header.php';
if ($obj->getRequests()['error'] != '') { ?>
    <script>
        window.addEventListener("load", function () {
            showErrorBar('<?php echo $obj->getRequests()['error']; ?>');
        });
    </script>
<?php } ?>

    <div id="loginDiv">
        <span>Login</span>

        <form class="uk-form-stacked">
            <input type="hidden" name="mode" value="checkLogin">
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
                    <?php echo sjrButton('button', 'primary', '#', 'user', 'Log In', 'uk-link', '') ?>
                </div>
            </div>
        </form>
    </div>
<?php include BASE_COMPONENTS . '/footer.php'; ?>

