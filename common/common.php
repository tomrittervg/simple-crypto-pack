<?php

require("code.php");
require("dictionary.php");
require("frequencies.php");
require("index_of_coincidence.php");
require("print-functions.php");
require("str-functions.php");

$options = array();

$tmp = getopt("vd", array("match-length:", "key:"));

$options['debug'] = isset($tmp['d']);
$options['verbose'] = isset($tmp['v']);
$options['match-length'] = isset($tmp['match-length']) ? $tmp['match-length'] : 5;
if(isset($tmp['key'])) $options['key'] = $tmp['key'];

unset($tmp);