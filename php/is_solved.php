<?php
/*
If we were to set up a Tic-Tac-Toe game, 
we would want to know whether the board's current state is solved, 
wouldn't we? Our goal is to create a function that will check that for us!

Assume that the board comes in the form of a 3x3 array, where the value is 0 if a spot is empty, 
1 if it is an "X", or 2 if it is an "O", like so:

[[0, 0, 1],
 [0, 1, 2],
 [2, 1, 0]]
We want our function to return:

-1 if the board is not yet finished AND no one has won yet (there are empty spots),
1 if "X" won,
2 if "O" won,
0 if it's a cat's game (i.e. a draw).
You may assume that the board passed in is valid in the context of a game of Tic-Tac-Toe.
final class IsSolvedTest extends TestCase {
  public function testExample() {
    $this->assertSame(-1, is_solved([
      [0, 0, 1],
      [0, 1, 2],
      [2, 1, 0]
    ]));
  }
}
*/

function is_solved($board){

    /* Horizontal check */

    echo "Horizontal check\n";

    foreach([1,2] as $val){
        $vals = array_map(function($v) use($val) {
            return array_filter($v,function($v) use($val) {return $v===$val;});
        },$board);
        
        foreach($vals as $val){
            if(count($val) === count($board[0])){
                print_r($board);
                print_r($val);
                echo "return Horizontal $val[0]\n";
                return $val[0];
            }
        }
    }

    /* Vertical check */

    echo "Vertical check\n";

    $cells = [];
    $cells = array_fill(0,count($board),0);
    echo "[".implode(",",$cells)."]\n";
    for($i=0;$i<count($board);$i++){
        echo "[".implode(",",$board[$i])."]\n";
        foreach($board[$i] as $k=>$v){
            if($v==$board[0][$k] && in_array($v,[1,2])){
                $cells[$k]++;
                if($cells[$k] === count($board)){
                    echo "return Vertical $val\n";
                    return $v;
                }
            }
        }
    }
    
    /* Diagonal check */
    echo "Diagonal check";

    $diagonal = 1;
    
    $val = $board[0][0];
    for($i=0;$i<count($board)-1;$i++){
        if(!in_array($val,[1,2])){
            break;
        }
        $row = $board[$i];
        $curr_elment = $board[$i][$i];
        $next_elment = $board[$i+1][$i+1];
        if($curr_elment === $val && $curr_elment === $next_elment){
            $diagonal++;
        }else{
            $diagonal = 1;
            break;
        }
    }
    if($diagonal === count($board)){
        echo "return diagonal $val\n";
        return $val;
    }
    $diagonal = 1;
    $val = $board[0][count($board)-1];
    for($i=0;$i<count($board)-1;$i++){
        if(!in_array($val,[1,2])){
            break;
        }
        $row = $board[$i];
        $curr_elment = $board[$i][count($row)-1-$i];
        $next_elment = $board[$i+1][count($row)-2-$i];
        if($curr_elment === $val && $curr_elment === $next_elment){
            $diagonal++;
        }else{
            $diagonal = 1;
            break;
        }
    }
    if($diagonal === count($board)){
        echo "return - diagonal $val\n";
        return $val;
    }
    echo "\nreturn def -1\n";

    //0 if it's a cat's game (i.e. a draw).
    

    $draw = max(array_unique(array_map(function($v) {
        return count(array_filter($v,function($v) {return $v===0;}));
    },$board)));

    return $draw > 0 ? -1 : 0;
}

echo "\n[".is_solved([
    [2,1,2],
    [2,1,1],
    [1,2,1]
])."]\n";