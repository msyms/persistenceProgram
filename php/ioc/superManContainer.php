<?php
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
//超人类
class Superman
{
    public $power = [];//超人技能

    //超人改造 能力接口规范 遵循能力接口规范的才可以
    public function __construct(Ability $ability = null)
    {
        //设置超人每个技能名字
        if($ability != null){
            $name = strtolower(get_class($ability));
            $this->power[$name] = $ability;
        }
    }
    /**
     * @Author   shyn
     * @DateTime 2017-12-20
     * @param    [type]     $ability [能力对象]
     * [超人添加 二次添加其他能力]
     */
    public function addAbility(Ability $ability)
    {
        $name = strtolower(get_class($ability));
        $this->power[$name] = $ability;
        
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


//这里用到我们的神器：首先创建一个容器类
//工厂模式抛弃  制造一个更高级的工厂 容器(超级工厂)  
/**
 * 容器类的使用方法
 * 1.有两个属性 两个方法
 * 2.
 */
class Container
{   
    //$binds用于保存我们 不同绑定类传来的匿名函数(function(){} 并没有执行) 
    //如下面：保存为这样$binds['flight']=function(){};
    public $binds;
    public $instances;
    
    /**
     * @Author   shyn
     * @DateTime 2017-12-20
     * @param    [type]     $abstract  ['初始对象实例名 用于保存在']
     * @param    [type]     $concreate [匿名函数]
     * @return   [type]                [description]
     */
    public function bind($abstract, $concreate)
    {
        if($concreate instanceof Closure){
            $this->binds[$abstract] = $concreate;
        }else{
            $this->instances[$abstract] = $concreate;
        }
        
    }
    
    //执行绑定到$binds 中的function(){}
    public function make($abstract, $parameters = [])
    {
        if(isset($this->instances[$abstract])){
            return $this->instances[$abstract];
        }
        
        array_unshift($parameters, $this);//将this 添加到数组 $parameters 用于call_user_func_array() 这点看@@清楚
        // 将数组 $parameters 作为参数传递给回调函数$this->binds[$abstract]  $abstract 是类名
        return call_user_func_array($this->binds[$abstract], $parameters);
    }
}


// 创建一个容器 (超级工厂生成) 下面我们来把将要实例化的放进来 
// 切记放进来并没有实例化 make()方法才开始实例化到执行
// 具体make() 函数看透就明白了 这点会有点绕 冷静下来接着干 往下看
$container = new Container();

//把超人技能 Flight类 保存在容器类(Container) $binds 属性中
//其实是保存的 function($container){return new Flight()} 并没有执行 
//make 方法才是开始执行已经绑定到$binds 属性中的匿名函数【function(){}】
$container->bind('flight', function($container){
    return new Flight();
});

//同上 记住这里只是绑定 到$binds 属性中 为了 下面使用 
$container->bind('ultrabomb', function($container){
    return new UltraBomb;
});
//同上 绑定到$binds 这里的function(){} 函数并没有执行 切记【强调】
$container->bind('Force', function($container){
    return new Force;
});
// echo '<pre>';
// var_dump($container); 可以使用本句查看上面已经在 $container 中的绑定



//因为我们要使用我们的超人类(Superman)所以 也要绑定到容器
//作用：
//1.绑定到容器其实就是为了我们用容器的make()方法实例化Superman  然后使用
//2.不用我们在自己另外实例化，好处就是当我们要创造多个超人的时候 用容器来实例化多个超人就变得容易
$container->bind('superman', function($container, $ability){
    // 下面的传参数为了拥有超人的 能力 这里是重点 仔细理解
    return new Superman( $container->make($ability) );
});


//这里传入的参数superman 是根据上面 bind('super',function(){}) 方法传参定的 这里要和上面一样
//ultrabomb 对应的是 bind('ultrabomb',function(){}) 
$superman_1 =  $container->make('superman', ['ultrabomb']);
echo '<pre>';
// var_dump($superman_1);//查看技能是否绑定到了$power 
$superman_1->power['ultrabomb']->activate();//使用技能
// echo $superman_1;