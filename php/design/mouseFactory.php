<?php
/**
 * 生产鼠标的工厂模式
 * 有不同的鼠标工厂，不同的鼠标工厂生产不同的鼠标
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
//工厂接口，产生不同的工厂，每个工厂生产不同的鼠标
//生产鼠标不再有参数决定，而是创建不同的鼠标工厂
interface MouseFactory
{
    public function createMouse();
}

//戴尔工厂，生产戴尔鼠标
class DellFactory implements MouseFactory 
{
    public function createMouse()
    {
        return new DellMouse();
    }
}

//惠普工厂，生产惠普鼠标
class HpFactory implements MouseFactory
{
    public function createMouse()
    {
        return new HpMouse();
    }
}
//戴尔工厂生产戴尔鼠标
$dellFactory = new DellFactory();
$dellFactory->createMouse()->sayHi();
//惠普工厂生产惠普鼠标
$hpFactory = new HpFactory();
$hpFactory->createMouse()->sayHi();
