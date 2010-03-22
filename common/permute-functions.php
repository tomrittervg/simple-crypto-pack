<?php

function permute_nth_letter($text, $shift)
{
  $newstr = "";
  $startAt = 0;
  while (strlen($newstr) < strlen($text))
    {
      for($i = $startAt; $i < strlen($text); $i += $shift)
	$newstr .= $text[$i];
      $startAt++;
    }
  return $newstr;
}