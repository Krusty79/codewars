<?php

function groupByOwners(array $files) : array
{
    print_r(array_flip($files));

    $output = [];
    foreach($files as $k=>$v){
        $output[$v][] = $k;
    }
    return $output;

}
$files = array(
    "Input.txt" => "Randy",
    "Code.py" => "Stan",
    "Output.txt" => "Randy"
);

//print_r(groupByOwners($files));


class TextInput
{
    var $n = '';
    function add($x){
        $this->n .= $x;
    }
    function getValue(){
        return strval($this->n);
    }
}

class NumericInput extends TextInput
{
    function add($x){
        $this->n .= is_numeric($x) ?  $x : '';
    }
}

$input = new NumericInput();
$input->add('1');
$input->add('a');
$input->add('0');
echo $input->getValue();