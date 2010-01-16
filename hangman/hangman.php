<?php
if(file_exists("../common/common.php")) define("INCLUDE_PATH", "../");
else if(file_exists("./common/common.php")) define("INCLUDE_PATH", "./");

require(INCLUDE_PATH . "common/common.php");

$ciphertext = new code();
$dict = new dictionary();

$offset = ord($ciphertext->getReferenceLetterA());


//time to make a shell
$continueshell = true;
$tempguess = strtoupper($ciphertext);
$replacements = array();
echo $tempguess;
do
  {
    $cmd = readline("> ");
    $cmd = trim(strtolower($cmd));
    readline_add_history($cmd);

    switch($cmd)
      {
      case 'exit':
	echo "Goodbye.\n";
	$continueshell=false;
	break;
      case 'restart':
	$tempguess = strtoupper($ciphertext);
	$replacements = array();
	echo $tempguess;
	break;
      case 'showlog':
	print_r($replacements);
	break;
      case 'help':
	echo "Valid Commands:\n";
	echo "\texit\n";
	echo "\trestart\n";
	echo "\tshowlog\n";
	echo "\thelp\n";
	echo "\tc=p\n";
	break;
      case '':
      default:
	{
	  $sides = explode('=', $cmd);
	  if(count($sides) != 2) 
	    {
	      echo "Invalid syntax\n";
	      break;
	    }
	  $sides[0] = strtolower(trim($sides[0]));
	  $sides[1] = strtolower(trim($sides[1]));
	  if(strlen($sides[0]) != 1 || strlen($sides[1]) != 1)
	    {
	      echo "Invalid syntax\n";
	      break;
	    }
	  if(isset($replacements[$sides[0]]))
	    {
	      echo "You already replaced the letter " . $sides[0] . "\n";
	      break;
	    }
	  if(in_array($sides[1], $replacements))
	    {
	      echo "You already replaced " . array_search($sides[1], $replacements) . " with " . $sides[1] . "\n";
	      $confirm = readline("Are you sure you want to replace again? [y/n]");
	      if(trim($confirm) == "" || trim(strtolower($confirm)) == "y")
		;
	      else
		break;
	    }

	  $replacements[$sides[0]] = $sides[1];
	  $tempguess = str_replace(strtoupper($sides[0]), $sides[1], $tempguess);
	  echo $tempguess;

	  break;
	}
      }
  }    while($continueshell);