<?php

function strip_whitespace($s)
{
  return str_replace(array(" ", "\r", "\t", "\n"), "", $s);
}