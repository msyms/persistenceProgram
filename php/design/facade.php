<?php
class SubSystemOne
{
    public function methodOne()
    {
        echo "子系统方法1\n";
    }
}

class SubSystemTwo
{
    public function methodTwo()
    {
        echo "子系统方法2\n";
    }
}

class SubSystemThree
{
    public function methodThree()
    {
        echo "子系统方法3\n";
    }
}

class SubSystemFour
{
    public function methodFour()
    {
        echo "子系统方法4\n";
    }
}

class Facade
{
    private $systemOne;
    private $systemTwo;
    private $systemThree;
    private $systemFour;

    function __construct()
    {
        $this->systemOne = new SubSystemOne();
        $this->systemTwo = new SubSystemTwo();
        $this->systemThree = new SubSystemThree();
        $this->systemFour = new SubSystemFour();
    }

    public function methodA()
    {
        echo "方法A() ---\n";
        $this->systemOne->methodOne();
        $this->systemThree->methodThree();
    }

    public function methodB()
    {
        echo "方法B() ---\n";
        $this->systemTwo->methodTwo();
        $this->systemFour->methodFour();
    }
}

$facade = new Facade();
$facade->methodA();
$facade->methodB();