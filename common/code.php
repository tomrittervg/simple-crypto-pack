<?php

define("CIPHERTEXT_CASE", "lowercase");
//define("CIPHERTEXT_CASE", "uppercase");
//lowercase,uppercase,none

class code implements ArrayAccess
{
  private $_ciphertext = "";
  public $length;

  function __construct()
  {
    global $options;
    $this->loadcipher();
    if($options['verbose'])
      echo "Ciphertext:\n$this\n";
  }

  private function loadcipher()
  {
    $handle = fopen(INCLUDE_PATH . "ciphertext.txt", 'r');
    $this->_ciphertext = "";
    while($line = fread($handle, 1024))
      $this->_ciphertext .= $line;
    fclose($handle);
    $this->length = strlen($this->_ciphertext);
    if(CIPHERTEXT_CASE =="lowercase")
      $this->_ciphertext = strtolower($this->_ciphertext);
    else if(CIPHERTEXT_CASE =="uppercase")
      $this->_ciphertext = strtoupper($this->_ciphertext);
  }

  public function __toString()
  {
    return $this->_ciphertext;
  }
  public function length()
  {
    return $this->length;
  }
  public function getReferenceLetterA()
  {
    if(CIPHERTEXT_CASE =="lowercase")
      return "a";
    else if(CIPHERTEXT_CASE =="uppercase")
      return "A";
    else
      die("code::getReferenceLetterA called on unknown case mode ". CIPHERTEXT_CASE . " - you didn't write code for this\n");
  }
  public function offsetSet($offset, $value) {
    die("ReadOnly");
  }
  public function offsetExists($offset) {
    return isset($this->_ciphertext[$offset]);
  }
  public function offsetUnset($offset) {
    unset($this->_ciphertext[$offset]);
  }
  public function offsetGet($offset) {
    return isset($this->_ciphertext[$offset]) ? $this->_ciphertext[$offset] : null;
  }

}