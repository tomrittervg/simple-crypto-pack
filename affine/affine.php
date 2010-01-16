<?php
if(file_exists("../common/common.php")) define("INCLUDE_PATH", "../");
else if(file_exists("./common/common.php")) define("INCLUDE_PATH", "./");

require(INCLUDE_PATH . "common/common.php");

$ciphertext = new code();
$dict = new dictionary();
$foundAnything = false;
$offset = ord($ciphertext->getReferenceLetterA());

$aValues = array(3, 5, 7, 9, 11, 13, 15, 17, 19, 21, 23, 25);
$bValues = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25);

foreach($aValues as $a)
  {
    foreach($bValues as $b)
      {
        $shifted = "";
        for($i=0; $i<$ciphertext->length; $i++)
          {
            if($ciphertext[$i] == " " || $ciphertext[$i] == "\n" ||
               $ciphertext[$i] == "\t" || $ciphertext[$i] == "\r")
              {
                $shifted .= $ciphertext[$i];
                continue;
              }

            $t = ord($ciphertext[$i]) - $offset;
            $u = $t * $a;
            $v = $u - $b;
            $w = $v % 26;
            if($w < 0) $w += 26;
            $x = $w + $offset;

            $shifted .= chr($x);
          }

        $matches = $dict->matchingwords($shifted);
        if(count($matches) > 0)
          {
            $foundAnything = true;
            echo "Shift of ($a*X + $b) produced matches:\n";
            echo "  " . implode(", ", $matches) . "\n";
            echo $shifted . "\n\n";
          }
        else if($options['verbose'])
          {
            $foundAnything = true;
            echo "Shift of ($a*X + $b) produced nothing.\n";
          }
        else if($options['debug'])
          {
            $foundAnything = true;
            echo "Shift of ($a*X + $b) did not find a match:\n";
            echo $shifted . "\n\n";
          }
      }
  }
if($foundAnything)
  echo "Remeber - The value of $a isn't the encryption value of A - you have to take the coprime value of it!\n";