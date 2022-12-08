    <?php
    if ($obj->getSettings()->getCurrentUser()->getUserLevel() < 99) {
        include SJR_VIEW . '/settings/components/singleUser.php';
    } else {
        include SJR_VIEW . '/settings/components/multipleUsers.php';
    }
    ?>
