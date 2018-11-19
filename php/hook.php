<?php
/**
 * Created by PhpStorm.
 * php框架中钩子的一般实现机制
 * User: pc
 * Date: 2018/11/19
 * Time: 16:17
 */
/**
 * 在项目代码中，你认为要扩展（暂时不扩展）的地方放置一个钩子函数，等需要扩展的时候，
 * 把需要实现的类和函数挂载到这个钩子上，就可以实现扩展了。

整个插件机制包含三个部分：

1.hook插件经理类：这个是核心文件，是一个应用程序全局Global对象。它主要有三个职责

1>监听已经注册了的所有插件，并实例化这些插件对象。

2>注册所有插件。

3>当钩子条件满足时，触发对应的对象方法。

2.插件的功能实现：需要遵循我们(经理类定义)的规则，这个规则是插件机制所规定的，因插件机制的不同而不同。

3.插件的触发：也就是钩子的触发条件。这是一小段代码，放置在你需要调用插件的地方，用于触发这个钩子。
 */

//首先是插件经理类PluginManager，这个类要放在全局引用里面，在所有需要用到插件的地方，优先加载。
/**
 *
 * 插件机制的实现核心类

 */
class PluginManager
{
    /**
     * 监听已注册的插件
     *
     * @access private
     * @var array
     */
    private $_listeners = array();
    /**
     * 构造函数
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        #这里$plugin数组包含我们获取已经由用户激活的插件信息
        #为演示方便，我们假定$plugin中至少包含
        #$plugin = array(
        #    'name' => '插件名称',
        #    'directory'=>'插件安装目录'
        #);
        $plugins = get_active_plugins();#这个函数请自行实现
        if($plugins)
        {
            foreach($plugins as $plugin)
            {//假定每个插件文件夹中包含一个actions.php文件，它是插件的具体实现
                if (@file_exists(STPATH .'plugins/'.$plugin['directory'].'/actions.php'))
                {
                    include_once(STPATH .'plugins/'.$plugin['directory'].'/actions.php');
                    $class = $plugin['name'].'_actions';
                    if (class_exists($class))
                    {
                        //初始化所有插件
                        new $class($this);
                    }
                }
            }
        }
        #此处做些日志记录方面的东西
    }

    /**
     * 注册需要监听的插件方法（钩子）
     *
     * @param string $hook
     * @param object $reference
     * @param string $method
     */
    function register($hook, &$reference, $method)
    {
        //获取插件要实现的方法
        $key = get_class($reference).'->'.$method;
        //将插件的引用连同方法push进监听数组中
        $this->_listeners[$hook][$key] = array(&$reference, $method);
        #此处做些日志记录方面的东西
    }
    /**
     * 触发一个钩子
     *
     * @param string $hook 钩子的名称
     * @param mixed $data 钩子的入参
     *    @return mixed
     */
    function trigger($hook, $data='')
    {
        $result = '';
        //查看要实现的钩子，是否在监听数组之中
        if (isset($this->_listeners[$hook]) && is_array($this->_listeners[$hook]) && count($this->_listeners[$hook]) > 0)
        {
            // 循环调用开始
            foreach ($this->_listeners[$hook] as $listener)
            {
                // 取出插件对象的引用和方法
                $class =& $listener[0];
                $method = $listener[1];
                if(method_exists($class,$method))
                {
                    // 动态调用插件的方法
                    $result .= $class->$method($data);
                }
            }
        }
        #此处做些日志记录方面的东西
        return $result;
    }
}
/**
 * 接下来是一个简单插件的实现DEMO_actions。
 * 这是一个简单的Hello World插件，用于输出一句话。
 * 在实际情况中，say_hello可能包括对数据库的操作，或者是其他一些特定的逻辑。
 */
class DEMO_actions
{
    //解析函数的参数是pluginManager的引用
    function __construct(&$pluginManager)
    {
        //注册这个插件
        //第一个参数是钩子的名称
        //第二个参数是pluginManager的引用
        //第三个是插件所执行的方法
        $pluginManager->register('demo', $this, 'say_hello');
    }

    function say_hello()
    {
        echo 'Hello World';
    }
}

/**
 * 再接下来就是插件的调用触发的地方，比如我要将say_hello放到我博客首页Index.php，
 * 那么你在index.php中的某个位置写下：
$pluginManager->trigger('demo','');

第一个参数表示钩子的名字，第二个参数是插件对应方法的入口参数，由于这个例子中没有输入参数，所以为空。
 */


