def is_isogram(string):
    return len(string) == len(set(string.lower()))


print(is_isogram("mo   Ose"), False, "same chars may not be same case")
