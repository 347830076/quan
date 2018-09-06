
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

mysql_query("set names utf8");

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



$c=getallheaders();



$agent=$c['User-Agent'];


$adfrom=mycheck(@$_GET['adfrom']);

$adfrom=$adfrom.mycheck(@$_POST['adfrom']);

$ip=$_SERVER['REMOTE_ADDR'];


$optime=date('Y-m-d H:i:s', time());


$place=str_replace("'","''",$place);
$uname=str_replace("'","''",$uname);
$sex=str_replace("'","''",$sex);
$mobile=str_replace("'","''",$mobile);
$agent=str_replace("'","''",$agent);
$adfrom=str_replace("'","''",$adfrom);
$remark=str_replace("'","''",$remark);






$Sql="insert into leave_word(place,uname,sex,mobile,optime,agent,adfrom,userip,status,remark) values (";
$Sql=$Sql."'".$place."',";
$Sql=$Sql."'".$uname."',";
$Sql=$Sql."'".$sex."',";
$Sql=$Sql."'".$mobile."',";
$Sql=$Sql."'".$optime."',";
$Sql=$Sql."'".$agent."',";
$Sql=$Sql."'".$adfrom."',";
$Sql=$Sql."'".$ip."',";
$Sql=$Sql."'".$status."',";
$Sql=$Sql."'".$remark."'";
$Sql=$Sql.")";

echo $Sql;






//$Sql = iconv("UTF-8", "GBK//IGNORE",$Sql);

/*


echo "<BR>";

echo $Sql;

echo "<BR>";

*/

if (!mysql_query($Sql,$conn))
  {
  //  echo("后台妹子开小差了，请直接电话联系我！");
  die('Error: ' . mysql_error());
  }

echo "报名成功，稍后会有客服人员和您联系！";

mysql_close();

$gourl="http://weixin.vmeok.com/ejamboxing/manage/1487LYB_List.asp";
$openid="ozRhitwBxWltWyjG2FhI1377D0Bw";//泽
//$openid="ozRhit9Y70tY0wDLsUrt-DCzlZU0";

$title="新留言";

$msg=$msg."场馆：".$place."|";
$msg=$msg."姓名：".$uname."|";
$msg=$msg."手机：".$mobile."|";
$msg=$msg."来路：".$adfrom."|";
$msg=$msg."时间:".$optime."|";
$msg=$msg."备注：".$remark;



sendTplSMS($openid,$title,$msg,$gourl);


/*
微信浏览器
Mozilla/5.0 (Linux; Android 8.0; MIX 2 Build/OPR1.170623.027; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.132 MQQBrowser/6.2 TBS/044109 Mobile Safari/537.36 MicroMessenger/6.6.6.1300(0x26060638) NetType/WIFI Language/zh_CN

手机浏览器桌面版
Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/61.0.3163.128 Safari/534.24 XiaoMi/MiuiBrowser/9.7.2

手机默认浏览器
Mozilla/5.0 (Linux; U; Android 8.0.0; zh-cn; MIX 2 Build/OPR1.170623.027) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/61.0.3163.128 Mobile Safari/537.36 XiaoMi/MiuiBrowser/9.7.2

手机模拟iphone
Mozilla/5.0 (iPhone; U; CPU iPhone OS 5_1_1 like Mac OS X; en-us) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B206 Safari/7534.48.3 XiaoMi/MiuiBrowser/9.7.2


电脑firefox
Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:61.0) Gecko/20100101 Firefox/61.0
 */





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


function sendTplSMS($openid,$title,$msg,$gourl){
	$url=$wxopenid=$wxtitle=$wxmsg=$wxurl="";
	$wxopenid=$openid;
	$wxtitle=UrlEncode($title);
	$wxmsg=UrlEncode($msg);
	$wxurl=$gourl;

	  //初始化
     $curl = curl_init();
     //设置抓取的url
	
	$url="http://weixin.vmeok.com/tplsms/SendSMSbyTPL.php?openid=".$wxopenid."&title=".$wxtitle."&msg=".$wxmsg."&url=".$wxurl;
	echo $url;
     curl_setopt($curl, CURLOPT_URL, $url);
     //设置头文件的信息作为数据流输出
     curl_setopt($curl, CURLOPT_HEADER, 1);
     //设置获取的信息以文件流的形式返回，而不是直接输出。
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
     //执行命令
     $data = curl_exec($curl);
     //关闭URL请求
     curl_close($curl);
     //显示获得的数据
//     print_r($data);	
	 return $data;
	 
	}




?>