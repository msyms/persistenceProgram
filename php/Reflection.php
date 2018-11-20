<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/11/20
 * Time: 9:35
 */
class FOO {
    public function test() {
        echo 'This is the method test of class FOO';
    }
}
class BAR {
    private $a, $b;
    public function __construct($a, $b) {
        $this->a = $a;
        $this->b = $b;
    }
    public function test() {
        echo 'This is the method test of class BAR<br />';
        echo '$this->a=', $this->a, ', $this->b=', $this->b;
    }
}

/**
 * 利用反射来实例化对象
 */
$class = new ReflectionClass('FOO');
$foo = $class->newInstance(); //或者是$foo = $class->newInstanceArgs();
$foo->test();

$class = new ReflectionClass('BAR');
$bar = $class->newInstanceArgs(array(55, 65));
$bar->test();

/**
 * @return object
 * @throws ReflectionException
 * 通用利用反射来实例化对象的函数
 */
function newInstance() {
    $arguments = func_get_args();//获取传递过来的参数
    $className = array_shift($arguments);
    $class = new ReflectionClass($className);
    return $class->newInstanceArgs($arguments);
}
$foo = newInstance('FOO');
$foo->test();
//输出结果：
//This is the method test of class FOO

$bar = newInstance('BAR', 3, 5);
$bar->test();
//输出结果：
//This is the method test of class BAR
//$this->a=3, $this->b=5

/**
 * Class INSTANCE
 * 使用魔术方法来实现类的实例化
 */
class INSTANCE {
    function __call($className, $arguments) {
        $class = new ReflectionClass($className);
        return $class->newInstanceArgs($arguments);
    }
}
$inst = new INSTANCE();
$foo = $inst->foo();
$foo->test();
//输出结果：
//This is the method test of class FOO

$bar = $inst->bar('arg1', 'arg2');
$bar->test();
//输出结果：
//This is the method test of class BAR
//$this->a=3, $this->b=5



