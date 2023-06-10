<?php
error_reporting(0); //关闭 PHP 提示

require './common/init.php';      //引入公共文件
require './common/function.php';
$name = input('post','name','s');  //接收post['name']并指定为字符串，input函数接受外部数据，并进行类型过滤
$id = input('get','id','d');
$page = input('get','page','d',1);
$page = max (input('get','page','d'), 1);
$size = 4;  //每页显示的条数
$sql = 'SELECT `id`, `name`,`content`, `time`, `color` FORM `wish`
    ORDER BY `id` DESC LIMIT ' . page_sql($page, $size);

//查询所有愿望
$sql = 'SELECT `id` , `content`,`time`,`color`, `name` FROM `wish`';
if(!$res = mysqli_query($link, $sql)){
    exit("SQL[$sql]执行失败：" . mysqli_error($link));
}
$data = mysqli_fetch_all($res,MYSQLI_ASSOC);
mysqli_free_result($res);
//print_r($data);
//实现分页查询
if(empty($data) && $page > 1){  //查询结果为空时，自动返回第一页
    header('Location: index.php?page=1');   //实现重定向
    exit;
}

$sql = 'SELECT count(*) FROM `wish`';
if (!$res = mysqli_query($link, $sql)){
    exit("SQL[$sql]执行失败：" . mysqli_error($link));
    print error_log;
}
$total = (int)mysqli_fetch_row($res) [0];    //获取总记录

//修改或编辑愿望
$id = max(input('get', 'id', 'd'),0);
if (id){
    $password = input('post', 'password', 's');
    $sql = 'SELECT `name`,`content`,`color`,`password` FROM `wish`
        WHERE `id` = ' . $id;
    if(!$res = mysqli_query($link, $sql)){
        exit("SQL[$sql]执行失败：" . mysqli_error($link) . $sql);
    }
    if(!$edit = mysqli_fetch_assoc($res) ){
        exit('该愿望不存在！');
    }
    mysqli_free_result($res);   //验证密码是否正确
    $checked = isset($_POST['password']) || empty($edit['password']);
    if($checked && $password !== $edit['password'] ){
        $tips = '密码不正确'；
        $checked = false;
    }
}





mysqli_close($link); //关闭mysql查询
require './view/index.html';  //把查询数据输出到html页面

?>