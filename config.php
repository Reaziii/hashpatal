<?php
define('ROOT', $_SERVER["DOCUMENT_ROOT"]);
define('POST', $_POST);
define('IS_ADMIN', isset($_SESSION["admin"]));
define('ADMINMAIL', "baphonreaz@gmail.com");
define("HOME_URL", "http://localhost:8888");
date_default_timezone_set('Asia/Dhaka');
