<?php
if(file_exists("../common/common.php")) define("INCLUDE_PATH", "../");
else if(file_exists("./common/common.php")) define("INCLUDE_PATH", "./");

require(INCLUDE_PATH . "common/common.php");

$ciphertext = new code();
$dict = new dictionary();

$offset = ord($ciphertext->getReferenceLetterA());

if(isset($options["key"]))
  $keys = array($options["key"]);
else
  $keys = $dict;


echo "Running Index of Coincidence Tests for keylengths 1-10...\n";
for($i=1; $i<11; $i++)
  {
    print_coincidence_columnsplit($ciphertext, $i);
  }
print_english_coincidence();

echo "\nRunning Key Tests...\n";
foreach($keys as $key)
  {
    if(CIPHERTEXT_CASE =="lowercase") $key = strtolower($key);
    else if(CIPHERTEXT_CASE =="uppercase") $key = strtoupper($key);
    else $key = $key;


    $shiftedup = "";
    $shifteddown = "";
    for($i=0, $j=0; $i<$ciphertext->length; $i++, $j++)
      {
        if($ciphertext[$i] == " " || $ciphertext[$i] == "\n" ||
           $ciphertext[$i] == "\t" || $ciphertext[$i] == "\r")
          {
            $shiftedup .= $ciphertext[$i];
            $shifteddown .= $ciphertext[$i];
            continue;
          }

        $m = $j % strlen($key);
        $n = ord($key[$m]) - $offset;
        $o = ord($ciphertext[$i]) - $offset;

        $u = ($o + $n) % 26;
        $v = $u + $offset;

        $x = ($o - $n) % 26;
        if($x < 0) $x = $x + 26;
        $y = $x + $offset;

        $shiftedup .= chr($v);
        $shifteddown .= chr($y);
      }

    foreach(array($shiftedup, $shifteddown) as $line)
      {
        $matches = $dict->matchingwords($line);
        if(count($matches) > 0)
          {
            echo "Shift of $key produced matches:\n";
            echo "  " . implode(", ", $matches) . "\n";
            echo $line . "\n\n";
          }
        else if($options['verbose'])
          {
            echo "Shift of $key produced nothing.\n";
          }
        else if($options['debug'])
          {
            echo "Shift of $key did not find a match:\n";
            echo $line . "\n\n";
          }
      }
  }