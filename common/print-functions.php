<?php

function print_alpha_frequency_graph($a, $offset)
{
  $max = max($a);

  for($i=0; $i<26; $i++)
    echo " " . chr($i + $offset) . " ";
  echo "\n";
  for($i=0; $i<26; $i++)
    echo "---";
  echo "\n";
  for($i=0; $i<10; $i++)
    {
      for($j=0; $j<26; $j++)
        {
          echo " ";
          if(($a[chr($j + $offset)] / $max) > ($i / 10))
            echo "X";
          else
            echo " ";
          echo " ";
        }
      echo"\n";
    }
}

function print_literal_frequency_graph($a, $keylen)
{
  $max = max($a);
  
  foreach($a as $k=>$v)
    echo str_pad(whitespace_escape($k), $keylen) . " ";
  echo "\n";
  for($i=0; $i<count($a); $i++)
    echo str_pad("", $keylen, "-") . "-";
  echo "\n";
  for($j=0; $j<10; $j++)
    {
      foreach($a as $k=>$v)
	{
	  if(($v / $max) > ($j / 10))
	    echo str_pad("", $keylen, "X");
	  else
	    echo str_pad("", $keylen, " ");
	  echo " ";
	}
      echo "\n";
    }
}

function print_odd_men_out($freq, $odd)
{
  $totalMen = 0;
  $oddMen = 0;
  
  foreach($freq as $man => $f)
    {
      $totalMen += $f;
      if(in_array($man, $odd))
	$oddMen += $f;
    }
  
  echo "Out of a total of $totalMen, $oddMen are odd men out, or " . round(($oddMen / $totalMen) * 100, 2) . "%.\n";
}