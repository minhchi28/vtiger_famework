<?php
require_once(dirname(__FILE__)."/class_elastic.php");

$elastic = new boru_elastic();
var_dump($elastic->createTemplate());