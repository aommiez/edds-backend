<?php

$configs = array(
    "application" => array(
        "name" => "ED/DS Backend",
        "title" => "ED/DS Backend",
        "version" => "1.0",
        "base_url" => "http://192.168.100.25/edds-backend",
        "site_url" => "",
        "share_url" => "",
        "directory" => dirname(__FILE__),
        "view" => "default"
    ),
    "route"=> array(
        "base_path"=> "/edds-backend"
    ),
    "db" => array(
        "mongodb" => array(
            "host" => "localhost",
            "name" => "",
            "user" => "",
            "password" => ""
        ),
        "mysql" => array(
            "host" => "localhost",
            "name" => "",
            "user" => "",
            "password" => ""
        ),
        "medoo" => array(
            "master"=> array(
                "database_type"=> "mysql",
                "database_name" => "edds",
                "server" => "localhost",
                "username" => 'root',
                'password' => '111111',

                // optional
                'port' => 3306,
                'charset' => 'utf8',
                // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
                'option' => array(
                    PDO::ATTR_CASE => PDO::CASE_NATURAL
                )
            )
        ),
        "apple_apn" => array(
            "development_file" => "",
            "development_link" => "",
            "distribution_file" => "",
            "distribution_link" => ""
        )
    ),
    "android" => array(
        "key" => ""
    ),
    "olo" => array(
        "version" => "1.1"
    ) ,
    "views" => array(

    )
);

return $configs;