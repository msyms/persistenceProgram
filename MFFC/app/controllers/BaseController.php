<?php
namespace App\Controllers;
/**
* BaseController
*/
class BaseController extends \Pimple\Container
{
　　 //服务提供中，所有提供者都在这里填写，demo中只涉及到了UserService，当然还有Route啥的。
    protected $providers = [
        UserServiceProvider::class
    ];

    public function __construct()
    {
        parent::__construct();

　　　　 //构造函数中调用注册提供者方法。
        $this->registerProviders();
    }

    public function addProvider($provider){
        array_push($this->providers,$provider);

        return $this;
    }

    public function setProviders($providers){
        $this->providers = [];

        foreach ($providers as  $provider){
            $this->addProvider($provider);
        }
    }

    public function getProviders(){
        return $this->providers;
    }

    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    public function __set($id, $value)
    {
        $this->offsetSet($id,$value);
    }

　　//循环迭代之前的服务提供者，在Container的register方法中注册提供者实例，注意，这里只是提供者实例，而不是User。
    private function registerProviders(){

        foreach ($this->providers as $provider){
            $this->register(new $provider());
        }
    }
}