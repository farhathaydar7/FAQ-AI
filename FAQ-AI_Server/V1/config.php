<?php

define('DB_DSN', 'mysql:host=localhost;dbname=faqai');
define('DB_USER', 'root');
define('DB_PASS', 'password');


try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

define('SECRET_KEY', 'Hell0_WRLD$$961HFFR');
?>
