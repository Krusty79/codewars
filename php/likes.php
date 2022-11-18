<?php
    /*
    https://www.codewars.com/kata/5266876b8f4bf2da9b000362/train/php
    You probably know the "like" system from Facebook and other pages. People can "like" blog posts, pictures or other items. We want to create the text that should be displayed next to such an item.

    Implement the function which takes an array containing the names of people that like an item. It must return the display text as shown in the examples:

    []                                -->  "no one likes this"
    ["Peter"]                         -->  "Peter likes this"
    ["Jacob", "Alex"]                 -->  "Jacob and Alex like this"
    ["Max", "John", "Mark"]           -->  "Max, John and Mark like this"
    ["Alex", "Jacob", "Mark", "Max"]  -->  "Alex, Jacob and 2 others like this"
    Note: For 4 or more names, the number in "and 2 others" simply increases.
    class ExampleTestCases extends TestCase {

    public function testReturnCorrectText() {

        $this->assertSame( 'no one likes this', likes( [] ) );
        $this->assertSame( 'Peter likes this', likes( [ 'Peter' ] ) );
        $this->assertSame( 'Jacob and Alex like this', likes( [ 'Jacob', 'Alex' ] ) );
        $this->assertSame( 'Max, John and Mark like this', likes( [ 'Max', 'John', 'Mark' ]) );
        $this->assertSame( 'Alex, Jacob and 2 others like this', likes( [ 'Alex', 'Jacob', 'Mark', 'Max' ] ) );
        }
    }
    */
    function likes($names): string {
        return array(
          '0' => "no one likes this",
          '1' => "{$names[0]} likes this",
          '2' => "{$names[0]} and {$names[1]} like this",
          '3' => "{$names[0]}, {$names[1]} and {$names[2]} like this",
          '4' => "{$names[0]}, {$names[1]} and ". (sizeof($names) - 2) ." others like this")[min(4, sizeof($names))];
    }
    function _likes( $names ) {

        // Your code here...
        $likes="";
        if(sizeof($names) == 1){
            $likes .= $names[0];
        }else if(sizeof($names) == 2){
            $likes .= "$names[0] and $names[1]";
        }else if(sizeof($names) === 3){
            $likes .= "$names[0], $names[1] and $names[2]";
        }else if(sizeof($names) > 3){
            $likes .= "$names[0], $names[1] and ".(sizeof($names)-2)." others";
        }
        $likes .= sizeof($names) > 1 ? " like this":" likes this";
        return sizeof($names) > 0 ? $likes : "no one likes this";
    }

    echo "no one likes this \n". likes( [] ) . "\n";
    echo "Peter likes this \n". likes( [ 'Peter' ] ) . "\n";
    echo "Jacob and Alex like this  \n". likes( [ 'Jacob', 'Alex' ] ) . "\n";
    echo "Max, John and Mark like this  \n". likes( [ 'Max', 'John', 'Mark' ]) . "\n";
    echo "Alex, Jacob and 2 others like this \n". likes( [ 'Alex', 'Jacob', 'Mark', 'Max' ] ) . "\n";