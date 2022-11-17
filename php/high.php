<?php
/*
Given a string of words, you need to find the highest scoring word.

Each letter of a word scores points according to its position in the alphabet: a = 1, b = 2, c = 3 etc.

You need to return the highest scoring word as a string.

If two words score the same, return the word that appears earliest in the original string.

All letters will be lowercase and all inputs will be valid.
*/
function high($x) {
    $x=strtolower($x);
    $alphachar = range('a', 'z');
    $high = 0;
    $selexted_word = "";
    foreach(explode(" ",$x) as $word){
        $sum=0;
        foreach(str_split($word) as $letter){
            $sum+=array_search($letter,$alphachar)+1;
        }
        if($sum > $high){
            $high = $sum;
            $selexted_word = $word;
        }
        echo "$word: $sum\n";
    }
    return $selexted_word;
}
//$this->high('taxi', high('man i need a taxi up to ubud'));
high('aa b');