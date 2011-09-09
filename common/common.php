<?php

require("code.php");
require("dictionary.php");
require("frequencies.php");
require("index_of_coincidence.php");
require("print-functions.php");
require("str-functions.php");
require("permute-functions.php");

error_reporting(E_ERROR);

$options = array();

$tmp = getopt("vd", array("match-length:", "key:", "index-of-coincidence:", "index-only", "help"));

$options['debug'] = isset($tmp['d']);
$options['verbose'] = isset($tmp['v']);
$options['match-length'] = isset($tmp['match-length']) ? $tmp['match-length'] : 5;
$options['index-of-coincidence'] = isset($tmp['index-of-coincidence']) ? $tmp['index-of-coincidence'] : 10;
if(isset($tmp['key'])) $options['key'] = $tmp['key'];
$options['index-only'] = isset($tmp['index-only']);

if(isset($tmp['help']))
  {
    $padlen = 30;
    echo "Usage:\n";
    echo "\t" . str_pad("-v", $padlen) . "Verbose Mode\n";
    echo "\t" . str_pad("-d", $padlen) . "Debug Mode\n";
    echo "\n";
    echo "\t" . str_pad("--match-length=n", $padlen) . "Minimum word length for a dictionary match\n";
    echo "\t" . str_pad("--index-of-coincidence=n", $padlen) . "Go up to keylength of n when testing\n";
    echo "\t" . str_pad("--key=value", $padlen) . "Test this key only\n";
    echo "\t" . str_pad("--index-only", $padlen) . "only show the index of coincidence compustats\n";
    
    exit;
  }

unset($tmp);