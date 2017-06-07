#### 启动顺序
  1. mysql
  2. php
  3. nginx

#### 注意：
  1. 根据需求修改各个rc的volumeMounts
  2. nginx的80端口映射在本机的30001
 

#### 执行结果
```
ubuntu@VM-155-68-ubuntu:~$ kubectl get rc
NAME      DESIRED   CURRENT   READY     AGE
mysql     1         1         1         3m
nginx     1         1         1         2m
php       1         1         1         3m

ubuntu@VM-155-68-ubuntu:~$ kubectl get svc
NAME         CLUSTER-IP       EXTERNAL-IP   PORT(S)        AGE
kubernetes   10.96.0.1        <none>        443/TCP        2d
mysql        10.107.186.62    <none>        3306/TCP       3m
nginx        10.106.73.191    <nodes>       80:30001/TCP   3m
php          10.106.205.180   <none>        9000/TCP       3m

ubuntu@VM-155-68-ubuntu:~$ kubectl get pods
NAME          READY     STATUS    RESTARTS   AGE
mysql-grwcc   1/1       Running   0          3m
nginx-86ts3   1/1       Running   0          3m
php-rvv3b     1/1       Running   0          3m
```
