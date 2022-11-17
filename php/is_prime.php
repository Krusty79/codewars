<?php
/*
Define a function that takes an integer argument and returns a logical value true or false depending on if the integer is a prime.

Per Wikipedia, a prime number ( or a prime ) is a natural number greater than 1 that has no positive divisors other than 1 and itself.

Requirements
You can assume you will be given an integer input.
You can not assume that the integer will be only positive. You may be given negative numbers as well ( or 0 ).
NOTE on performance: There are no fancy optimizations required, but still the most trivial solutions might time out. Numbers go up to 2^31 ( or similar, depending on language ). Looping all the way up to n, or n/2, will be too slow.
Example
is_prime(1)  // false
is_prime(2)  // true
is_prime(-1) // false 
https://stackoverflow.com/questions/38008130/php-check-if-number-is-prime

in 54 59 bytes:

function is_prime($n){for($i=$n;--$i&&$n%$i;);return$i==1;}
loops $i down from $n-1 until it finds a divisor of $n; $n is prime if that divisor is 1.

add 10 bytes for much better performance:

function is_prime($n){for($i=$n**.5|1;$i&&$n%$i--;);return!$i&&$n>1;}
loops $i from (approx.) sqrt($n) to 1 looking for a divisor with a post-decrement on $i.
If the divisor is 1, $i will be 0 at the end, and !$i gives true.

This solition uses a trick: For $n=2 or 3, $i will be initialized to 1 → loop exits in first iteration. For larger even square roots ($n**.5|0), |1 serves as +1. For odd square roots, +1 is not needed because: if $n is divisible by root+1, it is also divisible by 2. Unfortunately, this can cost a lot of iterations; so you better

add another 7 bytes for even better performance:

function is_prime($n){for($i=~-$n**.5|0;$i&&$n%$i--;);return!$i&$n>2|$n==2;}
$n=2 needs a special case here: inital $i=2 divides $n=2 → final $i=1 → returns false.

Adding 1 to $n instead of the square root is enough to avoid failures; but:

I did not count the iterations but only tested time consumption; and that only in TiO instead of a controlled environment. The difference between the last two versions was smaller than the deviation between several runs. Significant test results may be added later.

*/
function _is_prime($n){
    for($i=$n**.5|1;$i&&$n%$i--;);return!$i&&$n>1;
}
function is_prime(int $n): bool {
    if ($n <= 1) {
        return false;
    }
    //echo "$n**.5|1=".($n**.5|1)."\n";
    //echo "sqrt($n)=".(sqrt($n)|1)."\n";
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i === 0) {
            return false;
        }
    }

    return true;
}
array_map(function($n){
    $prime = is_prime($n) ? 'true': 'false';
    echo "$n is_prime: $prime\n";
},[-1,0,1,2,3,4,5,6,7,8,9,10,11,12]);