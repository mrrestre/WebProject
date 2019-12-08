<?php

    $host = 'localhost';
    $dbname = 'taketec-pdo-version-1';
    $dbuser = 'root';
    $dbpassword = '';
    $charset = 'utf8mb4';

    $dns = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $options    = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];


    $database = null;

    try
    {
        $database = new PDO($dns, $dbuser, $dbpassword, $options);
    }
    catch(\PDOException $e)
    {
        die( 'Database connection failed: ' . $e->getMessage() );
    }