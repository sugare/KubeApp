
#### 启动 zookeeper cluster
```
$ COMPOSE_PROJECT_NAME=zk_test docker-compose up -d
# 注意, 我们在 "docker-compose up" 和 "docker-compose ps" 前都添加了 COMPOSE_PROJECT_NAME=zk_test 这个环境变量, 这是为我们的 compose 工程起一个名字, 以免与其他的 compose 混淆.
```

#### 使用 Docker 命令行客户端连接 ZK 集群
```
$ docker run -it --rm \
        --link zoo1:zk1 \
        --link zoo2:zk2 \
        --link zoo3:zk3 \
        --net zktest_default \
        zookeeper zkCli.sh -server zk1:2181,zk2:2181,zk3:2181
```

#### 本地连接 zookeeper
```
$ zkCli.sh -server localhost:2181,localhost:2182,localhost:2183
```


#### 查看集群状态
```
$ COMPOSE_PROJECT_NAME=zk_test docker-compose ps
Name              Command               State                     Ports                    
------------------------------------------------------------------------------------------
zoo1   /docker-entrypoint.sh zkSe ...   Up      0.0.0.0:2181->2181/tcp, 2888/tcp, 3888/tcp 
zoo2   /docker-entrypoint.sh zkSe ...   Up      0.0.0.0:2182->2181/tcp, 2888/tcp, 3888/tcp 
zoo3   /docker-entrypoint.sh zkSe ...   Up      0.0.0.0:2183->2181/tcp, 2888/tcp, 3888/tcp 

$ echo stat | nc 127.0.0.1 2181
Zookeeper version: 3.4.10-39d3a4f269333c922ed3db283be479f9deacaa0f, built on 03/23/2017 10:13 GMT
Clients:
 /172.22.0.1:36126[0](queued=0,recved=1,sent=0)

Latency min/avg/max: 0/0/0
Received: 2
Sent: 1
Connections: 1
Outstanding: 0
Zxid: 0x8
Mode: follower
Node count: 4


$ echo stat | nc 127.0.0.1 2182
Zookeeper version: 3.4.10-39d3a4f269333c922ed3db283be479f9deacaa0f, built on 03/23/2017 10:13 GMT
Clients:
 /172.22.0.1:35304[0](queued=0,recved=1,sent=0)

Latency min/avg/max: 0/0/0
Received: 2
Sent: 1
Connections: 1
Outstanding: 0
Zxid: 0x8
Mode: follower
Node count: 4


$ echo stat | nc 127.0.0.1 2183
Zookeeper version: 3.4.10-39d3a4f269333c922ed3db283be479f9deacaa0f, built on 03/23/2017 10:13 GMT
Clients:
 /172.22.0.1:36712[0](queued=0,recved=1,sent=0)

Latency min/avg/max: 0/0/0
Received: 2
Sent: 1
Connections: 1
Outstanding: 0
Zxid: 0x300000000
Mode: leader
Node count: 4
```

#### 将leader宕机
```
$ docker stop zoo3
```

#### 查看集群状态
```
$ echo stat | nc 127.0.0.1 2181
Zookeeper version: 3.4.10-39d3a4f269333c922ed3db283be479f9deacaa0f, built on 03/23/2017 10:13 GMT
Clients:
 /172.22.0.1:36216[0](queued=0,recved=1,sent=0)

Latency min/avg/max: 0/0/0
Received: 1
Sent: 0
Connections: 1
Outstanding: 0
Zxid: 0x8
Mode: follower
Node count: 4

$ echo stat | nc 127.0.0.1 2182
Zookeeper version: 3.4.10-39d3a4f269333c922ed3db283be479f9deacaa0f, built on 03/23/2017 10:13 GMT
Clients:
 /172.22.0.1:35392[0](queued=0,recved=1,sent=0)

Latency min/avg/max: 0/0/0
Received: 1
Sent: 0
Connections: 1
Outstanding: 0
Zxid: 0x400000000
Mode: leader
Node count: 4
```

#### 创建一个zookeeper服务实例
```
$ docker run --name some-zookeeper --restart always -d zookeeper
```

#### 创建一个容器用于连接 zookeeper
```
$ docker run --name some-app --link some-zookeeper:zookeeper -d application-that-uses-zookeeper
```

##### 通过 zookeeper命令行 连接 zookeeper
```
$ docker run -it --rm --link some-zookeeper:zookeeper zookeeper zkCli.sh -server zookeeper
```

#### 挂载配置文件
```
$ docker run --name some-zookeeper --restart always -d -v $(pwd)/zoo.cfg:/conf/zoo.cfg zookeeper
```

#### 环境变量
```
$ docker run -e "ZOO_INIT_LIMIT=10" --name some-zookeeper --restart always -d 31z4/zookeeper
```
