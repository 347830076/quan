
<?php
 error_reporting(E_ALL);
header("content-type:text/html;charset=utf8");//设置编码
//date_default_timezone_set(  'Asia/Shanghai'  );
date_default_timezone_set('PRC');
$DB_HOST=$DB_NAME=$DB_USER=$DB_PWD="";

$DB_HOST="localhost";//Mysql服务器地址
$DB_NAME="test";//数据库名称
$DB_USER="root";//账号
$DB_PWD="kissyou";//密码

//$DB_HOST="124.172.155.112";

$DB_HOST="124.172.155.112";//Mysql服务器地址
$DB_NAME="quan";//数据库名称
$DB_USER="quan_f";//账号
$DB_PWD="quan_f";//密码



$conn = mysql_connect($DB_HOST,$DB_USER,$DB_PWD);
if (!$conn)

  {
  
 // echo "服务器开小差了，请直接电话联系我吧！";
  die('Could not connect: ' . mysql_error());
  }else{

    echo "链接成功";

  }


mysql_select_db($DB_NAME, $conn);




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//接收参数
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$mobile=$uname=$agent=$ip=$place=$sex=$remark="";

$mobile =mycheck(@$_GET['number']);

$mobile=$mobile.mycheck(@$_POST["number"]);


$uname=mycheck(@$_GET['name']);

$uname=$uname.mycheck(@$_POST["name"]);



$place=mycheck(@$_GET['calss']);

$place=$place.mycheck(@$_POST["calss"]);


$sex=mycheck(@$_GET['sex']);

$sex=$mobile.mycheck(@$_POST["sex"]);

$sex="不详";

$remark=mycheck(@$_GET['remark']);

$remark=$remark.mycheck(@$_POST["remark"]);


$status='未处理';

p("up is ok");



if (!function_exists('getallheaders')) {
function getallheaders() {
$headers = array();
foreach ($_SERVER as $name => $value) {
if (substr($name, 0, 5) == 'HTTP_') {
$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
}
}
return $headers;
}
}


p("up is ok");





$c=getallheaders();



$agent=$c['User-Agent'];

p($agent);

$adfrom=mycheck(@$_GET['adfrom']);

$adfrom=$adfrom.mycheck(@$_POST['adfrom']);

$ip=$_SERVER['REMOTE_ADDR'];


$optime=date('Y-m-d H:i:s', time());


















function mycheck($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



function p ($str){

  echo $str."<BR>";

}

function e(){
  die();
}


?>