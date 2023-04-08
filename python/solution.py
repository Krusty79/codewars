"""
https://www.codewars.com/kata/51b6249c4612257ac0000005/train/python


Create a function that takes a Roman numeral as its argument and returns its value as a numeric 
decimal integer. You don't need to validate the form of the Roman numeral.

Modern Roman numerals are written by expressing each decimal digit of the number to be encoded separately, 
starting with the leftmost digit and skipping any 0s. 
So 1990 is rendered "MCMXC" (1000 = M, 900 = CM, 90 = XC) and 2008 is rendered "MMVIII" 
(2000 = MM, 8 = VIII). The Roman numeral for 1666, "MDCLXVI", uses each letter in descending order.

Example:

solution('XXI') # should return 21
Help:

Symbol    Value
I          1
V          5
X          10
L          50
C          100
D          500
M          1,000
Courtesy of rosettacode.org
"""

def solution(roman):
    dd = {"I":1,"V":5,"X":10,"L":50,"C":100,"D":500,"M":1000 }
    return sum(int(dd[str(x)]) if dd[str(x)] >= dd[roman[i+1 if i < len(roman)-1 else i]] else int(dd[str(x)])*-1 for i,x in enumerate(roman))

def clever_solution(roman): 
    inter=[ {'I':1,'V':5,'X':10,'L':50,'C':100,'D':500,'M':1000 }[i] for i in roman ]+[0]       
    return sum( [-inter[i] if inter[i]<inter[i+1] else inter[i] for i in range(len(inter)-1) ])


print(solution('DCCXCIV'), 794)
#print(solution('XIX'), 19, 'should == 19: 21 should equal 19')
#print(solution('I'), 1, 'I should == 1')
#print(solution('XXI'), 21, 'XXI should == 21')
#print(solution('VI'), 6, 'VI should == 6')
#print(solution('IV'), 4, 'IV should == 4')
#print(solution('MMVIII'), 2008, 'MMVIII should == 2008')
#print(solution('MDCLXVI'), 1666, 'MDCLXVI should == 1666')