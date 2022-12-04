<style>
    body {
        background-color: lightcoral;
    }
    div {
        position: absolute;
        width: 25vw;
        top: 20vh;
        height: 45vh;
        border: 1px solid red;
        background-color: mintcream;
    }
    #errorDiv {
        left: 25vw;
    }
    #errNo {
        display: block;
        font-size: 90px;
        width: 50%;
        height: 30%;
        margin: 10% 0% 10% 10%;
        border-bottom: 2px solid black;
    }
    #errTxt {
        display: block;
        font-size: 20px;
        width: 80%;
        height: 30%;
        margin: 5% 0% 10% 10%;
        color: grey;
        font-weight: bold;
    }

    #imageDiv {
        left: 50vw;
    }

</style>

<div id="errorDiv">
    <span id="errNo"><?php echo $errno; ?></span>
    <span id="errTxt"><?php echo $errstr; ?></span>
    <?php  echo sjrButton('a', 'primary', '/', 'home', 'Home', '', '') ?>
</div>
<div id="imageDiv">

</div>
<?php
//   function and abbreviated function files
//include SJR_PATH ."/Configs/functions.php";
//include SJR_PATH . "/Configs/abbreviationFunctions.php";

//
//echo $errno;
//echo $error;



//if (!(error_reporting() & $errno)) {
//    // This error code is not included in error_reporting, so let it fall
//    // through to the standard PHP error handler
//    return false;
//}

// $errstr may need to be escaped:
$errstr = htmlspecialchars($errstr);

