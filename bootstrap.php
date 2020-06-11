<?php
    // Base URL
    define('BASE_URL','http://localhost/nextAdmin');

    spl_autoload_register(function ($class){
        require 'controlleres/'.$class.'.php';
    });

    require 'core/Connection.php';

    //Session Class For Session Init, set, get, loginSessionCheck Etc
    require 'core/Session.php';


    //Session Class For Session Init, set, get, loginSessionCheck Etc
    require 'core/Library.php';

    //Get Connection on pdo variable
    $pdo = Connection::dbconn();


    $auth = new Auth($pdo);

    $dashboard = new Dashboard($pdo);

    $library = new Library($pdo);

    $company = new Company($pdo);

    $billing = new Billing($pdo);