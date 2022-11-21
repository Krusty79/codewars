<?php
/*
https://www.codewars.com/kata/54e6533c92449cc251001667/train/php
Implement the function unique_in_order which takes as argument a sequence and returns a list of items without any elements with the same value next to each other and preserving the original order of elements.

For example:

uniqueInOrder("AAAABBBCCDAABBB") == {'A', 'B', 'C', 'D', 'A', 'B'}
uniqueInOrder("ABBCcAD")         == {'A', 'B', 'C', 'c', 'A', 'D'}
uniqueInOrder([1,2,2,3,3])       == {1,2,3}

class MyTest extends TestCase
{
    // test function names should start with "test"
    public function testSampleTest() {
      $this->assertSame(['A','B','C','D','A','B'], uniqueInOrder('AAAABBBCCDAABBB'));
    }
}
*/

function uniqueInOrder($iterable){
    $iterable = is_array($iterable) ? implode($iterable) : $iterable;
    if(strlen($iterable) < 1) return [];
    $ret = str_split(preg_replace('/(.)\1{1,}/','$1',$iterable));
    array_walk($ret, function (&$value) {
        if (ctype_digit($value)) {
            $value = (int) $value;
        }
    });
    return $ret;
  }

  print_r([1,2,3]);
  print_r(uniqueInOrder([1,2,3,4,5]));