<?php $occasion = $obj->getOccasions()->getOccasion();  ?>

<div uk-grid class="uk-width-1-1">

    <div uk-grid id="occasionsEditTagsDiv" class="uk-width-3-4 uk-hidden" >
        <?php  echo \App\Models\TagLink::getTagInputs(0, $requests['occasionID']);  ?>
<!--        --><?php //include VIEW_PATH ."/Occasions/components/occasionEditTags.php"; ?>
    </div>
    <div id="occasionsEditDetailsDiv"  class="uk-width-1-1" >
        <?php include VIEW_PATH ."/Occasions/components/occasionEditDetails.php"; ?>
    </div>

</div>