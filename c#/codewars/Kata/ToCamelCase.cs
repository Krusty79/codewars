/*
Complete the method/function so that it converts dash/underscore delimited words 
into camel casing. The first word within the output should be capitalized only if 
the original word was capitalized (known as Upper Camel Case, also often referred 
to as Pascal case). The next words should be always capitalized.

Examples
"the-stealth-warrior" gets converted to "theStealthWarrior"

"The_Stealth_Warrior" gets converted to "TheStealthWarrior"

"The_Stealth-Warrior" gets converted to "TheStealthWarrior"
*/

namespace Kata
{
    public class ToCamelCase
    {
        public ToCamelCase(string str)
        {
            Console.WriteLine(String.Join("", str.Split(new Char[] { '_', '-' }).Select((word, i) => i > 0 ? word.First().ToString().ToUpper() + word.Substring(1) : word)));
        }
    }
}