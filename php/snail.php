<?php
/*
https://www.codewars.com/kata/521c2db8ddc89b9b7a0000c1/train/php
Snail Sort
Given an n x n array, return the array elements arranged from outermost elements to the middle element, traveling clockwise.

array = [[1,2,3],
         [4,5,6],
         [7,8,9]]
snail(array) #=> [1,2,3,6,9,8,7,4,5]
For better understanding, please follow the numbers of the next array consecutively:

array = [[1,2,3],
         [8,9,4],
         [7,6,5]]
snail(array) #=> [1,2,3,4,5,6,7,8,9]
This image will illustrate things more clearly:


NOTE: The idea is not sort the elements from the lowest value to the highest; the idea is to traverse the 2-d array in a clockwise snailshell pattern.

NOTE 2: The 0x0 (empty matrix) is represented as en empty array inside an array [[]].
class SnailTest extends TestCase {
  public function testDescriptionExamples() {
    $this->assertSame([1, 2, 3, 6, 9, 8, 7, 4, 5], snail([
      [1, 2, 3],
      [4, 5, 6],
      [7, 8, 9]
    ]));
    $this->assertSame([1, 2, 3, 4, 5, 6, 7, 8, 9], snail([
      [1, 2, 3],
      [8, 9, 4],
      [7, 6, 5]
    ]));
    $this->assertSame([1, 2, 3, 1, 4, 7, 7, 9, 8, 7, 7, 4, 5, 6, 9, 8], snail([
      [1, 2, 3, 1],
      [4, 5, 6, 4],
      [7, 8, 9, 7],
      [7, 8, 9, 7]
    ]));
    $this->assertSame([], snail([[]]), 'Your solution should also work properly for an empty matrix');
  }
}
*/
function snail(array $array): array {
    $arr = [];
    $position = 0;
    while($array){
        print_r(array_map(function($v){
          return $v="[".implode(",",$v)."]";
        },$array));
        for($row=0;$row<count($array);$row++){
            //echo "row [$row] == count[".count($array)."]\n";
            if($row == 0 || $row == count($array)-1){
                $position = $row == 0 ? count($array[$row])-1 : 0;
                $arr = array_merge($arr,$row > 0 ? array_reverse($array[$row]) : $array[$row]);
                //echo "$position add row [".implode(",",$arr)."]\n";
                if($row == count($array)-1){
                    //echo "go up\n";
                    for($r=count($array)-2;$r>0;$r--){
                        //echo "add-element [".$array[$r][$position]."] row=[$r] position=[$position] => [".implode(",",$arr)."]\n";
                        //echo "rem element [".$array[$r][$position]."] row=[$r] position=[$position] [".implode(",",$array[$r])."] => ";
                        $arr[] = $array[$r][$position];
                        array_splice($array[$r],$position,1);
                        //echo "[".implode(",",$array[$r])."]\n";
                    }
                }
            }
            else{
                $arr[] = $array[$row][$position];
                //echo "add element [".$array[$row][$position]."] row=[$row] position=[$position] [".implode(",",$array[$row])."] => [".implode(",",$arr)."]\n";
                //echo "rem element [".$array[$row][$position]."] row=[$row] position=[$position] [".implode(",",$array[$row])."] => ";
                array_splice($array[$row],$position,1);
                //echo "[".implode(",",$array[$row])."]\n";
            }
        }
        
        //unset($array[0]);
        //unset($array[count($array)]);
        array_splice($array,0,1);
        array_splice($array,count($array)-1,1);
        
        print_r(array_map(function($v){
          return $v="[".implode(",",$v)."]";
        },$array));
    } 
    return $arr;
}

echo "[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36], \n[".implode(",",snail([
    [1,2,3,4,5,6],
    [20,21,22,23,24,7],
    [19,32,33,34,25,8],
    [18,31,36,35,26,9],
    [17,30,29,28,27,10],
    [16,15,14,13,12,11]
  ]))."]\n";
/*
echo "[1, 2, 3, 6, 9, 8, 7, 4, 5], [".implode(",",snail([
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
  ]))."]\n";

    [4, 5, 6],
    [7, 8, 9],

    [1, 2, 3, 1, 4, 7, 7, 9, 8, 7
*/