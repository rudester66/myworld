<?php

    define("ROOT_PATH", str_replace("SJR\Configs", "", __DIR__));
    define("SJR_PATH", ROOT_PATH . 'SJR' );
    define("SJR_VIEW", SJR_PATH . '/Views' );
    define("VENDOR_PATH", ROOT_PATH . 'vendor');
    define("CORE_PATH", ROOT_PATH . 'Core');
    define("APP_PATH", ROOT_PATH . 'App');
    define("VIEW_PATH", APP_PATH . '/Views');
    define("UPLOADS_PATH", CORE_PATH . '/Uploads');
    define("CONFIGS_PATH", CORE_PATH . "/Configs");


    define("BASE_PAGE_INDEX", SJR_PATH .'/Views/index.php');
    define("BASE_COMPONENTS", SJR_PATH .'/Views');


