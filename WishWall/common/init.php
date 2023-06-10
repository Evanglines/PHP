<?php
    $link = mysqli_connect('localhost', 'root', '1234', 'php_wish');
    if(!$link){
        exit ("数库连接失败：". mysqli_connect_error());
    }
    mysqli_set_charset($link, 'utf8');

    date_default_timezone_set('Asia/Shanghai');

    mb_internal_encoding('utf-8');  //设置mbstring扩展的内置编码
?>