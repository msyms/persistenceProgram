<?php

/**
* 	1. Composer 的自动加载在每次 URL 驱动 MFFC/public/index.php之后会在内存中维护一个全量命名空间类名到文件名的数组，这样当我们在代码中使用某个类的时候，将自动载入该类所在的文件。
	2. 我们在路由文件中载入了 Macaw 类：“use NoahBuscher\Macaw\Macaw;”，接着调用了两次静态方法 ::get()，这个方法是不存在的，将由 MFFC/vendor/codingbean/macaw/Macaw.php 中的 __callstatic() 接管。

	3. 这个函数接受两个参数，$method 和 $params，前者是具体的 function 名称，在这里就是 get，后者是这次调用传递的参数，即 Macaw::get('fuck',function(){...}) 中的两个参数。第一个参数是我们想要监听的 URL 值，第二个参数是一个 PHP 闭包，作为回调，代表 URL 匹配成功后我们想要做的事情。

	4. __callstatic() 做的事情也很简单，分别将目标URL（即 /fuck）、HTTP方法（即 GET）和回调代码压入 $routes、$methods 和 $callbacks 三个 Macaw 类的静态成员变量（数组）中。

	5. 路由文件最后一行的 Macaw::dispatch(); 方法才是真正处理当前 URL 的地方。能直接匹配到的会直接调用回调，不能直接匹配到的将利用正则进行匹配。


 *
 **/
use NoahBuscher\Macaw\Macaw;

Macaw::get('fuck', function() {
  echo "成功！";
});

Macaw::get('(:all)', function($fu) {
  echo '未匹配到路由<br>'.$fu;
});

Macaw::get('', 'HomeController@home');

Macaw::dispatch();