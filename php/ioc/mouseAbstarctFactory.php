<?php
/**
 * 抽象工厂模式，工厂不仅仅生产鼠标，还生产键盘
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
//键盘接口，实现键盘的sayhi方法
interface Keybo
{
    public function sayHi();
}

//戴尔键盘
class DellKeybo implements Keybo
{
    public function sayHi()
    {
        echo 'DellKeybo'.PHP_EOL;
    }
}
//惠普键盘
class HpKeybo implements Keybo
{
    public function sayHi()
    {
        echo 'HpKeybo'.PHP_EOL;
    }
}

/**
 * 抽象工厂，不仅生产鼠标，还生产键盘，不是工厂模式产生单一的产品
 * 当抽象工厂模式产品只有一个的时候，变成了工厂模式
 */
interface PcFactory
{
    public function createMouse();
    public function createKeybo();
}

//戴尔工厂，生产戴尔鼠标
class DellFactory implements PcFactory 
{
    public function createMouse()
    {
        return new DellMouse();
    }

    public function createKeybo()
    {
        return new DellKeybo();
    }
}

//惠普工厂，生产惠普鼠标
class HpFactory implements PcFactory
{
    public function createMouse()
    {
        return new HpMouse();
    }
    public function createKeybo()
    {
        return new HpKeybo();
    }
}

//戴尔工厂生产鼠标键盘
$dellFactory = new DellFactory();
$dellFactory->createKeybo()->sayHi();
$dellFactory->createMouse()->sayHi();
//惠普工厂生产鼠标键盘
$hpFactory = new HpFactory();
$hpFactory->createKeybo()->sayHi();
$hpFactory->createMouse()->sayHi();