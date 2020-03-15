<?php
/**
 * 安装程序
 */
header('Content-Type: text/html; charset=utf-8');
if (!function_exists('mcrypt_encrypt')) {
    exit('PHP未开启Mcrypt扩展');
}

$pos = strpos(trim($_SERVER['SCRIPT_NAME'], '/'), '/');
if ($pos !== false && $pos > 1) {
    echo "<font color=red>CMS必须在域名根目录中安装</font>";exit;
}

define('WEBPATH', dirname(__FILE__).'/');
define('WRITEPATH', WEBPATH.'cache/');

// 判断目录权限
foreach (array(
             WRITEPATH,
             WRITEPATH.'data/',
             WRITEPATH.'templates/',
             WRITEPATH.'session/',
             WEBPATH.'config/',
             WEBPATH.'uploadfile/',
         ) as $t) {
    if (!dr_check_put_path($t)) {
        exit('目录（'.$t.'）不可写');
    }
}

if (version_compare(PHP_VERSION, '5.3.10') >= 0) {
    header('Location: /index.php?c=install');
} else {
    exit('PHP至少需要5.3.10以上版本');
}

// 检查目录权限
function dr_check_put_path($dir) {

    if (!$dir) {
        return 0;
    } elseif (!is_dir($dir)) {
        return 0;
    }

    $size = file_put_contents($dir.'test.html', 'test');
    if ($size === false) {
        return 0;
    } else {
        @unlink($dir.'test.html');
        return 1;
    }
}