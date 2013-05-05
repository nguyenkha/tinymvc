<?php
# Convert from underscore -> CamelCase
function underscoreToCamelCase($s, $ucfirst = true) {
  $s = preg_replace('/_(.?)/e', "strtoupper('$1')", $s);
  if ($ucfirst) {
    return ucfirst($s);
  }
  return $s;
}

function camelCaseToUnderscore($s) {
  return strtolower(preg_replace('/([^A-Z])([A-Z])/', "$1_$2", $s)); 
}