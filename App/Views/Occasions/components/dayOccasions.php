<?php if ($requests['occasionDate'] == '') {
    $occasions = $obj->getOccasions()->getMonthOccasions();
} else {
    $occasions[date("d", strtotime($requests['occasionDate']))] = $obj->getOccasions()->getDayOccasions();
} ?>
<div class="smiSticky uk-margin-top" hght="800" id="occasionsDiv">
    <table class="uk-table uk-table-small"  id="occasionsTable">
        <thead >
        <tr>
            <th class="uk-width-1-3">Name</th>
            <th class="uk-width-1-2">Note</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($occasions as $day => $objects) { ?>
            <tr>
                <th colspan="3"><?php echo td($requests['month'] . "-" . $day); ?></th>
            </tr>
            <?php foreach ($objects as $obj) { ?>
                <tr>
                    <td><input class="uk-width-1-1 uk-form-small" readonly value="<?php echo $obj->getOccasionsName(); ?>"></td>
                    <td><input class="uk-width-1-1 uk-form-small" readonly value="<?php echo $obj->getOccasionsNotes(); ?>"></td>
                    <td><?php echo sjrButton('a', 'primary', '/Occasions?occasionID=' .$obj->getOccasionsID(), 'download', 'Download', '', '') ?></td>
                </tr>
            <?php }
        } ?>
        </tbody>
        <tfoot></tfoot>
    </table>
</div>
