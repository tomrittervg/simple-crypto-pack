<?php
if(file_exists("../common/common.php")) define("INCLUDE_PATH", "../");
else if(file_exists("./common/common.php")) define("INCLUDE_PATH", "./");

require(INCLUDE_PATH . "common/common.php");

$ciphertext = new code();
$dict = new dictionary();

$offset = ord($ciphertext->getReferenceLetterA());

print_coincidence($ciphertext);
print_english_coincidence();

for($c=0; $c<26; $c++)
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
        $u = $t + $c;
        $v = $u %26;
        $w = $v + $offset;

        $shifted .= chr($w);
      }

    $matches = $dict->matchingwords($shifted);
    if(count($matches) > 0)
      {
        echo "Shift of $c produced matches:\n";
	echo "  " . implode(", ", $matches) . "\n";
        echo $shifted . "\n\n";
      }
    else if($options['verbose'])
      {
        echo "Shift of $c produced nothing.\n";
      }
    else if($options['debug'])
      {
        echo "Shift of $c did not find a match:\n";
        echo $shifted . "\n\n";
      }
  }