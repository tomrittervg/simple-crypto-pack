<?php

function get_frequency_array($s)
{
  $f = array();
  for($i=0; $i<strlen($s); $i++)
    $f[$s[$i]] += 1;
  ksort($f);
  return $f;
}

function get_digraph_frequency_array($s)
{
  $s = strip_whitespace($s);
  $f = array();
  for($i=0; $i<strlen($s)-1; $i++)
    $f[$s[$i] . $s[$i + 1]] += 1;
  ksort($f);
  return $f;
}

$frequencies = array();

//relative - space is included in the percentage, but omitted here
$frequencies['normal-english'] = array(
				      'a' => 0.0651738 ,
				      'b' => 0.0124248 ,
				      'c' => 0.0217339 ,
				      'd' => 0.0349835 ,
				      'e' => 0.1041442 ,
				      'f' => 0.0197881 ,
				      'g' => 0.0158610 ,
				      'h' => 0.0492888 ,
				      'i' => 0.0558094 ,
				      'j' => 0.0009033 ,
				      'k' => 0.0050529 ,
				      'l' => 0.0331490 ,
				      'm' => 0.0202124 ,
				      'n' => 0.0564513 ,
				      'o' => 0.0596302 ,
				      'p' => 0.0137645 ,
				      'q' => 0.0008606 ,
				      'r' => 0.0497563 ,
				      's' => 0.0515760 ,
				      't' => 0.0729357 ,
				      'u' => 0.0225134 ,
				      'v' => 0.0082903 ,
				      'w' => 0.0171272 ,
				      'x' => 0.0013692 ,
				      'y' => 0.0145984 ,
				      'z' => 0.0007836 );
$frequencies['english-digraph'] = array(
					'th' => 1.52,
					'he' => 1.28,
					'in' => 0.94,
					'er' => 0.94,
					'an' => 0.82,
					're' => 0.68,
					'nd' => 0.63,
					'at' => 0.59,
					'on' => 0.57,
					'nt' => 0.56,
					'ha' => 0.56,
					'es' => 0.56,
					'st' => 0.55,
					'en' => 0.55,
					'ed' => 0.53,
					'to' => 0.52,
					'it' => 0.50,
					'ou' => 0.50,
					'ea' => 0.47,
					'hi' => 0.46,
					'is' => 0.46,
					'or' => 0.43,
					'ti' => 0.34,
					'as' => 0.33,
					'te' => 0.27,
					'et' => 0.19 );