#### 1. Start a Zookeeper server instance
```
$ docker run --name some-zookeeper --restart always -d zookeeper
```

#### 2. Connect to Zookeeper from an application in another Docker container
```
$ docker run --name some-app --link some-zookeeper:zookeeper -d application-that-uses-zookeeper
```

##### 3. Connect to Zookeeper from the Zookeeper command line client
```
$ docker run -it --rm --link some-zookeeper:zookeeper zookeeper zkCli.sh -server zookeeper
```

#### 4. Configuration
```
$ docker run --name some-zookeeper --restart always -d -v $(pwd)/zoo.cfg:/conf/zoo.cfg zookeeper
```

#### 5. Environment variables
```
$ docker run -e "ZOO_INIT_LIMIT=10" --name some-zookeeper --restart always -d 31z4/zookeeper
```
