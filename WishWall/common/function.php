<?php
error_reporting(0); //关闭 PHP 提示

function input($method,$name,$type='s',$default=''){ //编写INPUT函数对外部变量数据进行接受和过滤
    switch ($method) {
        case 'get':$method =$_GET; break;
        case 'post':$method =$_POST; break;
    }
    $data = isset($method[$name]) ? $method[$name] : $default;
    switch ($type) {
        case 's':
            return is_string($data) ? $data : $dafault;
            break;
        case 'd':
            return (int)$data;
        case 'a':
            return is_array($data) ? $data : [];

        default:
            # code...
            trigger_error('不存在的过滤类型"' . $type . '"');
    }
}

function format_date($time){ //把格式化日期封装成函数
    $diff = time() - $time;
    $format = [86400 => '天', 3600 => '小时', 60 => '分钟' , 1 => '秒'];
    foreach ($format as $k => $v){
        $result = floor($diff / $k);
        if ($result){
            return $result . $v;
        }
    }
    return '0.5s';
}

function page_sql($page,$size){ //获取LIMIT参数限制查询数据实现分页查询
    return ($page - 1) * $size . ',' . $size;
}

function page_html($url, $total, $page, $size){    //分页导航
    $maxpage = max(ceil($total / $size), 1);
    if($maxpage <= 1){
        return '';
    }
    if ($page == 1){
        $first = '<span>首页</span>';
        $prev = '<span>上一页</span>';
    }else{
        $first = "<a href=\"{$url}1\">首页</a>";
        $prev = '<a href="' . $url . ($page - 1) . '">上一页</a>';
    }
    if ($page == $maxpage){
        $next = '<span>下一页</span>';
        $last = '<span>尾页</span>';
    }else{
        $next = ' <a href="' . $url . ($page + 1) .'">下一页</a> ';
        $last = " <a href=\"{$url}{$maxpage}\">尾页</a> ";
    }
    return " <p>当前位于：$page/$maxpage</p>$first $prev $next $last ";
}

?>