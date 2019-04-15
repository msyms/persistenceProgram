<?php
/**
 * 目的：代码的完善来说明从 基础类的调用到 工厂类的使用 再到容器的出现的原因
 * (首先要明白工厂类和容器的关系 可以理解：容器就是工厂类的升级版(为了解决类的依赖))
 * 如果不明白工厂类的往下看看,对比一下这几个例子,相信你就明白了。
 * 下面举个例子:
 * 简单模拟一个超人
 * 1.一个超人 具备超人的能力(就是超人技能:如飞行 射击 扔炸弹 暴力攻击等能力)
 * 2.从面向对象设计：首先分析应该分为超人类(Superman) 和超人技能类(Flight Shot UltraBomb等)
 * 3.为了规范编程写一个技能接口类(Ability) 用来规范超人技能类(同上) 当然超人也可以写一个超人接口来规范超人，这里就不写了
 * 4.看代码 先从没有涉及工厂类讲起,也就是最简单的类的直接调用 往下看
 * 5.等一下：再说一下我要实现的是使用超人来拥有超人技能,我到底怎么实现的
 * 
 */

//超能力接口   作用：规范每个超人能力类
interface Ability
{
    /**
     * @Author   shyn
     * @DateTime 2017-12-20
     * @param    array      $target [针对目标，可以使一个或多个，自己或他人]
     * @return   [type]             [description]
     * [超能力激活方法]
     */
    public function activate(array $target);
}

//飞翔能力
class Flight implements Ability
{
    protected $speed;//速度
    protected $holdtime;//飞行时间
    protected $skill = '飞翔技能=';//技能描述
    public function __construct($speed = 0, $holdtime = 0)
    {
        $this->speed = $speed;
        $this->holdtime = $holdtime;
    }
    //激活该技能
    public function activate(array $target)//参数可以忽略 保留待用
    {
        echo '超人飞行开始';
    }

    //输出该类实例(就是对象实例 如：new Flight;) 显示信息
    public function __toString()
    {
        return $this->skill.'速度：'.$this->speed.' 飞翔时间：'.$this->holdtime;
    }
}


//射击能力
class Shot{
    protected $attack;//伤害
    protected $range;//伤害范围
    protected $skill = '射击技能=';//技能解说
    public function __construct($attack = 0, $range = 0)
    {
        $this->attack = $attack;
        $this->range = $range;
    }

    //激活技能
    public function activate(array $target)
    {
        echo '超人射击开始';
    }
    public function __toString()
    {

        return $this->skill.'伤害：'.$this->attack.' 射击距离：'.$this->range;
    }
 
}

//暴击能力
class Force implements Ability
{
    protected $attack;//伤害
    protected $strength;//力量
    protected $range;//范围
    protected $skill;//技能标签
    public function __construct($attack = 0, $range = 0, $strength = 0)
    {
        $this->attack = $attack;
        $this->range = $range;
        $this->strength = $strength;
    }

    //激活暴击技能
    public function activate(array $target)
    {
        echo '超人暴力攻击';
    }

    public function __toString()
    {
        $this->skill = '暴力能力=';
        return $this->skill.'伤害：'.$this->attack.' 力量：'.$this->strength.' 范围'.$this->range;
    }
}

//终极炸弹能力(扔炸弹)
class UltraBomb implements ability
{
    protected $skill = '炸弹技能=';
    protected $range;
    protected $attack;

    public function __construct($range = 0 , $attack = 0)
    {
        $this->range = $range;
        $this->attack = $attack;

    }
    /**
     * @Author   shyn
     * @DateTime 2017-12-20
     * @param    integer    $bombRange [炸弹伤害范围]
     * @param    integer    $attack    [炸弹伤害程度]
     * @return   [type]                [description]
     * [使用炸弹]
     */
    public function throwBomb($range = 5, $attack = 10){
        
        echo '炸弹范围'.$range.'米 伤害为：'.$attack;
    }

    public function activate(array $target)
    {
        echo '超人炸弹发射';
        return $this;
    }

    public function __toString()
    {
        return $this->skill.'伤害：'.$this->attack.' 爆炸范围：'.$this->range;
    }

}


//超人类
class Superman
{
    public $power = [];//用来保存超人技能 超人会有多个技能所以用数组

    public function __construct(){
        //重点在这里！！！ 在没涉及到工厂类的时候，我们使用最简单的 超人技能类的调用类实现 超人拥有超人技能
        //优点：简单明了一看就懂
        //缺点:
        //1.当涉及多个超人技能我们就得一个一个在这里写 从维护方面来说不妥
        //2.当涉及到多个超人的时候我们还得在写一个这样的超人类 麻烦不 当然麻烦 
        //3.好，我们用工厂类来解决这个麻烦
        $this->power =array(
            'flight'=> new Flight(9, 10),//给超人添加飞行能力
            'force' => new Force(33, 19, 20)//给超人添加暴力攻击能力
        );

    }

}

$superman = new Superman();
$superman->power['flight']->activate([]);//超人开始飞行
echo'<br/>';
$superman->power['force']->activate([]);//超人开始飞行



