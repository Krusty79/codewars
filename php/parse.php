<?php
/*
https://www.codewars.com/kata/51e0007c1f9378fa810002a9/train/php
Write a simple parser that will parse and run Deadfish.

Deadfish has 4 commands, each 1 character long:

i increments the value (initially 0)
d decrements the value
s squares the value
o outputs the value into the return array
Invalid characters should be ignored.

parse("iiisdoso") => [ 8, 64 ]
class MyTest extends TestCase
{
    public function testSampleTests() {
      $this->assertSame([ 8, 64 ], parse("iiisdoso"));
      $this->assertSame([ 8, 64 ], parse("iiisxxxdoso"));
    }
}
*/
function parse($data) {
    $output = [];
    $value = 0;
    foreach(str_split(preg_replace('/[^i,d,s,o]/','',$data)) as $command){
        switch ($command) {
            case "i":
                $value++;
                break;
            case "d":
                $value--;
                break;
            case "s":
                $value **= 2;
                break;
            case "o":
                $output[]=$value;
                break;
        }
    }
    return $output;
}

print_r(parse("iiisdoso"));
print_r(parse("iiisxxxdoso"));