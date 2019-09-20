<?php

class Point 
{
    public $x;
    public $y;

    public function __construct($x = 0, $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }
}

class Circle
{
    /**
     * @var int
     */
    public $radius; //半径
    /**
     * @var Point
     */
    public $center;//圆心点

    CONST PI = 3.14;

    public function __construct(Point $point, $radius = 1)
    {
        $this->center = $point;
        $this->radius = $radius;
    }

    //打印圆点坐标
    public function printCenter()
    {
        printf('center coordinate is (%d, %d)',$this->center->x,$this->center->y);
    }
    //计算圆形面积
    public function area()
    {
        return 3.14 * pow($this->radius, 2);
    }
}

$reflectionClass = new ReflectionClass(Circle::class);
/**
 * 返回值如下
object(ReflectionClass)#1 (1) {
    ["name"]=>
    string(6) "Circle"
}
 */
$reflectionClass->getConstants();
/**
 * 反射出类的常量
array(1) {
  ["PI"]=>
  float(3.14)
}
 */
$reflectionClass->getProperties();
/**
 * 
 * 返回一个由ReflectionProperty对象构成的数组
array(2) {
  [0]=>
  object(ReflectionProperty)#2 (2) {
    ["name"]=>
    string(6) "radius"
    ["class"]=>
    string(6) "Circle"
  }
  [1]=>
  object(ReflectionProperty)#3 (2) {
    ["name"]=>
    string(6) "center"
    ["class"]=>
    string(6) "Circle"
  }
}
 */
$reflectionClass->getMethods();
/**
 * 反射出类中定义的方法
 * 返回ReflectionMethod对象构成的数组

array(3) {
  [0]=>
  object(ReflectionMethod)#2 (2) {
    ["name"]=>
    string(11) "__construct"
    ["class"]=>
    string(6) "Circle"
  }
  [1]=>
  object(ReflectionMethod)#3 (2) {
    ["name"]=>
    string(11) "printCenter"
    ["class"]=>
    string(6) "Circle"
  }
  [2]=>
  object(ReflectionMethod)#4 (2) {
    ["name"]=>
    string(4) "area"
    ["class"]=>
    string(6) "Circle"
  }
}
 */
$constructor = $reflectionClass->getConstructor();
/**
 * 我们还可以通过getConstructor()来单独获取类的构造方法，其返回值为一个ReflectionMethod对象。
 * 
 */
$parameters = $constructor->getParameters();
/**
 * 其返回值为ReflectionParameter对象构成的数组。

array(2) {
  [0]=>
  object(ReflectionParameter)#3 (1) {
    ["name"]=>
    string(5) "point"
  }
  [1]=>
  object(ReflectionParameter)#4 (1) {
    ["name"]=>
    string(6) "radius"
  }
}
 */
//构建类的对象
function make($className)
{
    $reflectionClass = new ReflectionClass($className);
    $constructor = $reflectionClass->getConstructor();
    $parameters  = $constructor->getParameters();
    $dependencies = getDependencies($parameters);
    
    return $reflectionClass->newInstanceArgs($dependencies);
}

//依赖解析
function getDependencies($parameters)
{
    $dependencies = [];
    foreach($parameters as $parameter) {
        $dependency = $parameter->getClass();
        if (is_null($dependency)) {
            if($parameter->isDefaultValueAvailable()) {
                $dependencies[] = $parameter->getDefaultValue();
            } else {
                //不是可选参数的为了简单直接赋值为字符串0
                //针对构造方法的必须参数这个情况
                //laravel是通过service provider注册closure到IocContainer,
                //在closure里可以通过return new Class($param1, $param2)来返回类的实例
                //然后在make时回调这个closure即可解析出对象
                //具体细节我会在另一篇文章里面描述
                $dependencies[] = '0';
            }
        } else {
            //递归解析出依赖类的对象
            $dependencies[] = make($parameter->getClass()->name);
        }
    }

    return $dependencies;
}

$circle = make('Circle');
$circle->printCenter();
$area = $circle->area();
var_dump($circle,$area);

/*var_dump($circle, $area);
object(Circle)#6 (2) {
  ["radius"]=>
  int(1)
  ["center"]=>
  object(Point)#11 (2) {
    ["x"]=>
    int(0)
    ["y"]=>
    int(0)
  }
}
float(3.14)*/