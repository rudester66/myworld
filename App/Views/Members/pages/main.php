<?php
if ($obj->getRequests()['error'] != '') { ?>
    <script>
        window.addEventListener("load", function () {
            showSnackBar("<?php echo $obj->getRequests()['error']; ?>");
        })
    </script>
<?php } ?>
<div uk-grid class="uk-width-1-1">
    <div class="uk-width-1-1">
        <?php
        echo sjrButton('a', 'primary', '/Members?mode=addMember', 'plus', 'Add member', '', '');
        ?>

    </div>
</div>