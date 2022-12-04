<?php
//    viewArray(COUNT($obj->getOccasions()->getMonthOccasions())); exit;

?>
<span class="header">Select Month</span>
<input type="month" name="month" id="month" value="<?php echo $obj->getRequests()['month']; ?>" >  &nbsp;  &nbsp;
<?php echo sjrButton('a', 'primary', '/Occasions?mode=addOccasion', 'plus', 'Add', '', '') ?>
<span class="header">Timeline</span>

<div id="timelineDiv">
    <table class="uk-table uk-table-small">
        <?php
        $count = COUNT($obj->getOccasions()->getMonthOccasions());
        $height = ($count == 0?0:((85/($count + 1)) -1)) ."vh";
        $side = true;
        foreach($monthOccasions AS $day=>$val){
            echo timelineTD($day, $height, $side, $obj->getRequests()['month']);
            $side = !$side;
          }
        echo timelineTD('All', $height, $side, $obj->getRequests()['month']);
        ?>
    </table>
</div>


<?php
function timelineTD($day, $height, $side, $month){
    $style = "height:" .$height ." !important; border-top: 2px solid black; padding: 0 !important;";
    $left = "border-left:2px solid black; text-align: right;";
    $right = "border-right:2px solid black; text-align: left;";
    $style .= ($side?$right:$left);
    $href = "/Occasions?month=" .$month .($day !='All'?"&occasionDate=" .$month ."-" .$day:'') ;
    $button = sjrButton('a', 'primary', $href, 'clock', $day, '', '');
    $td = "<tr>";
            if($side){
                $td .= "<td style='{$style}'>" .$button ."</td>
                        <td></td>";
            } else {
                $td .= "<td></td>
                        <td style='{$style}'>" .$button ."</td>";
            }
    $td .="</tr>";

    return $td;
}

//echo COUNT($obj->getOccasions());
//viewArray($obj->getOccasions());
