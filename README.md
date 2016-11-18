
# zhttp-根据zphp改造专门用来做http web服务的轻量级框架
(当前只用来做app接口用)

### 开发交流群:138897359

## 注意事项

	1.框架最新加入协程+mysql连接池，非阻塞的mysql查询大大提高了框架应对请求的吞吐量,并且基于swoole，性能极其强悍
	2.php版本需要7.0+
	3.swoole版本1.8.*
	4.如果用到异步redis，需要安装hiredis，安装教程:http://wiki.swoole.com/wiki/page/p-redis.html
	5.由于本框架是异步的,同一时间内,一个work进程内会有多个请求在处理,所以请不要使用单例模式设置和获取各种变量

##运行demo

	本框架只支持http模式：
	运行：
	cd 到根目录
	php webroot/main.php start|stop|restart|reload
	访问IP:PORT
	建议：
		如果是静态文件如css、js、image，可以直接用nginx代理
		如果是动态请求，最好使用nginx做代理转发

## 



###目录结构

![目录结构](https://raw.githubusercontent.com/keaixiaou/base/master/zhttpdir.jpeg)



##apps -  mvc框架的controllers和service

####			service 通常的调用服务层
####	config - 配置文件
####	library - 对应的全局函数,每个work进程启动的时候会加载这个方法

​		
##
## 路由

​	根据pathinfo访问对应得controller，如ip:port/home/index/index则会访问home目录下的IndexController的index方法；如果不指定pathinfo则访问home目录下的IndexController的index方法


##session，cookie等
	1.异步框架已经默认支持session、cookie，只需要对$_SESSION,$_COOKIE变量写入或者读取即可（请不要使用setcookie，session_start等函数），无需关注底层异步处理
	2.$_POST, $_GET, $_FILES,$_SERVER等变量都已经支持使用，写法和传统php-fpm一致。
	
## 

###Cache-redis(已经是异步非阻塞)

只要在config目录下配置cache文件，即可在业务里调用缓存方法,如：
配置:

```
return [
    'redis'=>[
        'ip' => 'localhost',
        'port' => 6379,
        'select' => 0,
        'password' => '',
        'asyn_max_count' => 10,
    ]
];
```

使用:

```
$data = yield Db::redis()->cache('abcd');
```

##

##数据库



##mysql(已经是异步非阻塞)

在config下配置mysql的配置文件，即可在业务中使用,你可以使用以下方法查询数据


```
配置database：
return [
    'database'=>[
        'master' => [
            'host' => '120.27.143.217',
            'user' => 'jeekzx',
            'password' => '7f331f',
            'database' => 'jeekzx',
            'asyn_max_count' => 4,
        ],
    ]

];

比如是一张test表，里面有字段:id，content
$data = yield Db::table()->query('select* from test');
query方法查询出来的结果:
{
    "client_id": 1,
    "result": [
        {
            "id": "1",
            "content": "222333"
        }
    ],
    "affected_rows": 0,
    "insert_id": 0
}

如果query执行失败则里面的result为false

$userinfo = yield table('test')->where(['id'=>1])->find();
find 方法查询出来的结果：
 {
    "id": "1",
    "content": "222333"
}

$userinfo = yield table('test')->where(['id'=>1])->get();
get 方法查询出来的结果:
[
    {
        "id": "1",
        "content": "222333"
    }
]

$insertId = yield Db::table('test')->add(['content'=>'333']);
add 方法得到的结果是：2（主键ID)


$res = yield Db::table('test')->save(['content'=>'333']);
save方法得到的结果是:0（修改的行数）

以上add,get,find,save 如果执行失败则返回false

```

###http client（已经是异步非阻塞）

```
$httpClient = new HttpClientCoroutine();
$data = yield $httpClient->request('http://speak.test.com/');
```

###框架全部封装好.怎么样，这异步用起来是不是很简单^_^


###mongo(还是同步阻塞的)
在config下配置mongo的配置文件，即可在业务中使用，如下

```
$data = Db::collection('stu_quest_score')->findOne(['iStuId'=>26753]);
```





##ab测试-本机结合redis输出

![本机裸跑输出](https://raw.githubusercontent.com/keaixiaou/base/master/zhttpredis.png)

##ab测试-本机(mac air)查询mysql，4个work进程，每个work10个链接mysql连接池
![本机查询mysql](https://raw.githubusercontent.com/keaixiaou/base/master/mysql.png)






