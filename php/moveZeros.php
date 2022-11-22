<?php
/*
https://www.codewars.com/kata/52597aa56021e91c93000cb0/train/php
Write an algorithm that takes an array and moves all of the zeros to the end, 
preserving the order of the other elements.

moveZeros([false,1,0,1,2,0,1,3,"a"]) // returns[false,1,1,2,1,3,"a",0,0]
<?php
use PHPUnit\Framework\TestCase;

class MovingZeroToTheEndTest extends TestCase
{
    public function testExamples() {
        $this->assertSame([1,2,1,1,3,1,0,0,0,0], moveZeros([1,2,0,1,0,1,0,3,0,1]));
        $this->assertSame([9,9,1,2,1,1,3,1,9,9,0,0,0,0,0,0,0,0,0,0], moveZeros([9,0.0,0,9,1,2,0,1,0,1,0.0,3,0,1,9,0,0,0,0,9]));
        $this->assertSame(["a","b","c","d",1,1,3,1,9,9,0,0,0,0,0,0,0,0,0,0], moveZeros(["a",0,0,"b","c","d",0,1,0,1,0,3,0,1,9,0,0,0,0,9]));
        $this->assertSame(["a","b",null,"c","d",1,false,1,3,[],1,9,9,0,0,0,0,0,0,0,0,0,0], moveZeros(["a",0,0,"b",null,"c","d",0,1,false,0,1,0,3,[],0,1,9,0,0,0,0,9]));
        $this->assertSame([1,null,2,false,1,0,0], moveZeros([0,1,null,2,false,1,0]));
        $this->assertSame(["a","b"], moveZeros(["a","b"]));
        $this->assertSame(["a"], moveZeros(["a"]));
        $this->assertSame([0,0], moveZeros([0,0]));
        $this->assertSame([0], moveZeros([0]));
        $this->assertSame([false], moveZeros([false]));
        $this->assertSame([], moveZeros([]));
    }
}
*/
function moveZeros(array $items): array
{
    $zeros = [];
    $items = array_filter($items,function(&$v) use (&$zeros) {
        if(is_numeric($v) && $v == 0){
            $zeros[] = 0;
            return false;
        }
        return true;
    });
    return array_merge($items,$zeros);
}

function Clever1moveZeros(array $items): array {
    return array_pad(array_filter($items, function($x){return $x !== 0 and $x !== 0.0;}), count($items), 0);
}
function Clever2moveZeros(array $items): array
{
  $ret = array_diff($items,[0]);
  return array_merge($ret,array_fill(0,count($items)-count($ret),0));
}
//echo "[1,2,1,1,3,1,0,0,0,0]\n";
//print_r(moveZeros([1,2,0,1,0,1,0,3,0,1]));
echo "[a,b,c,d,1,1,3,1,9,9,0,0,0,0,0,0,0,0,0,0]\n";
echo "[". implode(",",Clever1moveZeros(["a",0,0,"b","c","d",0,1,0,1,0,3,0,1,9,0,0,0,0,9]))."]\n";