<?php
interface middleware
{
    public static function handle(Closure $next);
}

class VerifyCsrfToken implements middleware
{
    public static function handle(Closure $next)
    {
        echo '验证csrf'.PHP_EOL;
        $next();
        echo '验证csrf结束'.PHP_EOL;

    }
}

class VerifyAuth implements middleware
{
    public static function handle(Closure $next)
    {
        echo '验证登录'.PHP_EOL;
        $next();
        echo '验证登录结束'.PHP_EOL;
    }
}

class SetCookie implements middleware
{
    public static function handle(Closure $next)
    {
        echo '设置cookie'.PHP_EOL;
        $next();
        echo '设置cookie结束'.PHP_EOL;
        
    }
}

$handle  = function(){
    echo '当前执行的程序'.PHP_EOL;
};
$pipe_arr = [
    'VerifyCsrfToken',
    'VerifyAuth',
    'SetCookie',
];

$callback = array_reduce($pipe_arr,function($stack,$pipe){
    return function() use($stack,$pipe){
        return $pipe::handle($stack);
    };
},$handle);
$mycallback = my_array_reduce($pipe_arr,function($stack,$pipe){
    return function() use($stack,$pipe){
        return $pipe::handle($stack);
    };
},$handle);
var_dump($callback);
// call_user_func($callback);
// call_user_func($mycallback);
// $callback();

function my_array_reduce(array $arr, callable $fn, $initial = null)
{
    $v = $initial;
    foreach ($arr as $item) {
        $v = $fn($v, $item);
    }
    return $v;
}