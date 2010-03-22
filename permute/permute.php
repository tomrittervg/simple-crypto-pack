<?php
if(file_exists("../common/common.php")) define("INCLUDE_PATH", "../");
else if(file_exists("./common/common.php")) define("INCLUDE_PATH", "./");

require(INCLUDE_PATH . "common/common.php");

$ciphertext = new code();
$dict = new dictionary();

$offset = ord($ciphertext->getReferenceLetterA());

echo "The ciphertext reversed is:\n";
echo strrev($ciphertext);
echo "\n\n";

echo "Going to try tokenizing...\n\n";

//Across
$tokens = array();
$sofar = "";
$maxlength = 0;
for($i=0; $i<$ciphertext->length; $i++)
  {
    if(is_whitespace($ciphertext[$i]))
      {
	$tokens[] = $sofar;
	if(strlen($sofar) > $maxlength)
	  $maxlength = strlen($sofar);
	$sofar = "";
      }
    else
      {
	$sofar .= $ciphertext[$i];
      }
  }

echo "Ciphertext, ordered by character in token, is:\n";
$index = 0;
for($z=0; $z<$maxlength; $z++)
  {
    foreach($tokens as $t)
      {
	echo $t[$z];
      }
  }
echo "\n\n";


echo "Now trying every nth letter:\n";

for($z=1; $z < $ciphertext->length; $z++)
  {
    $newciphertext = permute_nth_letter(strip_whitespace($ciphertext), $z);
    $matches = $dict->matchingwords($newciphertext);
    if(count($matches) > 0)
      {
	echo "Shift of ".($z+1)." produced matches:\n";
	echo "  " . implode(", ", $matches) . "\n";
	echo $newciphertext . "\n\n";
      }
    else if($options['verbose'])
      {
	echo "Shift of ".($z+1)." produced nothing.\n";
      }
    else if($options['debug'])
      {
	echo "Shift of ".($z+1)." did not find a match:\n";
	echo $newciphertext . "\n\n";
      }
   
  }

echo "\n\n";