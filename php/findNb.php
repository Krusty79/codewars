<?php
/*
https://www.codewars.com/kata/5592e3bd57b64d00f3000047/train/php
Your task is to construct a building which will be a pile of n cubes. The cube at the bottom will have a volume of n3 n^3n 
3
 , the cube above will have volume of (n−1)3 (n-1)^3(n−1) 
3
  and so on until the top which will have a volume of 13 1^31 
3
 .

You are given the total volume m of the building. Being given m can you find the number n of cubes you will have to build?

The parameter of the function findNb (find_nb, find-nb, findNb, ...) will be an integer m and you have to return the integer n such as n3+(n−1)3+...+13=m n^3 + (n-1)^3 + ... + 1^3 = mn 
3
 +(n−1) 
3
 +...+1 
3
 =m if such a n exists or -1 if there is no such n.

Examples:
findNb(1071225) --> 45

findNb(91716553919377) --> -1

class PileOfCubesTest extends TestCase
{
    private function revTest($actual, $expected) {
        $this->assertSame($expected, $actual);
    }
    public function testBasics() {
        $this->revTest(findNb(4183059834009), 2022);
        $this->revTest(findNb(24723578342962), -1);
        $this->revTest(findNb(135440716410000), 4824);
    }
}
*/
function findNb($m) {
    $n = 0;
    while ( $m - $n > 0 ) {
        $n++;
        $m -= pow( $n+1, 3);
    }  
    return $m-1 !==0 ? -1 : $n+1;
}

echo findNb(135440716410000)." == -1\n";

function preeg_filter($str){
    return str_split(preg_replace('/(.)\1{1,}/','$1',is_string($str)?$str:implode($str)));
}

function filter($str){
    $arr = is_string($str) ? str_split($str) : $str;
    return array_filter($arr,function($v,$k) use($arr) {return $k == 0 ? true : $v !== $arr[$k-1];},1);
}

print_r(preeg_filter('AAABBCCDAA'));
print_r(preeg_filter([1,1,2,2,3,3,4]));

print_r(filter('AAABBCCDAA'));
print_r(filter([1,1,2,2,3,3,4]));