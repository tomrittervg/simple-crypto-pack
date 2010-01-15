<?php

require("code.php");
require("dictionary.php");

$options = array();

$tmp = getopt("vd", array("match-length:"));
$options['debug'] = isset($tmp['d']);
$options['verbose'] = isset($tmp['v']);
$options['match-length'] = isset($tmp['match-length']) ? $tmp['match-length'] : 2;

unset($tmp);