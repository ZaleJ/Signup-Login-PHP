<?php 
    header("Content-Type: text/html; charset=utf8");
    
    if(!isset($_POST['submit'])){
        exit("错误执行");
    }//判断是否有submit操作
    include('connect.php');//链接数据库
    $name=$_POST['name'];//post获取表单里的name
    $password=$_POST['password'];//post获取表单里的password

    if(!($name && $password)){
        echo "用户名密码不能为空";
             echo "
                <script>
                        setTimeout(function(){window.location.href='signup.html';},1000);
                 </script>
            ";
    }else {
        $sql = "select * from user where username = '$name'";//检测数据库是否有对应的username和password的sql
        $resulta = mysql_query($sql);//执行sql
        $rows=mysql_num_rows($resulta);//返回一个数值
    }

    if(!$rows){
        $q="insert into user(id,username,password) values (null,'$name','$password')";//向数据库插入表单传来的值的sql
        $reslut=mysql_query($q,$con);//执行sql

        if (!$reslut ){
            die('Error: ' . mysql_error());//如果sql执行失败输出错误
        }else {
            echo "注册成功";//成功输出注册成功
            echo "
                <script>
                        setTimeout(function(){window.location.href='../index.php';},1000);
                 </script>
            ";
        }
        
    }else{
        echo "用户名已注册";
        echo "
                <script>
                        setTimeout(function(){window.location.href='signup.html';},1000);
                 </script>
            ";
    }
    
    mysql_close($con);//关闭数据库
