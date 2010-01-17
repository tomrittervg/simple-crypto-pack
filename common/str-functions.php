<?php

function strip_whitespace($s)
{
  return str_replace(array(" ", "\r", "\t", "\n"), "", $s);
}
function is_whitespace($c)
{
  return
    " " == $c ||
    "\r" == $c ||
    "\n" == $c ||
    "\t" == $c;
}
function whitespace_escape($c)
{
  switch($c)
    {
    case "\t" : return '\\t';
    case "\n" : return '\\n';
    case "\r" : return '\\r';
    default: return $c;
    }
}