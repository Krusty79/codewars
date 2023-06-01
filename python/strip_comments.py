"""
https://www.codewars.com/kata/51c8e37cee245da6b40000bd/train/python


Complete the solution so that it strips all text that follows any of a set of 
comment markers passed in. Any whitespace at the end of the line should also be 
stripped out.

Example:

Given an input string of:

apples, pears # and bananas
grapes
bananas !apples
The output expected would be:

apples, pears
grapes
bananas
The code would be called like so:

result = solution("apples, pears # and bananas\ngrapes\nbananas !apples", ["#", "!"])
# result should == "apples, pears\ngrapes\nbananas"
"""


def strip_comments(strng, markers):
    # return min(list(map(lambda x:len(x),s.split()))) or len(s) # l: shortest word length
    return '"'+('\n'.join(map(lambda x: x[:x.find(markers[0])][:x.find(markers[1])]+"["+str(x.find(markers[0]))+":"+str(x.find(markers[1]))+"]", strng.split('\n')))).rstrip()+'"'


print(strip_comments('apples, pears # and bananas\ngrapes\nbananas !apples', [
      '#', '!']), 'apples, pears\ngrapes\nbananas')
# print(strip_comments('a #b\nc\nd $e f g', ['#', '$']), 'a\nc\nd')
# print(strip_comments(' a #b\nc\nd $e f g', ['#', '$']), ' a\nc\nd')
