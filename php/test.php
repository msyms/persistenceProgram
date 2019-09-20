<?php
function add(&$a,&$b)
{
    $a +=1;
    $b +=1;
    return $a + $b;
}
$a = 1;
$res = add($a,$a);
var_dump($res,$a);
class a
{
    private static $a = 1;
    public function __construct()
    {
        $this->a += 1;
    }

    public function __call($name, $arguments)
    {
        return ++$this->a;
    }
}
class b extends a 
{
    public function methodA()
    {
        return $this->a;
    }
}

$res1 = (new b())->methodA();
$res2 = (new b())->methodB();
var_dump($res1,$res2);

$arr = ['a'=>1,'b'=>2,'c'=>3];
$arr2 = [];
foreach($arr as $vo)
{
    $arr2[] = $vo;
}
var_dump($arr2);    

$num = 18;
$fun = function($a)  {
    return $a + $num;
};
$res = $fun(10);
var_dump($res);

echo (intval((0.7 + 0.1) * 100 /10));
