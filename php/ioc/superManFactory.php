<?php

//工厂类的使用
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
    public function activate(array $target = [])//参数可以忽略 保留待用
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
    public function activate(array $target = [])
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
    public function activate(array $target = [])
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

    public function activate(array $target = [])
    {
        echo '超人炸弹发射';
        return $this;
    }

    public function __toString()
    {
        return $this->skill.'伤害：'.$this->attack.' 爆炸范围：'.$this->range;
    }

}

//超人技能工厂类
class abilityFactory{

    public function makeSkill($moduleName , $optoin)
    {
        switch($moduleName){
            case 'Flight': 
                return new Flight($optoin[0], $optoin[1]);
            case 'Force':
                return new Force($optoin[0]);
            case 'Shot': 
                return new Shot($optoin[0], $optoin[1], $optoin[2]);
        }

    }
}


//超人类
class Superman
{
    public $power = [];//用来保存超人技能 超人会有多个技能所以用数组
    
    //初始化时传入传入技能类的名称
    public function __construct(array $ability)
    {
        //这里使用超人能力工厂类
        //优点：
        //1.方便对技能的管理 直接在工厂里添加我们扩展的其他超人技能
        //2.我们的超人类不用直接依赖我们的超人技能类
        //缺点：
        //1.不用直接依赖我们的超人技能类但是依赖了工厂类 
        //2.工厂类改变的话我们的超人技能必将受到影响
        //3.有没有更好的方法来 当然有把这里理解后就可以继续往下看 我们的神器：容器(可称为超级工厂)
        //4.容器是什么 不是什么 a.你可以理解一个更厉害的类 b.解决了超人类对工厂类的依赖
        $af = new abilityFactory();//实例化工厂类
        foreach ($ability as $abilityName => $abilityOptions) {
            $this->power[] = $af->makeSkill($abilityName, $abilityOptions);

        }
    }

    // 查看超人能力
    public function __toString()
    {
        if(count($this->power)<1){
            return '超人无能纳,还没任何技能';
        }
        foreach ($this->power as $key => $value) {
                echo $key.'=>'.$value.'<br/>';    
        }
        return '超人共有'.count($this->power).'个技能';
    }
}

$ability = ['Flight'=>[1,4]];//填写超人技能类名不区分大小写对应 能力工厂类中case
$superman = new Superman($ability);

echo '<pre>';
var_dump($superman);//此时可以看到超人类中power 属性已经拥有该超人技能对象
$superman->power[0]->activate([]);//使用技能 看到这里完美 activate([]) 传递了一个空数组完全可以不需要 这里为了你可以传递技能参数故意添加的 可以自己试试搞一下 有些东西得练一下才好记得才明白
