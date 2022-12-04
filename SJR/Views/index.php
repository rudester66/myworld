<?php include BASE_COMPONENTS . '/header.php'; ?>
    <div id="menuIcon" class="uk-position-top uk-position-z-index theMenu uk-link">
        &#9776;
    </div>
    <div id="menuDiv" class="theMenu uk-hidden uk-position-z-index ">
        <?php include BASE_COMPONENTS . '/menu.php'; ?>
    </div>

    <div uk-grid class="uk-width-1-1 uk-position-cover" style="margin: 0;  padding: 0" id="container">
        <?php   ($obj->getComponent() ? include $obj->getComponent() :''); ?>
    </div>

<?php include BASE_COMPONENTS . '/footer.php'; ?>