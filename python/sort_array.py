"""
https://www.codewars.com/kata/578aa45ee9fd15ff4600090d/train/python


You will be given an array of numbers. You have to sort the odd numbers in ascending order while leaving 
the even numbers at their original positions.

Вам будет предоставлен массив чисел. 
Вы должны отсортировать нечетные числа в порядке возрастания, 
оставляя четные числа на исходных позициях.

Examples
[7, 1]  =>  [1, 7]
[5, 8, 6, 3, 4]  =>  [3, 8, 6, 5, 4]
[9, 8, 7, 6, 5, 4, 3, 2, 1, 0]  =>  [1, 8, 3, 6, 5, 4, 7, 2, 9, 0]
"""

def sort_array(source_array):
    odd = sorted(filter(lambda x:x%2,source_array))
    for i,e in enumerate(map(lambda x : x if not x % 2 else "x", source_array)):
        if e == 'x':
            source_array[i] = odd[0]
            odd.pop(0)
    return source_array

def clever_sort_array(arr):
  odds = sorted((x for x in arr if x%2 != 0), reverse=True)
  return [x if x%2==0 else odds.pop() for x in arr]

print(sort_array([5, 3, 2, 8, 1, 4]), [1, 3, 2, 8, 5, 4])
print(sort_array([5, 3, 1, 8, 0]), [1, 3, 5, 8, 0])
print(sort_array([]),[])