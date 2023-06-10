<?php
    date_default_timezone_set('Asia/Shanghai'); // 在项目中设置时区，以适应各种服务器环境
    mb_internal_encoding('utf-8');  //设置mbstring扩展的内置编码

    $link = mysqli_connect('localhost', 'root', '1234', 'php_wish');    // 连接数据库
    if(!$link){
        exit ("数库连接失败：". mysqli_connect_error());
    }
    mysqli_set_charset($link, 'utf8');

