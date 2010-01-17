<?php
if(file_exists("../common/common.php")) define("INCLUDE_PATH", "../");
else if(file_exists("./common/common.php")) define("INCLUDE_PATH", "./");

require(INCLUDE_PATH . "common/common.php");

$ciphertext = new code();
$offset = ord($ciphertext->getReferenceLetterA());

$table = get_frequency_array($ciphertext);

if($options['verbose'])
  print_r($table);

// Yea, the graph grows down.  Cause there's no reason for it *not* to, and it's easier

$max = max($table);

echo "The cipher is " . strlen($ciphertext) . " characters long including whitespace.\n";
echo "The cipher is " . strlen(strip_whitespace($ciphertext)) . " characters long without whitespace.\n";

echo "Ciphertext Frequency:\n";
print_alpha_frequency_graph($table, $offset);

echo "\nNormal English Frequency:\n";
print_alpha_frequency_graph($frequencies['normal-english'], ord('a'));

$table = get_digraph_frequency_array($ciphertext);
$max = max($table);
$min = min($table);
if($min + 2 > $max)
  echo "\nDigraph Frequency is flat - not bothering...\n";
else
  {
    echo "\nDigraphs:\n";
    print_literal_frequency_graph($table, 2);
    
    echo "\nEnglish Digraphs:\n";
    print_literal_frequency_graph($frequencies['english-digraph'], 2);
  }
echo "\n";