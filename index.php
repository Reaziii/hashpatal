<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/router.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/utils/functions.php';
any("/", "views/index.php");
any("/login", "views/login.php");
any("/logout", "logout.php");
