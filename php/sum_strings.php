<?php
/*
https://www.codewars.com/kata/5324945e2ece5e1f32000370/train/php
iven the string representations of two integers, return the string 
representation of the sum of those integers.

For example:

sumStrings('1','2') // => '3'
A string representation of an integer will contain no characters besides the ten 
numerals "0" to "9".

I have removed the use of BigInteger and BigDecimal in java

Python: your solution need to work with huge numbers (about a milion digits), 
converting to int will not work.
*/
/*
function clever_sum_strings(string $a, string $b): string {
    $a = empty($a) ? 0 : $a;
    $b = empty($b) ? 0 : $b;
    return preg_replace("/[\n\r]|\\\\+/", "", shell_exec('echo "'.$a.'+'.$b.'"|bc '));
}

function sum_strings($a, $b) {
    $result = '';
    
    $maxLength = max(strlen($a), strlen($b));
    $a = strrev($a);
    $b = strrev($b);
    
    $remain = 0;
    for ($i = 0; $i <= $maxLength; $i++){
      $aVal = isset($a[$i]) ? (int)$a[$i] : 0;
      $bVal = isset($b[$i]) ? (int)$b[$i] : 0;
      
      $res = $aVal + $bVal + $remain;
      $val = $res % 10;
      $remain = intdiv($res, 10);
      
      $result .= $val;
    }
    return ltrim(strrev($result), '0');
}
*/
function sum_strings($a, $b) {
    
    $I = strlen($a) >= strlen($b) ? $a : $b;
    $II = strlen($a) >= strlen($b) ? $b : $a;

    $a = $I;
    $b = $II;

    if(intval($a) < intval($b)){
        $I = $b;
        $II = $a;
    }
    
    $a = strrev($a);
    $b = strrev($b);

    for($i=0;$i<max(strlen($a),strlen($b));$i++){
        $a.= !isset($a[$i]) ? 0 : '';
        $b.= !isset($b[$i]) ? 0 : '';
    }

    $a = strrev($a);
    $b = strrev($b);

    $sum = "";
    $remain = 0;
    for($i=strlen($a)-1;$i>-1;$i--){
        $x = isset($a[$i]) ? $a[$i] : 0;
        $y = isset($b[$i]) ? $b[$i] : 0;
        $res = $x+$y+$remain;
        $remain = intdiv($res, 10);
        $res = $remain > 0 ? intval(strval($res)[1]):$res;
        
        $sum.=strval($res);
        
    }
    
    return strrev(rtrim($sum.$remain,0));
}
print_r(['8670', sum_strings('00103', '08567')]);

//print_r(['131', sum_strings('115', '16')]);
