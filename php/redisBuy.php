<?php
/*
 * 抢购时入redis队列，高并发时会导致用户超过库存
 */
$num = 10;   //系统库存量
$user_id =  \Session::get('user_id');//当前抢购用户id
$len = \Redis::llen('order:1');  //检查库存，order:1 定义为健名
if($len >= $num)
    return '已经抢光了';

$result = \Redis::lpush('order:1',$user_id);  //把抢到的用户存入到列表中
if($result)
    return '恭喜您!抢到了哦';

/**
 * 高并发时为了防止超卖，先将产品数量存入列表中，然后有人买的话从列表中pop出一个商品
 */
$num=10; //库存
$len=\Redis::llen('goods_store:1'); //检查库存,goods_store:1 定义为健名
$count = $num-$len; //实际库存-被抢购的库存 = 剩余可用库存
for($i=0;$i<$count;$i++)
     \Redis::lpush('goods_store:1',1);//往goods_store列表中,未抢购之前这里应该是默认滴push10个库存数了

 //echo \Redis::llen('goods_store:1');//未抢购之前这里就是10了

/* 模拟抢购操作,抢购前判断redis队列库存量 */
$count=\Redis::lpop('goods_store:1');//lpop是移除并返回列表的第一个元素。
if(!$count)
    return '已经抢光了哦';
/* 下面处理抢购成功流程 */
\DB::table('goods')->decrement('num', 1);//减少num库存字段

/**
 * 优化抢购逻辑，成功抢购的人才与数据库交互
 */
$user_id =  \Session::get('user_id');//当前抢购用户id
/* 模拟抢购操作,抢购前判断redis队列库存量 */
$count=\Redis::lpop('goods_store:1');
if(!$count)
     return '已经抢光了哦';

$result = \Redis::lpush('order:1',$user_id);
if($result)
     return '恭喜您!抢到了哦';

/**
 * 上面的会导致一个用户抢多个
 * 需要一个排队队列(比如：queue:1,以user_id为值的列表)
 * 和抢购结果队列(比如：order:1,以user_id为值的列表)
 * 及库存队列(比如上面的goods_store:1)。
 * 高并发情况，先将用户进入排队队列，
 * 用一个线程循环处理从排队队列取出一个用户，
 * 判断用户是否已在抢购结果队列，如果在则已抢购，否则未抢购，
 * 接着执行库存减1，写入数据库，将此user_id用户同时也进入结果队列。
 */