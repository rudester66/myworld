<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $requests = $obj->getRequests();
    $title = 'MyWorld ';
    if(array_key_exists('class', $requests) && $requests['class'] != ''){
        $title .=" - " .$requests['class'];
    } else if(array_key_exists('pageName', $requests) && $requests['pageName'] != ''){
        $title .=" - " .$requests['pageName'];
    } else if(array_key_exists('controller', $requests) && $requests['controller'] != ''){
        $title .=" - " .$requests['controller'];
    }

    if(array_key_exists('mode', $requests)) {
        $title .= " -- " . $requests['mode'];
    }
    ?>
    <meta name="description" content="My World"/>
    <meta charset="utf-8">
    <title><?php echo $title;  ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Steven J Rudd">
    <link rel="shortcut icon" href="/App/Images/dog.ico"/>

    <link rel="stylesheet" href="SJR/sjr.css">
    <script src="SJR/sjr.js"></script>
    <?php
    //  Load all the CSS files passed
    if ($obj->getCSS() !== null) {
        foreach ($obj->getCSS() as $key => $css) { ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php }
    }
    if ($obj->getJS() !== null) {
        //  Load all the Script files passed
        foreach ($obj->getJS() as $key => $script) { ?>
            <script src="<?php echo $script ."?ver=" .date("YmdHis"); ?>"></script>
        <?php }
    } ?>

</head>

<body>




