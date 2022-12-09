<?php
/*
https://www.codewars.com/kata/52423db9add6f6fc39000354/train/php
Given a 2D array and a number of generations, compute n timesteps of Conway's Game of Life.

The rules of the game are:

Any live cell with fewer than two live neighbours dies, as if caused by underpopulation.
Any live cell with more than three live neighbours dies, as if by overcrowding.
Any live cell with two or three live neighbours lives on to the next generation.
Any dead cell with exactly three live neighbours becomes a live cell.
Each cell's neighborhood is the 8 cells immediately around it (i.e. Moore Neighborhood). 
The universe is infinite in both the x and y dimensions and all cells are initially dead - 
except for those specified in the arguments. The return value should be a 2d array cropped around 
all of the living cells. (If there are no living cells, then return [[]].)

For illustration purposes, 0 and 1 will be represented as ░░ and ▓▓ blocks respectively (PHP, 
C: plain black and white squares). You can take advantage of the htmlize function to get a text 
representation of the universe, e.g.:

Учитывая двумерный массив и количество поколений, вычислите n временных шагов игры Конвея «Жизнь».

Правила игры таковы:

Любая живая клетка с менее чем двумя живыми соседями умирает, как будто из-за недонаселения.

Любая живая ячейка с более чем тремя живыми соседями умирает, как бы от перенаселения.

Любая живая клетка с двумя-тремя живыми соседями живет до следующего поколения.

Любая мертвая клетка, имеющая ровно три живых соседа, становится живой клеткой.

Окрестность каждой ячейки - это 8 ячеек непосредственно вокруг нее (т. Е. Окрестность Мура). 
Вселенная бесконечна как по x, так и по y, и все клетки изначально мертвы, кроме указанных в аргументах. 
Возвращаемое значение должно быть двумерным массивом, обрезанным вокруг всех живых клеток. 
(Если живых клеток нет, то вернуть [[]].)

Для наглядности 0 и 1 будут представлены в виде блоков ░░ и ▓▓ соответственно 
(PHP, C: простые черные и белые квадраты). Вы можете воспользоваться функцией htmlize, 
чтобы получить текстовое представление вселенной, например:

echo htmlize($cells) . "\r\n"; 
class ConwaysGameOfLifeUnlimitedEditionTest extends TestCase {
  public function testExample() {
    // Basic Glider Test (1 Generation)
    $this->assertSame([
      [0, 1, 0],
      [0, 0, 1],
      [1, 1, 1]
    ], get_generation([
      [1, 0, 0],
      [0, 1, 1],
      [1, 1, 0]
    ], 1));
  }
}
*/
/**
Any live cell with fewer than two live neighbours dies, as if caused by underpopulation.
Любая живая клетка с менее чем двумя живыми соседями умирает, как будто из-за недонаселения.

Any live cell with more than three live neighbours dies, as if by overcrowding.
Любая живая клетка с более чем тремя живыми соседями умирает, как бы от перенаселения.

Any live cell with two or three live neighbours lives on to the next generation.
Любая живая клетка с двумя-тремя живыми соседями живет до следующего поколения.

Any dead cell with exactly three live neighbours becomes a live cell.
Любая мертвая клетка, имеющая ровно три живых соседа, становится живой клеткой.

Окрестность каждой ячейки - это 8 ячеек непосредственно вокруг нее (т. Е. Окрестность Мура). 
*/

function _get_generation(array $cells, int $generations): array {
    if($generations < 1){
        return $cells;
    }
    $entry = 0;
    while($entry < $generations){
        print_r(array_map(function($v){
            return $v = "[".implode(",",$v)."]";
        },$cells));
        echo "==================\n";
        /*
        if($entry > 0){
            $cells = array_map(function($v){
                array_unshift($v,0);
                array_push($v,0);
                return $v;
            },$cells);
            array_unshift($cells,array_fill(0,count($cells[0]),0));
            array_push($cells,array_fill(0,count($cells[0]),0));
        }
        */
        
        echo "generations=[$entry]\n";

        $arr = array_map(function($row,$y)use($cells){
            //echo "$y => [".implode(",",$row)."]\n";
            return array_map(function($val,$x)use($y,$cells){
                $h1 = $y-1 < 0 ? 0 : $y-1;
                $w1 = $x-1 < 0 ? 0 : $x-1;
                $h2 = $y+1 > count($cells)-1 ? count($cells)-1 : $y+1;
                $w2 = $x+2 > count($cells[$y]) ? count($cells[$y]) : $x+2;
                //$row1 = $h1 == $y ? [] : array_count_values(array_splice($cells[$h1],$w1,$w2));
                $row1 = $h1 == $y ? [] : $cells[$h1];
                $row = $cells[$y];
                //$row2 = $h2 == $y ? [] : array_count_values(array_splice($cells[$h2],$w1,$w2));
                $row2 = $h2 == $y ? [] : $cells[$h2];

                $row1 = array_count_values(array_splice($row1,$w1,$w2));
                $row = array_count_values(array_splice($row,$w1,$w2));
                $row2 = array_count_values(array_splice($row2,$w1,$w2));
    /*
                $row1 = array_splice($row1,$w1,$w2);
                $row = array_splice($row,$w1,$w2);
                $row2 = array_splice($row2,$w1,$w2);

                //echo "w1;[$w1]-w2;[$w2]/h1:[$h1]-h2:[$h2] x:[$x]/y:[$y] => $val [".implode(",",$row1)."],[".implode(",",$row)."],[".implode(",",$row2)."]\n";
                
                $row1 = array_count_values($row1);
                $row = array_count_values($row);
                $row2 = array_count_values($row2);
    */
                ksort($row);
                ksort($row1);
                ksort($row2);

                $check = ["L"=>0,"D"=>0];
                
                foreach([$row,$row1,$row2] as $counter){
                    if(isset($counter[0])){
                        $check["D"]+=$counter[0];
                    }
                    if(isset($counter[1])){
                        $check["L"]+=$counter[1];
                    }
                }
                //echo "w1;[$w1]-w2;[$w2]/h1:[$h1]-h2:[$h2] x:[$x]/y:[$y] => $val [".implode(",",$row1)."],[".implode(",",$row)."],[".implode(",",$row2)."]\n";
                
                //print_r($check);
                
                switch ($val) {
                    case 1:
                        $check["L"]--;
                        if($check['L']<2){
                            //Любая живая клетка с менее чем двумя живыми соседями умирает, как будто из-за недонаселения.
                            $val = 0;
                        }else if($check['L']>3){
                            //Любая живая клетка с более чем тремя живыми соседями умирает, как бы от перенаселения.
                            $val = 0;
                        }else if( in_array($check['L'],[2,3])){
                            //Любая живая клетка с двумя-тремя живыми соседями живет до следующего поколения.
                            $val = 1;
                        }
                        break;
                    default:
                        $check["D"]--;
                        if($check['L']==3){
                            //Любая мертвая клетка, имеющая ровно три живых соседа, становится живой клеткой.
                            $val = 1;
                        }
                        break;                        
                }
                
                /*
                // simplified logic to remove unnecessary conditions
                // any cell with three neighbors is alive (past value doesn't matter)
                if($val==1){
                    $check["L"]--;
                }
                if($val==0){
                    $check["D"]--;
                }
                if ($check['L'] == 3)
                    $val = 1;
                    // any cell with fewer than two live neighbors is dead (past value doesn't matter)
                else if ($check['L'] < 2)
                    $val = 0;
                // any cell with more than three neighbors is dead (past value doesn't matter)
                else if ($check['L'] >= 4)
                    $val = 0;
                */                

                return $val;
            },$row,array_keys($row));
        },$cells,array_keys($cells));
        /*
        $arr = array_filter($arr,function($v,$k){
            return isset(array_count_values($v)[1]);
        },1);
        $arr = array_map(function($v,$k)use($arr){
            echo count($arr)."/".count($arr[$k])."[".implode(",",$v)."]\n";
            $d = abs(count($arr)-count($arr[$k]));
            if($d !== 0){
                echo "[".implode(",",$v)."]=>";
                array_splice($v,0,$d/2);
                array_splice($v,count($v)-$d/2,count($v));
                echo "[".implode(",",$v)."]\n";
            }
            return $v;
        },$arr,array_keys($arr));
        
        */
        $cells = $arr;
        print_r(array_map(function($v){
            return $v = "[".implode(",",$v)."]";
        },$cells));
        $entry++;
    }
    return $cells;
}

function nextGeneration(array $grid, int $generations): array {
    if($generations<1){
        return $grid;
    }
    $M = count($grid);
    $N = count($grid[0]);
    $future = array_fill(0,$M,array_fill(0,$N,0));
    
    $generation = 1;
    echo "generations:$generations\n";
    print_r(array_map(function($v){
        return $v = "[".implode(",",$v)."]";
    },$grid));
        while($generation <= $generations){
            echo "generation:[$generation]\n";
        print_r(array_map(function($v){
            return $v = "[".implode(",",$v)."]";
        },$grid));
        $generation++;
    
        for($l=0;$l<$M;$l++)
        {
                for($m=0;$m<$N;$m++)
                {
                    // finding no Of Neighbours that are alive
                    $aliveNeighbours = 0;
                    for($i = -1; $i < 2; $i++)
                    {
                        for($j = -1; $j < 2; $j++)
                        {
                            if (($l + $i >= 0 && $l + $i < $M) && ($m + $j >= 0 && $m + $j < $N))
                            {
                                $aliveNeighbours += $grid[$l + $i][$m + $j];
                            }
                        }
                    }
                    $aliveNeighbours -= $grid[$l][$m];
    
                    // Implementing the Rules of Life
    
                    // Cell is lonely and dies
                    if(($grid[$l][$m] == 1) && ($aliveNeighbours < 2)){
                        $future[$l][$m] = 0;
                    }
                    // Cell dies due to over population
                    else if (($grid[$l][$m] == 1) && ($aliveNeighbours > 3))
                        $future[$l][$m] = 0;
    
                    // A new cell is born
                    else if (($grid[$l][$m] == 0) && ($aliveNeighbours == 3))
                        $future[$l][$m] = 1;
    
                    // Remains the same
                    else
                        $future[$l][$m] = $grid[$l][$m];
                }
            }
            $grid = $future;
        }
        print_r(array_map(function($v){
            return $v = "[".implode(",",$v)."]";
        },$future));
        return $future;
    }

function get_generation(array $cells, int $generations=1): array {
    print_r(array_map(function($v){
        return $v = "[".implode(",",$v)."]";
    },$cells));
    if($generations==0){
        return $cells;
    }
    $generation = 1;
    while($generation <= $generations){
        
        $cells = array_map(function($v){
            array_unshift($v,0);
            array_push($v,0);
            return $v;
        },$cells);
        array_unshift($cells,array_fill(0,count($cells[0]),0));
        array_push($cells,array_fill(0,count($cells[0]),0));
        
        $future = array_map(function($row,$y)use($cells){
            return array_map(function($val,$x)use($y,$cells,$row){
                
                $row1 = isset($cells[$y-1]) ? $cells[$y-1] : [];
                $row2 = isset($cells[$y+1]) ? $cells[$y+1] : [];
    
                $x1 = $x-1 < 0 ? 0 : $x-1;
                $x2 = $x+2 > count($row) ? count($row) : $x+2;
                
                array_splice($row,$x2,count($row));
                array_splice($row,0,$x1);
                array_splice($row1,$x2,count($row1));
                array_splice($row1,0,$x1);
                array_splice($row2,$x2,count($row2));
                array_splice($row2,0,$x1);
    
                $aliveNeighbours = count(array_filter($row1,function($v){return $v==1;}))+count(array_filter($row,function($v){return $v==1;}))+count(array_filter($row2,function($v){return $v==1;}));
                if($val==1){
                    $aliveNeighbours--;
                }
                //echo "$aliveNeighbours | $y:$x | [$x1-$x-$x2] [".implode(",",$row1)."],[".implode(",",$row)."][".implode(",",$row2)."]\n";
                if($aliveNeighbours < 2){
                    return 0;
                }else if($aliveNeighbours > 3){
                    return 0;
                }else if($aliveNeighbours == 3){
                    return 1;
                }
                //echo "[".implode(",",$row)."]\n";
                return $val;
            },$row,array_keys($row));
        },$cells,array_keys($cells));
        echo "Generation: $generation\n";
        print_r(array_map(function($v){
            return $v = "[".implode(",",$v)."]";
        },$future));
        $cells=$future;
        $generation++;
    }
    $x1 = count($cells[0]);
    $x2 = 0;
    $cells = array_filter($cells,function($row,$y){
        $d = array_count_values($row)[0];
        //echo "$y: $x [".implode(",",$row)."]=>[$d]=>".count($row)."\n";
        return array_count_values($row)[0] !== count($row);
    },1);
    
    foreach($cells as $y=>$row){
        $_x1 = array_search(1,$row);
        if($_x1 < $x1){
            $x1=$_x1;
        }
        for($x=count($row)-1;$x>=0;$x--){
            if($row[$x] == 1 && $x > $x2){
                $x2=$x;
            }
            
        }
    }
    foreach($cells as $y=>$row){
        $_x1 = array_search(1,$row);
        if($_x1 < $x1){
            $x1=$_x1;
        }
        for($x=count($row)-1;$x>=0;$x--){
            if($row[$x] == 1 && $x > $x2){
                $x2=$x;
            }
            
        }
    };
    
    foreach($cells as $y=>$row){
        echo "$x1 $x2 [".implode(",",$row)."] => ";
        array_splice($row,0,$x1);
        echo "[".implode(",",$row)."] => ";
        array_splice($row,$x2,count($row));
        echo "[".implode(",",$row)."]\n";
        $cells[$y]=$row;
    }
    return $cells;
}

$cells = [
    [1,0,1,0,1,0],
    [0,1,0,1,0,1],
    [1,0,1,0,1,0],
    [0,1,0,1,0,1],
    [1,0,1,0,1,0],
    [0,1,0,1,0,1],
];

$cells = [
    [1,0,0,1,1,1,1],
    [1,0,0,1,0,0,0],
    [1,0,0,1,0,0,0],
    [1,1,1,1,1,1,1],
    [0,0,0,1,0,0,1],
    [0,0,0,1,0,0,1],
    [1,1,1,1,0,0,1],
];
$cells = [
    [1,0,1],
    [0,1,1],
    [1,1,0],
];
/*
$cells = [
    [0,0,0],
    [1,0,1],
    [0,1,1],
];
*/
$Expected = [
    [1,0,1],
    [0,1.1],
    [0,1,0],
];
$nextGeneration = get_generation([[1, 0, 1],
[0, 1, 1],
[1, 1, 0]],1);
/*
echo "cells:\n";
print_r(array_map(function($v){
    return $v = "[".implode(",",$v)."]";
},$cells));
*/
echo "Expected:\n";
print_r(array_map(function($v){
    return $v = "[".implode(",",$v)."]";
},$Expected));
echo "nextGeneration:\n";
print_r(array_map(function($v){
    return $v = "[".implode(",",$v)."]";
},$nextGeneration));

die();

$Expected=[
    [0,1,0],
    [0,0,1],
    [0,1,1]
];


$Expected = [[1,0,1],
[0,1,1],
[0,1,0]];
echo "cells:\n";
print_r(array_map(function($v){
    return $v = "[".implode(",",$v)."]";
},$cells));
echo "Last Generation:\n";
print_r(array_map(function($v){
    return $v = "[".implode(",",$v)."]";
},get_generation($cells, 4)));

echo "Expected:\n";
print_r(array_map(function($v){
    return $v = "[".implode(",",$v)."]";
},$Expected));

/*

print_r(array_map(function($v){
    return $v = "[".implode(",",$v)."]";
},get_generation([
    [0,1,0],
    [0,0,1],
    [1,1,1]], 1)));
*/