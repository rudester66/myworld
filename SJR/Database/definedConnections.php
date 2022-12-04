<?php
//  Hosts
define("MYWORLD", "mysql:host=localhost;dbname=myworld");


//  Usernames
define("GENERIC_USERNAME", "root");


//  Passwords
define("BLANK_PASSWORD", "");


//  Connections
define("CONNECTIONS", serialize(array(
    'MYWORLD' => [
        'connection' => MYWORLD,
        'username' => GENERIC_USERNAME,
        'password' => BLANK_PASSWORD,
    ],
)));