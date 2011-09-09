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

function permute_into_columns($text, $columns)
{
  $each = strlen($text) / $columns;
  $cols = array();
  $i = 0;
  while($i < strlen($text))
    {
      $cols[] = substr($text, $i, $each);
      $i += $each;
    }

  return $cols;
}

function allorderings($items)
{
  global $pc_permutations;
  $pc_permutations = array();

  pc_permute($items);

  $results = $pc_permutations;
  $pc_permutations = array();
  return $results;
}

function pc_permute($items, $perms = array( ))
{
  global $pc_permutations;
  if (empty($items))
    {
      $pc_permutations[] = $perms;
    }
  else
    {
      for ($i = count($items) - 1; $i >= 0; --$i)
        {
          $newitems = $items;
          $newperms = $perms;
          list($foo) = array_splice($newitems, $i, 1);
          array_unshift($newperms, $foo);
          pc_permute($newitems, $newperms);
        }
    }
}
