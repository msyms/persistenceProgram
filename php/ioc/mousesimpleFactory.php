<?php
/**
 * 生产鼠标的简单工厂模式，只有一个鼠标工厂，生产不同的鼠标
 */
//鼠标接口，实现鼠标sayHi方法
interface Mouse
{
    public function sayHi();
}

//戴尔鼠标
class DellMouse implements Mouse
{
    public function sayHi()
    {
        echo 'DellMouse'.PHP_EOL;
    }
}

//惠普鼠标
class HpMouse implements Mouse
{
    public function sayHi()
    {
        echo 'HpMouse'.PHP_EOL;
    }
}

//鼠标工厂 根据不同的参数生产不同的鼠标  0 戴尔鼠标  1 惠普鼠标
class MouseFactory
{
    public static function createMouse(int $i)
    {
        switch($i)
        {
            case 0:
            return new DellMouse();
            break;
            case 1:
            return new HpMouse();
            break;
            default:

        }
            
    }
}
//戴尔鼠标
$dell = MouseFactory::createMouse(0);
$dell->sayHi();
//惠普鼠标
$hp = MouseFactory::createMouse(1);
$hp->sayHi();