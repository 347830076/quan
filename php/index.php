
<?php
header("content-type:text/html;charset=utf-8");//设置编码
$servername = "124.172.155.112";
$username = "quan_f";
$password = "quan_f";
 
// 创建连接
$conn = new mysqli($servername, $username, $password);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
echo "连接成功";
?>
