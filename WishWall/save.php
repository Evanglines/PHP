<?php
require './common/init.php';      //引入公共文件
require './common/function.php';
$name = input('post','name','s');
$id = input('get','id','d');
$page = input('get','page','d',1);

$name = trim(input('post', 'name', 's'));
$color = input('post', 'color', 's');
$content = trim(input('post', 'content', 's'));
$password = input('post', 'password', 's');

$name = mb_strimwidth($name, 0, 12);    //限制名称最多占用12个字符位置
$name = $name ?: '匿名';

if (!in_array($color, ['blue', 'yellow', 'red', 'green'])){
    $color = 'green';
}
$content = mb_strimwidth(0,80);
$password = (string)substr($password,0,6);
$time = time(); //保存用户的发布时间
$sql = 'INSERT INTO `wish` (`name`, `color`, `content`, `password`, `time` )
        VALUES (?, ?, ?, ?, ? )';
if(!$stmt = mysqli_prepare($link, $sql)){
    exit("SQL[$sql]预处理失败：" . mysqli_error($link));
}
mysqli_stmt_bind_param($stmt, 'sssi', `name`, `color`, `content`, `password`, `time`);
if (!mysqli_stmt_execute($stmt)){
    exit('数据库操作失败：' . mysqli_stmt_error($stmt));
}
header('Location: index.php');

$id = max (input('get', 'id', 'd'),0);
if($id){
    $sql = 'SELECT `password` FROM `wish` WHERE `id`= ' . $id;  //验证密码是否正确
    if(!$res = mysqli_query($link, $sql)){
        exit("SQL[$sql]执行失败：" . mysqli_error($link));
    }
    if(!$data = mysqli_fetch_assoc($res)){
        exit('该愿望不存在');
    }
    if($data['password']!== $password){
        exit('密码不正确');
    }

    $sql = 'UPDATE `wish` SET `name`=?, `color`=?, `content`=? WHERE `id`=?';
    if(!stmt = mysqli_prepare($link,$sql))


}


