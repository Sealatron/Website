<?php

    // Common tasks
    include_once('config.inc.php');
    $database = new PDO(DB_DSN, DB_USER, DB_PASS);

    // Instruct the database to throw an exception any time a query fails (fatal error will stop flow of execution)
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    session_start();
