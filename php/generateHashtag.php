<?php
/*
https://www.codewars.com/kata/52449b062fb80683ec000024/train/php
The marketing team is spending way too much time typing in hashtags.
Let's help them with our own Hashtag Generator!

Here's the deal:

It must start with a hashtag (#).
All words must have their first letter capitalized.
If the final result is longer than 140 chars it must return false.
If the input or the result is an empty string it must return false.
Examples
" Hello there thanks for trying my Kata"  =>  "#HelloThereThanksForTryingMyKata"
"    Hello     World   "                  =>  "#HelloWorld"
""                                        =>  false

class MyTest extends TestCase
{
    public function testThatSomethingShouldHappen() {
      $this->assertSame(false, generateHashtag(''), 'Expected an empty string to return false');
      $this->assertSame(false, generateHashtag(str_repeat(' ', 200)), "Still an empty string");
      $this->assertSame('#Codewars', generateHashtag('Codewars'), 'Should handle a single word and add a hashtag at the beginning.');
      $this->assertSame('#Codewars', generateHashtag('Codewars      '), 'Should handle trailing whitespace.');
      $this->assertSame('#CodewarsIsNice', generateHashtag('Codewars Is Nice'), 'Should remove spaces.');
      $this->assertSame('#CodewarsIsNice', generateHashtag('codewars is nice'), 'Should capitalize first letters of words.');
      $this->assertSame('#CodeWars', generateHashtag('Code' . str_repeat(' ', 140) . 'wars'));
      $this->assertSame(false, generateHashtag('Looooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooong Cat'), 'Should return false if the final word is longer than 140 chars.');
      $this->assertSame("#A" . str_repeat("a", 138), generateHashtag(str_repeat("a", 139)), "Should work");
      $this->assertSame(false, generateHashtag(str_repeat("a", 140)), "Too long");
    }
}

*/

function generateHashtag($str) {
    $str = str_replace(" ","",ucwords(trim($str)));
    return strlen($str)<1 || strlen($str)>=140 ? false : "#$str";
}

echo '#CodewarsIsNice => ['. generateHashtag('codewars is nice      ')."]\n";