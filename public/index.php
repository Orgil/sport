<?php

/* Set our script root paths */
define('ROOT_PATH', realpath(str_replace("\\", "/", realpath(dirname(__FILE__))) . '/../'));
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('APP_PATH', ROOT_PATH . '/app');

require_once(APP_PATH . '/app.php');
