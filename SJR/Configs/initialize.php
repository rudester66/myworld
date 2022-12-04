<?php


use Core\Configs\sqlRun;

include 'definedVariables.php';

//  include the composer autoloader
require ROOT_PATH . '/vendor/autoload.php';

//  require the PDO wrapper file
require SJR_PATH . '/Lib/PDODatabase.php';

//   function and abbreviated function files
include SJR_PATH ."/Configs/functions.php";
include SJR_PATH . "/Configs/abbreviationFunctions.php";

// Set user-defined error handler function
set_error_handler("myErrorHandler");

//try {
    // this will generate notice that would not be caught
//    echo $someNotSetVariable;
    // fatal error that now actually is caught
//    someNoneExistentFunction();
//} catch (Error $e) {
//    viewArray($e); exit;
//    echo "Error caught: " . $e->getMessage();
//}

?>


<!--    include jquery      -->
<script src="/node_modules/jquery/dist/jquery.js"></script>

<!--  include required files for UIKIT-->
<script src="/vendor/uikit/uikit/dist/js/uikit.js"></script>
<script src="/vendor/uikit/uikit/dist/js/uikit-icons.js"></script>
<link rel="stylesheet" href="/vendor/uikit/uikit/dist/css/uikit.css">

<!--  include select2     -->
<link rel="stylesheet" href="/vendor/select2/select2/dist/css/select2.css"/>
<script src="/vendor/select2/select2/dist/js/select2.js"></script>

