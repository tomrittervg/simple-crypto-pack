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