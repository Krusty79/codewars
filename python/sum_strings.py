"""
https://www.codewars.com/kata/5324945e2ece5e1f32000370/train/python
"""


def sum_strings(a, b):
    a = a[::-1]
    b = b[::-1]
    intdiv = 0
    num = ""
    for i in range(max(len(a), len(b))):

        _a = int(a[i]) if i < len(a) else 0
        _b = int(b[i]) if i < len(b) else 0

        res = _a+_b+intdiv
        intdiv = (res // 10)

        if res > 9:
            res = str(res)[1]

        num += str(res)

        print(i, _a, '+', _b, '=', res, intdiv, num)

    return (str(intdiv)+num[::-1]).lstrip("0") or "0"


print(sum_strings('0', '0'))
