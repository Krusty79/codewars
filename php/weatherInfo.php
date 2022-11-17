<?php
function decode_morse(string $code): string {
  $morseDictionary = [
      '.-' => 'a',
      '-...' => 'b',
      '-.-.' => 'c',
      '....' => 'h',
      '-..' => 'd',
      '.' => 'e',
      '..-.' => 'f',
      '--.' => 'g',
      '..' => 'i',
      '.---' => 'j',
      '-.-' => 'k',
      '.-..' => 'l',
      '--' => 'm',
      '-.' => 'n',
      '---' => 'o',
      '.--.' => 'p',
      '--.-' => 'q',
      '.-.' => 'r',
      '...' => 's',
      '-' => 't',
      '..-' => 'u',
      '...-' => 'v',
      '.--' => 'w',
      '-..-' => 'x',
      '-.--' => 'y',
      '--..' => 'z',
  ];;
  $translate = [];
  foreach(preg_split("/\s/",$code) as $letter){
    $translate[] = !empty($morseDictionary[$letter]) ? $morseDictionary[$letter] : " ";
  }
  
  return strtoupper(str_replace("  "," ",implode("",$translate)));
}
