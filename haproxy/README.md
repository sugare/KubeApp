#### 注意事项
  1. 根据需求修改各个rc的volumeMounts
  2. 根据需求更改haproxy的配置文件


#### 执行结果
ubuntu@VM-155-68-ubuntu:~$ kubectl get rc
NAME      DESIRED   CURRENT   READY     AGE
app1      1         1         1         37m
app2      1         1         1         23m
haproxy   1         1         1         7m

ubuntu@VM-155-68-ubuntu:~$ kubectl get svc
NAME         CLUSTER-IP       EXTERNAL-IP   PORT(S)        AGE
app          10.111.224.212   <nodes>       80:30000/TCP   7m
app1         10.104.83.20     <none>        80/TCP         35m
app2         10.99.18.69      <none>        80/TCP         21m
kubernetes   10.96.0.1        <none>        443/TCP        3d

ubuntu@VM-155-68-ubuntu:~$ kubectl get pods
NAME            READY     STATUS    RESTARTS   AGE
app1-8wf44      1/1       Running   0          37m
app2-gnblr      1/1       Running   0          23m
haproxy-2fs06   1/1       Running   0          7m
