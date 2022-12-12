<?php
$count = COUNT($obj->getOccasions()->getFileTags());
$fileNo = $requests['fileNo'];

$paginationArray = [];
?>
    <div id="paginationDiv">
        <div id="paginationBoxes">
            <?php if ($fileNo > 0) { ?>
                <a class="" uk-icon="icon: chevron-left; ratio: 1.5"
                   href="<?php echo $href ?>&fileNo=<?php echo($fileNo - 1); ?>"></a>
                &nbsp; &nbsp;
            <?php } ?>
            <?php
            //      If 12 or less, show all
            if ($count < 13) {
                $nos = range(0, ($count - 1));
                $level = [];
                foreach ($nos as $key => $value) {
                    if ($key == $fileNo) {
                        $level[$key] = true;
                    } else {
                        $level[$key] = false;
                    }
                }
                echo paginationBoxes($level, $href);
            } else {
                $nos = getNoFromTo($count, $fileNo);
                $countNo = COUNT($nos);
                $counter = 1;
                foreach ($nos as $key => $level) {
                    echo paginationBoxes($level, $href);
                    if ($counter < $countNo) {
                        echo " &nbsp; &nbsp; *********  &nbsp; &nbsp;";
                    }
                    $counter++;
                }

            } ?>
            <?php if ($fileNo < ($count - 1)) { ?>
                &nbsp; &nbsp;
                <a class="" uk-icon="icon: chevron-right; ratio: 1.5"
                   href= "<?php echo $href ?>&fileNo=<?php echo($fileNo + 1); ?>"></a>
            <?php } ?>
        </div>
        <br>
        <span class="paginationCounter">
            <form action="" style="display: inline-block">
                <?php
                $paginationArray = [
                    'occasionID' => $obj->getRequests()['occasionID'],
                ];
//                viewArray($paginationArray);
                foreach($paginationArray AS $mode=>$value){  ?>
                    <input type="hidden" name="<?php echo $mode; ?>" value="<?php echo $value; ?>">
                <?php } ?>

            Goto File No: &nbsp; &nbsp; <input type="number" name="fileNo" min="1" max="<?php echo($count - 1); ?>"
                                               value="<?php echo $fileNo; ?>" class="uk-text-right"
                                               style="width: 100px"/>  &nbsp; &nbsp;
                <?php echo sjrButton('button', 'primary', '', 'image', 'Goto File No', '', '')  ?>
            </form>
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            Count: &nbsp; &nbsp; <?php echo $count; ?></span>
    </div>
<?php


function getNoFromTo($count, $fileNo)
{
    $nos = [];

//  Add first three
    for ($x = 0;
         $x < ($fileNo == 2 ? 4 : 3);
         $x++) {
        $nos[$x] = $fileNo == $x;
    }

//  Add last three
    for ($x = ($fileNo == ($count - 3) ? ($count - 4) : ($count - 3));
         $x < $count;
         $x++) {
        $nos[$x] = $fileNo == $x;
    }

    $middleNo = floor($count / 2);
//  If fileNo is in the first or last 3 use the middle no
    if ($fileNo > 2 && $fileNo < ($count - 3)) {
        $noFrom = ($fileNo - 2);
        $noTo = ($fileNo + 3);
    } else {
        $noFrom = ($middleNo - 2);
        $noTo = ($middleNo + 3);
    }

    for ($x = $noFrom;
         $x < $noTo;
         $x++) {
        $nos[$x] = $fileNo == $x;
    }
    ksort($nos);

//  Determine breaks, start and end; also if there is a middle
    $return = [];
    $ct = 0;
    $break = 1;
    foreach ($nos as $key => $value) {
        if (empty($return)) {
            $level = 'level' . $break;
            $break++;
        } else if ($ct <> $key) {
            $level = 'level' . $break;
            $break++;
            $ct = $key;
        }
        $return[$level][$key] = $value;
        $ct++;
    }

    return $return;
}

function paginationBoxes($level, $href)
{
    $str = '';
    foreach ($level as $key => $value) {
        $str .= '<a class="paginationBox ' . ($value ? "paginationActive" : "") . '"
           href="' .$href .'&fileNo=' . $key . '">' . ($key + 1) . '</a>';
    }

    return $str;
}

