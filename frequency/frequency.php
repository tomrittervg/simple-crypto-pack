<?php
if(file_exists("../common/common.php")) define("INCLUDE_PATH", "../");
else if(file_exists("./common/common.php")) define("INCLUDE_PATH", "./");

require(INCLUDE_PATH . "common/common.php");

$ciphertext = new code();
$offset = ord($ciphertext->getReferenceLetterA());

$table = get_frequency_array($ciphertext);

if($options['debug'])
  {
    echo "\nFrequency Array:\n";  
    print_r($table);
  }

echo "The cipher is " . strlen($ciphertext) . " characters long including whitespace.\n";
echo "The cipher is " . strlen(strip_whitespace($ciphertext)) . " characters long without whitespace.\n";

echo "Ciphertext Frequency:\n";
print_alpha_frequency_graph($table, $offset);

echo "\nNormal English Frequency:\n";
print_alpha_frequency_graph($frequencies['normal-english'], ord('a'));

//Digraphs
$digraph_table = get_digraph_frequency_array($ciphertext);
if($options['debug'])
  {
    echo "\nDigraph Array:\n";
    print_r($digraph_table);
  }
$max = max($digraph_table);
$min = min($digraph_table);
if($min + 2 > $max && !$options['verbose'] && !$options['debug'])
  echo "\nDigraph Frequency is flat - not bothering...\n";
else
  {
    echo "\nDigraphs:\n";
    print_literal_frequency_graph($digraph_table, 2);
    
    echo "\nEnglish Digraphs:\n";
    print_literal_frequency_graph($frequencies['english-digraph'], 2);
  }

//Doubles
function isdouble($k) { return $k[0] == $k[1]; }
$good_keys = array_filter(array_keys($digraph_table), "isdouble");
$doubles_table = array();

foreach($good_keys as $v)
  $doubles_table[$v] = $digraph_table[$v];

if($options['debug'])
  {
    echo "\nDoubles Array:\n";
    print_r($doubles_table);
  }
if(count($doubles_table) >= 1)
  {
    if(count($doubles_table) > 1)
      print_literal_frequency_graph($doubles_table, 2);
    else
      echo "Only one double found: " . key($doubles_table) . ", found " . current($doubles_table) . " time(s).\n";
    echo "English doubles are most commonly: LL, EE, SS, OO, FF, TT.\n";
  }
else
  echo "No doubled letters found...\n";

echo "\n";