<div uk-grid style="width: 100vw;">
    <div id="occasionsEdit">
        <?php
        //  Edits the occasion table fields
        include VIEW_PATH . "/Occasions/components/occasionEdit.php";
        ?>
    </div>

    <div id="occasionsImage" >
        <?php

        //  Swows the current image of the occasion
        include VIEW_PATH . "/Occasions/components/images.php";
        ?>
    </div>

    <div id="occasionsImageEdit">
        <?php
        //  Edits the occasion Image
        include VIEW_PATH . "/Occasions/components/imageEdit.php";
        ?>

    </div>
</div>
