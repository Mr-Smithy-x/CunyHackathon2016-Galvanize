<?php
/**
 * Created by PhpStorm.
 * User: cj
 * Date: 6/19/16
 * Time: 8:46 AM
 */
/*
;*/

defined('DB_HOST') or define('DB_HOST', 'localhost');
defined('DB_USER') or define('DB_USER', 'bcc');
defined('DB_PASS') or define('DB_PASS', 'cuny');
defined('DB_NAME') or define('DB_NAME', 'BCC');

/**
 * @return PDO
 */
function getPDO(){
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

$pdo = getPDO();
