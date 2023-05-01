"""
https://www.codewars.com/kata/5279f6fe5ab7f447890006a7/train/python
in this kata, you will write a function that returns the positions and the 
values of the "peaks" (or local maxima) of a numeric array.

3,2,3,6,4,1,2,3,2,1,2,3


For example, the array arr = [0, 1, 2, 5, 1, 0] has a peak at position 3 
with a value of 5 (since arr[3] equals 5).

The output will be returned as an object with two properties: pos and peaks. 
Both of these properties should be arrays. If there is no peak in the given array, 
then the output should be {pos: [], peaks: []}.

Example: pickPeaks([3, 2, 3, 6, 4, 1, 2, 3, 2, 1, 2, 3]) should 
return {pos: [3, 7], peaks: [6, 3]} (or equivalent in other languages)

All input arrays will be valid integer arrays (although it could still be empty),
so you won't need to validate the input.

The first and last elements of the array will not be considered as peaks 
(in the context of a mathematical function, we don't know what is after 
and before and therefore, we don't know if it is a peak or not).

Also, beware of plateaus !!! [1, 2, 2, 2, 1] has a peak while [1, 2, 2, 2, 3] 
and [1, 2, 2, 2, 2] do not. In case of a plateau-peak, 
please only return the position and value of the beginning of the plateau. 
For example: pickPeaks([1, 2, 2, 2, 1]) returns {pos: [1], peaks: [2]} 
(or equivalent in other languages)

Have fun!
"""


def clever_pick_peaks(arr):
    pos_delta = [pd for pd in enumerate((b - a for a, b in zip(arr, arr[1:])), 1) if pd[1]]
    positions = [a[0] for a, b in zip(pos_delta, pos_delta[1:]) if a[1] > 0 and b[1] < 0]
    return {'pos': positions, 'peaks': [arr[p] for p in positions]}

def pick_peaks(arr):
    index = [i for i in range(0,len(arr)) if i == 0 or arr[i-1] != arr[i]]
    pos   = [index[i] for i in range(1,len(index)-1) if arr[index[i]] > arr[index[i-1]] and arr[index[i]] > arr[index[i+1]] ]
    return {'pos': pos, 'peaks': [arr[i] for i in pos]}

def _pick_peaks(arr):
    peaks = [[i+1,arr[i:3+i][1],arr[i:3+i]] for i in range(1,len(arr)) if len(arr[i:3+i]) == 3 and arr[i:3+i][1] == max(arr[i:3+i]) and arr[i:3+i][1] > arr[i:3+i][0] and arr[i:3+i][1] >= arr[i:3+i][2] and arr[i:3+i][1] > min(arr[i+3::]) ]
    return {"pos": list(map(lambda x:x[0],peaks)), "peaks": list(map(lambda x:x[1],peaks))}

print(pick_peaks([3,2,3,6,4,1,2,3,2,1,2,3]), {"pos":[3,7], "peaks":[6,3]})
print(pick_peaks([2,1,3,1,2,2,2,2]), {"pos":[2], "peaks":[3]})
print(pick_peaks([1,2,5,4,3,2,3,6,4,1,2,3,3,4,5,3,2,1,2,3,5,5,4,3]), {"pos":[2,7,14,20], "peaks":[5,6,5,5]})