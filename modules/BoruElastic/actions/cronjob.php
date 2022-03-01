<?php
# dnguyen@boruapps.com 08142012 cronjob
ini_set('memory_limit', -1);
set_time_limit(0);
ini_set('display_errors', 1);
error_reporting(E_ALL);

$include_path = dirname(__FILE__);
$include_path = substr($include_path, 0, strlen($include_path) - 25);
set_include_path($include_path);
require_once('include/database/PearDatabase.php');
require_once('modules/BoruElastic/helpers/Utils.php');

global $adb;
$adb = PearDatabase::getInstance();

//
