<?php
/**
 * @param $className
 * 唯一地命名你的自动加载函数，然后使用 spl_autoload_register() 函数来注册它。
 * 该函数允许定义多个 __autoload() 这样的函数，因此你不必担心其他代码的 __autoload() 函数。
 */
// 首先，定义你的自动载入的函数
function MyAutoload($className){
    include_once($className . '.php');
}

// 然后注册它。
spl_autoload_register('MyAutoload');

// Try it out!
// 因为我们没包含一个定义有 MyClass 的文件，所以自动加载器会介入并包含 MyClass.php。
// 在本例中，假定在 MyClass.php 文件中定义了 MyClass 类。
$var = new MyClass();


public static function loadClass($class)
{
    $files = array(
        $class . '.php',
        str_replace('_', '/', $class) . '.php',
    );
    foreach (explode(PATH_SEPARATOR, ini_get('include_path')) as $base_path)
    {
        foreach ($files as $file)
        {
            $path = "$base_path/$file";
            if (file_exists($path) && is_readable($path))
            {
                include_once $path;   return;

            }
        }
    }
}
?>

