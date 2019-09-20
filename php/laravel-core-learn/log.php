<?php
interface log
{
    public function write();
}

class Filelog implements Log
{
    public function write()
    {
        echo 'file log write...';
    }

}

class Databaselog implements Log
{
    public function write()
    {
        echo 'database log write';
    }
}   

class User1 
{
    protected $fileLog;
    public function __construct()
    {
        $this->fileLog = new Filelog();
    }

    public function login()
    {
        echo 'login success';
        $this->fileLog->write();
    }
}

// $user = new User1();
// $user->login();

class User
{
    protected $log;
    public function __construct(log $filelog)
    {
        $this->log = $filelog;
    }

    public function login()
    {
        echo 'login';
        $this->log->write();
    }
    
}

function make($concrete)
{
    $reflector = new ReflectionClass($concrete);
    $constructor = $reflector->getConstructor();
    if(is_null($constructor)){
        return $reflector->newInstance();
    } else {
        //构造函数依赖的参数
        $dependencies = $constructor->getParameters();
        //根据参数返回实例
        $instances = getDependencies($dependencies);
        return $reflector->newInstanceArgs($instances);
    }
}

function getDependencies($paramters)
{
    $dependencies = [];
    foreach($paramters as $paramter)
    {
        var_dump($paramter->getClass()->name);
        $dependencies[] = make($paramter->getClass()->name);
    }
    return $dependencies;
}

// $user = new User1(new Databaselog());
// $user->login();

//反射
// $class = new ReflectionClass(User::class);
// $constructor = $class->getConstructor();
// $dependencies = $constructor->getParameters();

// $user = $reflector->newInstance();
// $user = $reflector->newInstanceArgs();




// $user = make('User');
// $user->login();

class Ioc
{
    public $binding = [];

    public function bind($abstract, $concrete)
    {
        //bind时不需要创建user对象，采用closure等make时候在创建
        $this->binding[$abstract]['concrete'] = function($ioc) use ($concrete) {
            // var_dump($concrete);
            return $ioc->build($concrete);
        };
    }
    public function make($abstract)
    {
        $concrete = $this->binding[$abstract]['concrete'];
        // var_dump($abstract);
        return $concrete($this);
    }

    public function build($concrete)
    {
        echo '---bulid----'.PHP_EOL;
        $reflector = new ReflectionClass($concrete);
        $constructor = $reflector->getConstructor();
        if(is_null($constructor)){
            echo '---constructor NULl---'.PHP_EOL;
            return $reflector->newInstance();
        } else {
            echo '---constructor-----'.PHP_EOL;
            var_dump($constructor);
            $dependencies = $constructor->getParameters();
            // var_dump($dependencies);
            $instances = $this->getDependencies($dependencies);
            // var_dump($instances);
            return $reflector->newInstanceArgs($instances);
        }
    }

    protected function getDependencies($paramters)
    {
        $dependencies = [];
        foreach($paramters as $paramter)
        {
            echo 'params-class-name'.PHP_EOL;
            var_dump($paramter->getClass()->name);
            $dependencies[] = $this->make($paramter->getClass()->name);
        }
        return $dependencies;
    }
}

$ioc = new Ioc();
$ioc->bind('log','FileLog');
//log为__construct中的接口,Filelog为某个具体的类
$ioc->bind('user','User');
//user为要make的类的别名，User为需要实例化的类
var_dump($ioc->binding);
$user = $ioc->make('user');
// $user->login();
