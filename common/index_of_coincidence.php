<?php

function print_coincidence($ciphertext)
{
  echo "Index of Coincidence over text: " . compute_index_of_coincidence($ciphertext) . "\n";
}
function print_coincidence_columnsplit($ciphertext, $l)
{
  $len = strlen(strip_whitespace($ciphertext));
  if(($len / 2) < $l)
    echo "Cannot compute an index of " . $l . " - string too short.\n";
  else
    echo "Index of Coincidence over text for split of $l: " . compute_index_of_coincidence_columnsplit($ciphertext, $l) . "\n";
}
function print_english_coincidence()
{
  echo "English Text Coincidence is 1.73\n";
}

function compute_index_of_coincidence($s)
{
  $c = 26;
  $s = strtolower($s);
  $freqs = get_frequency_array($s);
  $offset = ord('a');
  $len = strlen(strip_whitespace($s));

  $ioc = 0;
  $runningsum = 0;
  for($i=0; $i<$c; $i++)
    {
      $f = $freqs[chr($i + $offset)];
      $runningsum += ($f * ($f-1)) / ($len * ($len -1));
    }
  $ioc = (1 / (1 / $c)) * $runningsum;

  return $ioc;
}

function compute_index_of_coincidence_columnsplit($s, $l)
{
  $string_arrays = array();
  $s = strtolower(strip_whitespace($s));

  for($i=0; $i<strlen($s); $i++)
    {
      $string_arrays[$i % $l] .= $s[$i];
    }

  $iocsums = 0;
  for($i=0; $i<$l; $i++)
    {
      $iocsums += compute_index_of_coincidence($string_arrays[$i]);
    }

  return $iocsums / $l;
}