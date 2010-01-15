<?php

function print_frequency_graph($a, $offset)
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