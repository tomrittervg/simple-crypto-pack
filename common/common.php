<?php

require("code.php");
require("dictionary.php");

$options = array();

$tmp = getopt("vd");
$options['debug'] = isset($tmp['d']);
$options['verbose'] = isset($tmp['v']);

unset($tmp);