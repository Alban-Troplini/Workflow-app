<?php


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

define('SITE_ROOT', DS . 'opt' . DS . 'lampp' . DS . 'htdocs' . DS . 'Workflow');

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'includes' . DS . 'functions');


require_once(INCLUDES_PATH.DS."database.php");
require_once(INCLUDES_PATH.DS."db_objects.php");
require_once(INCLUDES_PATH.DS."user.php");
require_once(INCLUDES_PATH.DS."db.php");
require_once(INCLUDES_PATH.DS."session.php");
//require_once(INCLUDES_PATH.DS."paginate.php");



?>