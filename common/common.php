<?php

require("code.php");
require("dictionary.php");
require("frequencies.php");
require("index_of_coincidence.php");
require("print-functions.php");
require("str-functions.php");

$options = array();

$tmp = getopt("vd", array("match-length:", "key:", "index-of-coincidence:", "index-only"));

$options['debug'] = isset($tmp['d']);
$options['verbose'] = isset($tmp['v']);
$options['match-length'] = isset($tmp['match-length']) ? $tmp['match-length'] : 5;
$options['index-of-coincidence'] = isset($tmp['index-of-coincidence']) ? $tmp['index-of-coincidence'] : 10;
if(isset($tmp['key'])) $options['key'] = $tmp['key'];
$options['index-only'] = isset($tmp['index-only']);

unset($tmp);