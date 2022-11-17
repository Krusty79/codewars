<?php
/*
Given a string of words, you need to find the highest scoring word.

Each letter of a word scores points according to its position in the alphabet: a = 1, b = 2, c = 3 etc.

You need to return the highest scoring word as a string.

If two words score the same, return the word that appears earliest in the original string.

All letters will be lowercase and all inputs will be valid.
*/
function my_high($x) {
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
    }
    return $selexted_word;
}
function high($x) {
    $x=strtolower($x);
    $lengthArray = array_map(function($word){
        return array_sum(array_map(function($letter){
            return ord($letter) - 96;
        },str_split($word)));
    },explode(" ",$x));
    return explode(" ",$x)[array_keys($lengthArray, max($lengthArray))[0]];
}
//$this->high('taxi', high('man i need a taxi up to ubud'));
echo high('man i need a taxi up to ubud')."\n";
echo high('aa b')."\n";

echo my_high('man i need a taxi up to ubud')."\n";
echo my_high('aa b')."\n";