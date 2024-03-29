"""
https://www.codewars.com/kata/57cebe1dc6fdc20c57000ac9/train/python

Simple, given a string of words, return the length of the shortest word(s).

String will never be empty and you do not need to account for different data types.

import codewars_test as test
from solution import find_short

@test.describe("Fixed Tests")
def fixed_tests():
    @test.it('Basic Test Cases')
    def basic_test_cases():
        test.assert_equals(find_short("bitcoin take over the world maybe who knows perhaps"), 3)
        test.assert_equals(find_short("turns out random test cases are easier than writing out basic ones"), 3)
        test.assert_equals(find_short("lets talk about javascript the best language"), 3)
        test.assert_equals(find_short("i want to travel the world writing code one day"), 1)
        test.assert_equals(find_short("Lets all go on holiday somewhere very cold"), 2)   
        test.assert_equals(find_short("Let's travel abroad shall we"), 2)

"""

def find_short(s):
    return min(map(lambda x:len(x),s.split())) or len(s)

def clever_find_short(s):
    return len(min(s.split(' '), key=len))

print(find_short("turns out random test cases are easier than writing out basic ones"), 3)
print(find_short("lets talk about javascript the best language"), 3)
print(find_short("i want to travel the world writing code one day"), 1)
print(find_short("Lets all go on holiday somewhere very cold"), 2)   
print(find_short("Let's travel abroad shall we"), 2)