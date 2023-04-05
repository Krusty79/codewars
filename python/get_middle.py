"""
https://www.codewars.com/kata/56747fd5cb988479af000028/train/python
You are going to be given a word. Your job is to return the middle character of the word. If the word's length is odd, return the middle character. If the word's length is even, return the middle 2 characters.

#Examples:

Kata.getMiddle("test") should return "es"

Kata.getMiddle("testing") should return "t"

Kata.getMiddle("middle") should return "dd"

Kata.getMiddle("A") should return "A"

"""

def get_middle(s):
    mid = len(s)/2
    if not len(s) % 2: mid -= 1
    return s[int(mid):int((len(s)/2)+1)]


def clever_get_middle(s):
    i = (len(s) - 1) // 2
    return s[i:-i] or s

print(get_middle("test"),"es")
print(get_middle("testing"),"t")
print(get_middle("middle"),"dd")
print(get_middle("A"),"A")
print(get_middle("of"),"of")