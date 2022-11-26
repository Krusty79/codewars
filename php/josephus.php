<?php
/*
https://www.codewars.com/kata/5550d638a99ddb113e0000a2/train/php
Эта проблема получила свое название от, пожалуй, самого важного события в жизни античного историка.
Иосиф Флавий: согласно его рассказу, он и его 40 воинов были пойманы в ловушку в пещере
Римляне во время осады.

Отказавшись сдаться врагу, они предпочли массовое самоубийство.
с поворотом: они образовали круг и начали убивать одного человека каждые три,
пока не остался последний человек (и что он должен был убить себя, чтобы закончить действие).

Итак, Иосиф Флавий и еще один человек были последними двумя, 
и, как мы теперь знаем каждую деталь этой истории,
вы, возможно, правильно догадались, что они не совсем следовали первоначальной идее.

Теперь вам нужно создать функцию, которая возвращает перестановку Иосифа Флавия,
принимая в качестве параметров исходный массив/список элементов, 
которые нужно переставить, как если бы они были в круге
и пересчитывал каждые k мест, пока не осталось ни одного.

Советы и примечания: помогает начать считать от 1 до n,
вместо обычного диапазона 0..n-1; k всегда будет >=1.

Например, при n=7 и k=3 так должен действовать джозеф (7,3).


[1,2,3,4,5,6,7] - initial sequence
[1,2,4,5,6,7] => 3 is counted out and goes into the result [3]
[1,2,4,5,7] => 6 is counted out and goes into the result [3,6]
[1,4,5,7] => 2 is counted out and goes into the result [3,6,2]
[1,4,5] => 7 is counted out and goes into the result [3,6,2,7]
[1,4] => 5 is counted out and goes into the result [3,6,2,7,5]
[4] => 1 is counted out and goes into the result [3,6,2,7,5,1]
[] => 4 is counted out and goes into the result [3,6,2,7,5,1,4]
So our final result is:

josephus([1,2,3,4,5,6,7],3)==[3,6,2,7,5,1,4]
For more info, browse the Josephus Permutation page on wikipedia; related kata: Josephus Survivor.

Also, live game demo by OmniZoetrope.
class JosephusTest extends TestCase {
  public function testExamples() {
    $this->assertSame([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], josephus([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], 1));
    $this->assertSame([2, 4, 6, 8, 10, 3, 7, 1, 9, 5], josephus([1, 2, 3, 4, 5, 6, 7, 8, 9, 10], 2));
    $this->assertSame(['e', 's', 'W', 'o', 'C', 'd', 'r', 'a'], josephus(["C", "o", "d", "e", "W", "a", "r", "s"], 4));
    $this->assertSame([3, 6, 2, 7, 5, 1, 4], josephus([1, 2, 3, 4, 5, 6, 7], 3));
    $this->assertSame([], josephus([], 3));
  }
}
*/
function josephus(array $items, int $k): array {
  /**
  Execution Timed Out (12000 ms)
  Why did my code time out?
  Our servers are configured to only allow a certain amount of time for your code to execute. 
  In rare cases the server may be taking on too much work and simply wasn't able to run your code efficiently 
  enough. Most of the time though this issue is caused by inefficient algorithms. 
  If you see this error multiple times you should try to optimize your code further.
  **/
  $i=0;
  $index = 0;
  $arr = [];
  $len = count($items);
  do{
    if($i >= $len){
      $items = array_diff($items, $arr);
      reset($items);
      $len = count($items);
      $i=0;
    }
    $element = $i === 0 ? current($items) : next($items);
   
    $index = $index === $k ? 1:$index+1;

    if($index===$k && $element){
      $arr[] = $element;
    }
    $i++;
  } while (count($items)>0);
  return $arr;
}

echo "['e', 's', 'W', 'o', 'C', 'd', 'r', 'a']\n";
echo "[".implode(josephus(["C", "o", "d", "e", "W", "a", "r", "s"], 4),", ")."]\n";