<?php
/*
https://www.codewars.com/kata/54b42f9314d9229fd6000d9c/train/php
The goal of this exercise is to convert a string to a new string 
where each character in the new string is "(" if that character 
appears only once in the original string, or ")" if that character 
appears more than once in the original string. 
Ignore capitalization when determining if a character is a duplicate.

Examples
"din"      =>  "((("
"recede"   =>  "()()()"
"Success"  =>  ")())())"
"(( @"     =>  "))((" 
class MyTest extends TestCase
{
    public function testBasics() {
      $this->assertSame('(((', duplicate_encode('din'));
      $this->assertSame('()()()', duplicate_encode('recede'));
      $this->assertSame(')())())', duplicate_encode('Success'), 'should ignore case');
      $this->assertSame('))))))', duplicate_encode('iiiiii'), 'duplicate-only-string');
      $this->assertSame(')))))(', duplicate_encode(' ( ( )'));
    }
}
*/

function smart_duplicate_encode($word){
    $word = str_split(strtolower($word));
    $str = "";
    foreach($word as $key){
      (count(array_keys($word,$key))>1) ? $str .= ")" : $str .= "(";
    } 
    return $str;      
  }

function duplicate_encode($word){
	// ...
    $income = $word = strtolower($word);
    foreach(array_count_values(str_split($word)) as $char=>$count){
        if($count == 1){
            $word = substr_replace($word,"(",strpos($income,$char),1);
        }else{
            $word = str_replace($char,")",$word);
        }
    }
    return $word;
}
echo "()()()\n" . duplicate_encode('recede')."\n";
die();
/*
echo "(((\n" . duplicate_encode('din')."\n";
echo "()()()\n" . duplicate_encode('recede')."\n";
echo ")())())\n" . duplicate_encode('Success') . " | should ignore case\n";
echo "))))))\n" . duplicate_encode('iiiiii') ." | duplicate-only-string\n";
*/
