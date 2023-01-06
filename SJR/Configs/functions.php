<?php

use Core\Databases\databaseObj;

// A user-defined error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline) {
    $errstr = htmlspecialchars($errstr);
viewArray($errno, $errstr, $errfile, $errline );
//    switch ($errno) {
//        case E_USER_ERROR:
//            $error = 'myError';
//            echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
//            echo "  Fatal error on line $errline in file $errfile";
//            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
//            echo "Aborting...<br />\n";
//            exit(1);
//            break;
//        case E_USER_WARNING:
//            $error = 'myWarning';
////            echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
//            break;
//
//        case E_USER_NOTICE:
//            $error = 'myNotice';
////            echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
//            break;
//
//        default:
//            $error = 'myError';
////            echo "Unknown error type: [$errno] $errstr<br />\n";
//            break;
//    }
    include  SJR_VIEW .'/error.php';
    die();
//    echo "<b>Custom error:</b> [$errno] $errstr<br>";
//    echo " Error on line $errline in $errfile<br>";
}

/**
 * Shows an array/object in a easily readable format
 *      SHOW_VIEW_ARRAYS has to be set to true in definedvariables
 */
function viewArray()
{
    $debug = debug_backtrace();
    echo "Called by " . $debug[0]['file'] . " on line " . $debug[0]['line'] . "<br>";
    $numargs = func_num_args();
    for ($i = 0; $i < $numargs; $i++) {
        if (is_array(func_get_arg($i))) {
            echo "Count: " . COUNT(func_get_arg($i)) . "<br>";
            echo "<pre>";
            var_dump(func_get_arg($i));
            echo "</pre>";

        } else if (is_object(func_get_arg($i))) {
            echo "Count: " . COUNT((array)func_get_arg($i)) . "<br>";
            echo "<pre>";
            var_dump(func_get_arg($i));
            echo "</pre>";
        } else {
            echo "String: " . func_get_arg($i) . "<br>";
        }
    }
}



/**
 * Get the Database object
 * @return \Core\databases\sjr\_myworld|mixed
 */
function getDatabaseObj($conn)
{
    $instance = databaseObj::getInstance($conn);
    $databases = $instance->getDatabase();

    return $databases;
}

/**
 * Creates a button, ensuring it is the same format
 * @param $tag //  element type, i.e.  button, a
 * @param $colour //  colour of button, primary, danger, success
 * @param $href //  link for button
 * @param $icon //  uikit icon to be added
 * @param $title //  to show on button
 * @param $class //  additional classes
 * @param $attr //  any attributes required, i.e. data-uk-modal
 * @return string
 */
function sjrButton($tag, $colour, $href, $icon, $title, $class, $attr)
{
    return "<{$tag} class='uk-button-{$colour} sjrButton {$class}' href='{$href}' {$attr}><i uk-icon='icon: {$icon}; ratio: 0.8;'></i>  &nbsp;  &nbsp;{$title}</{$tag}>";
}


function menuButton($href, $icon, $title){
    return "<a href='{$href}' uk-icon='icon: {$icon}; ratio:2' data-uk-tooltip='title:{$title}; pos: bottom-right; animation: uk-animation-slide-left'></a>";
}

function MF(string $inValue)
{
    return "<SELECT name='Sex' >
                <OPTION " . ($inValue == 'F' ? 'SELECTED' : '') . " value='F'>Female</OPTION>
                <OPTION " . ($inValue == 'M' ? 'SELECTED' : '') . " value='M'>Male</OPTION>
            </SELECT>";
}



function YN(string $name, string $inValue)
{
    return "<SELECT name='{$name}' >
                <OPTION " . ($inValue == '1' ? 'SELECTED' : '') . " value='1'>Yes</OPTION>
                <OPTION " . ($inValue == '0' ? 'SELECTED' : '') . " value='0'>No</OPTION>
            </SELECT>";
}


