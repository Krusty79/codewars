"""
https://www.codewars.com/kata/513e08acc600c94f01000001/train/python

The rgb function is incomplete. Complete it so that passing in RGB decimal values will 
result in a hexadecimal representation being returned. Valid decimal values for RGB are 0 - 255. 
Any values that fall out of that range must be rounded to the closest valid value.

Note: Your answer should always be 6 characters long, the shorthand with 3 will not work here.

The following are examples of expected output values:

rgb(255, 255, 255) # returns FFFFFF
rgb(255, 255, 300) # returns FFFFFF
rgb(0,0,0) # returns 000000
rgb(148, 0, 211) # returns 9400D3
"""

def rgb(r, g, b):
    r = r if r > 0 and r < 255 else 0 if r < 0 else 255 if r > 255 else r
    g = g if g > 0 and g < 255 else 0 if g < 0 else 255 if g > 255 else g
    b = b if b > 0 and b < 255 else 0 if b < 0 else 255 if b > 255 else b
    return '{:02x}{:02x}{:02x}'.format(r, g, b).upper()

def clever_rgb(r, g, b):
    round = lambda x: min(255, max(x, 0))
    return ("{:02X}" * 3).format(round(r), round(g), round(b))    

print(rgb(0, 0, 0), "000000", "testing zero values")
print(rgb(1, 2, 3), "010203", "testing near zero values")
print(rgb(255, 255, 255), "FFFFFF", "testing max values")
print(rgb(258, 253, 252), "FEFDFC", "testing near max values")
print(rgb(-20, 275, 125), "00FF7D", "testing out of range values")