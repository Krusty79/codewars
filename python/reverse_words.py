"""
Complete the function that accepts a string parameter, and reverses each word in the string. All spaces in the string should be retained.

"This is an example!" ==> "sihT si na !elpmaxe"
"double  spaces"      ==> "elbuod  secaps"
"""

def reverse_words(text):
  #go for it
  return " ".join(map(lambda x:x[::-1],text.split(" ")))

  for word in text.split():
    text = text.replace(word,word[::-1])
  return text #" ".join(map(lambda x:x[::-1],text.split()))

#reverse_words('The quick brown fox jumps over the lazy dog.'), 'ehT kciuq nworb xof spmuj revo eht yzal .god')
#test.assert_equals(reverse_words('apple'), 'elppa')
#test.assert_equals(reverse_words('a b c d'), 'a b c d')
#test.assert_equals(reverse_words('double  spaced  words'), 'elbuod  decaps  sdrow')

print(reverse_words('stressed stressed'))
print(reverse_words('double  spaced  words'))
