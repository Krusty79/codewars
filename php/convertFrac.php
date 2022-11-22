<?php
/*
https://www.codewars.com/kata/54d7660d2daf68c619000d95/train/php
Common denominators

You will have a list of rationals in the form

{ {numer_1, denom_1} , ... {numer_n, denom_n} } 
or
[ [numer_1, denom_1] , ... [numer_n, denom_n] ] 
or
[ (numer_1, denom_1) , ... (numer_n, denom_n) ] 
where all numbers are positive ints. You have to produce a result in the form:

(N_1, D) ... (N_n, D) 
or
[ [N_1, D] ... [N_n, D] ] 
or
[ (N_1', D) , ... (N_n, D) ] 
or
{{N_1, D} ... {N_n, D}} 
or
"(N_1, D) ... (N_n, D)"
depending on the language (See Example tests) in which D is as small as possible and

N_1/D == numer_1/denom_1 ... N_n/D == numer_n,/denom_n.
Example:
convertFracs [(1, 2), (1, 3), (1, 4)] `shouldBe` [(6, 12), (4, 12), (3, 12)]
Note:
Due to the fact that the first translations were written long ago - more than 6 years - these first translations have only irreducible fractions.

Newer translations have some reducible fractions. To be on the safe side it is better to do a bit more work by simplifying fractions even if they don't have to be.

Note for Bash:
input is a string, e.g "2,4,2,6,2,8" output is then "6 12 4 12 3 12"

class CommonDenominatorTest extends TestCase
{
    private function revTest($actual, $expected) {
        $this->assertSame($expected, $actual);
    }
    public function testBasics() {        
        $lst = [ [1, 2], [1, 3], [1, 4] ];
        $this->revTest(convertFrac($lst), "(6,12)(4,12)(3,12)");
        $lst = [ [69, 130], [87, 1310], [3, 4] ];
        $this->revTest(convertFrac($lst), "(18078,34060)(2262,34060)(25545,34060)");
        $lst = [  ];
        $this->revTest(convertFrac($lst), "");
        $lst = [ [77, 130], [84, 131], [3, 4] ];
        $this->revTest(convertFrac($lst), "(20174,34060)(21840,34060)(25545,34060)");
    }
}
*/

function convertFrac($lst){
    if(empty($lst)){
        return "";
    }
    $D = 1;//min($lst)[1];
    
    //die("D = [$D]");
    
    $i=sizeof($lst)-1;
    while($i > -1){
        $val = $lst[$i];
        $N_1 = (($val[0]/$val[1])*$D);
        //$N_1 = 20.1321312321321;
        if(/*!is_integer($D/$val[1])*/ strpos($N_1,".") > -1){
            var_dump($N_1);
            echo "Loop again: N_1 = [$N_1] : [".(strpos($N_1,"."))."] \n";
            echo "$i: D = $D : $D/$val[1] = ".$D/$val[1]." | [".is_integer($D/$val[1])."] N_1 = [$N_1]\n";
            $D++;
            $i=sizeof($lst)-1;
        }else{
            $i--;
            echo "$i: D = $D : $D/$val[1] = ".$D/$val[1]." | [".is_integer($D/$val[1])."]\n";
        }
    }
    
    $lst = array_map(function($v) use($D){
        $N_1 = ($v[0]/$v[1])*$D;
        return "(".$N_1.",$D)"; 
    },$lst);

    //die("\n[$D]\n");
    
    return implode($lst); 
}
/*
$lst = [ [1, 2], [1, 3], [1, 4] ];
echo "(6,12)(4,12)(3,12) => " . convertFrac($lst)."\n";

$lst = [ [69, 130], [87, 1310], [3, 4] ];
echo "(18078,34060)(2262,34060)(25545,34060) => " . convertFrac($lst)."\n";

$lst = [[69,138],[80,1310],[30,40]];
echo "(262,524)(32,524)(393,524) => " . convertFrac($lst)."\n";
*/

$lst = [[7,8],[4,5],[4,5],[3,6]];
$lst = [ [1, 2], [1, 3], [1, 4] ];
$lst = [ [26, 52], [76, 228], [31, 124] ];
echo "(6,12)(4,12)(3,12) => " . convertFrac($lst)."\n";