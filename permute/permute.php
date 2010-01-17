<?php
if(file_exists("../common/common.php")) define("INCLUDE_PATH", "../");
else if(file_exists("./common/common.php")) define("INCLUDE_PATH", "./");

require(INCLUDE_PATH . "common/common.php");

$ciphertext = new code();

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