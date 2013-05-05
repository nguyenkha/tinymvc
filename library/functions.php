<?php
# Convert from dash separator -> CamelCase
function dashToCamelCase($s, $ucfirst = true) {
  $s = preg_replace('/-(.?)/e', "strtoupper('$1')", $s);
  if ($ucfirst) {
    return ucfirst($s);
  }
  return $s;
}

# Convert from dash separator -> CamelCase
function camelCaseToDash($s) {
  return strtolower(preg_replace('/([^A-Z])([A-Z])/', "$1-$2", $s)); 
}