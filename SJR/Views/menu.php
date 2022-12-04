<?php
//viewArray($obj->getRequests());
$menuArray = array(
    0 => array(
        'href' => '/Homes',
        'icon' => 'home',
        'title' => 'Home Page shows On This Day',
    ),
    1 => array(
        'href' => '/Occasions',
        'icon' => 'calendar',
        'title' => 'View/Add and Update Occasions Details',
    ),
    2 => array(
        'href' => '/Members',
        'icon' => 'users',
        'title' => 'View/Add and Update Members Basic Details',
    ),
    3 => array(
        'href' => '/Settings',
        'icon' => 'settings',
        'title' => 'View/Add and Amend Settings ',
    ),

);
?>
<div uk-grid style="background: mintcream; color: darkgreen; padding: 5px 15px 5px 15px; ">
    <div class="uk-width-1-1 uk-text-left uk-text-large " style="padding-left: 60px; border-right: 1px black dotted;">
        <?php foreach ($menuArray as $key => $value) {
            echo menuButton($value['href'], $value['icon'], $value['title']);
        } ?>
    </div>
</div>
