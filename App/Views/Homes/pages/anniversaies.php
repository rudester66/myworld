<div uk-grid class="uk-width-1-1"  style="margin-top: 5vh">
    <div class="uk-width-1-4"><h1>On this day ....</h1></div>
<?php foreach($obj->getRequests()['anniversaries'] AS $year=>$anniversary){ ?>
    <div class="uk-width-1-4">
        <h3><?php echo $year ?></h3>
        <?php
        foreach($anniversary AS $key=>$date){
            echo sjrButton('a', 'primary', '/Occasions?occasionID=' .$date->getOccasionsID(), 'calendar', $date->getOccasionsName(), '', '');
        } ?>
    </div>
<?php } ?>
</div>
