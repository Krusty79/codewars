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

function get_generation(array $cells, int $generations=1): array {
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
                if($aliveNeighbours < 2){
                    return 0;
                }else if($aliveNeighbours > 3){
                    return 0;
                }else if($aliveNeighbours == 3){
                    return 1;
                }
                return $val;
            },$row,array_keys($row));
        },$cells,array_keys($cells));
        $cells=$future;
        $generation++;
    }
    $x1 = count($cells[0]);
    $x2 = 0;
    $y=0;
    foreach($cells as $y=>$row){
        if(array_count_values($row)[0] === count($row)){
            echo "$y [".implode(",",$row)."]=>".count($row)."|".array_count_values($row)[0]."\n";
        }else{
            break;
        }
    }
    if($y>0){
        array_splice($cells,0,$y);
    }
    $y=0;
    foreach(array_reverse($cells) as $y=>$row){
        if(array_count_values($row)[0] === count($row)){
            echo "$y [".implode(",",$row)."]=>".count($row)."|".array_count_values($row)[0]."\n";
        }else{
            break;
        }
    }
    if($y>0){
        array_splice($cells,$y*-1);
    }
    foreach($cells as $y=>$row){
        if(array_count_values($row)[0] === count($row)){
            $y1++;
            echo "$y [".implode(",",$row)."]=>".count($row)."|".array_count_values($row)[0]."\n";
        }else{
            break;
        }
    }
    
    foreach($cells as $y=>$row){
        $_x1 = array_search(1,$row);
        if($_x1 > 0 && $_x1 < $x1){
            $x1=$_x1;
        }
        for($x=count($row)-1;$x>=0;$x--){
            if($row[$x] == 1 && $x > $x2){
                $x2=$x;
            }
        }
    }
    foreach($cells as $y=>$row){
        for($x=count($row)-1;$x>=0;$x--){
            if($row[$x] == 1 && ($x-count($row)) > $x2){
                $x2=$x;
            }   
        }
    };
    foreach($cells as $y=>$row){
        $_x2=$x2;
        array_splice($row,0,$x1);
        $_x2=$x2-$x1-count($row)+1;
        array_splice($row,$_x2);
        $cells[$y]=$row;
    }
    return array_values($cells);
}
/*
$cells = [
    [1, 0, 1, 0, 1],
    [0, 1, 1, 0, 1],
    [1, 1, 0, 0, 0]
];
*/
$cells = [
    [1,1,1,0,0,0,1,0],
    [1,0,0,0,0,0,0,1],
    [0,1,0,0,0,1,1,1],
];


$Expected=[
    [1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1],
];


echo "cells:\n";
print_r(array_map(function($v){
    return $v = "[".implode(",",$v)."]";
},$cells));
echo "Last Generation:\n";
print_r(array_map(function($v){
    return $v = "[".implode(",",$v)."]";
},get_generation($cells, 16)));

echo "Expected:\n";
print_r(array_map(function($v){
    return $v = "[".implode(",",$v)."]";
},$Expected));
