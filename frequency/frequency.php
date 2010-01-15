<?php
if(file_exists("../common/common.php")) define("INCLUDE_PATH", "../");
else if(file_exists("./common/common.php")) define("INCLUDE_PATH", "./");

require(INCLUDE_PATH . "common/common.php");

$ciphertext = new code();
$offset = ord($ciphertext->getReferenceLetterA());
$table = array();

for($i=0; $i<$ciphertext->length; $i++)
  {
    $table[$ciphertext[$i]] += 1;
  }

ksort($table);

if($options['verbose'])
  print_r($table);

// Yea, the graph grows down.  Cause there's no reason for it *not* to, and it's easier

$max = max($table);

echo "Ciphertext Frequency:\n";
print_frequency_graph($table, $offset);

echo "\nNormal English Frequency:\n";
print_frequency_graph($frequencies['normal-english'], $offset);

echo "\n";