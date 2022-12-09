<div uk-grid class="uk-width-1-1"  style="margin-top: 5vh">

<?php foreach($obj->getRequests()['anniversaries'] AS $year=>$anniversary){ ?>
    <div class="uk-width-1-4">
        <h3><?php echo $year ?></h3>
        <?php
        foreach($anniversary AS $key=>$date){
            echo sjrButton('a', 'success', '/Occasions?occasionID=' .$date->getOccasionsID(), 'calendar', $date->getOccasionsName(), '', '');
        } ?>
    </div>
<?php } ?>
</div>
