<?PHP
// mysql_connect("数据库地址","数据库账号","数据库密码","连接数据库");
$con = mysqli_connect("localhost","root","123456","test");
//测试是否连接数据库
if($con)
{
    echo "连接成功";
}
else
{
    echo "连接失败".die("error to access databases");
}

//get方法部分

//[1]连接数据库
$sql="SELECT * FROM feature";
$db_selected=mysqli_select_db($con,"test");
$res=mysqli_query($con,$sql);
if(!$res)
{
    die("error to get data".mysqli_error($con));
}
else
{
    echo "success to get data";
}
//[2] get方法数据写入数据库,并且返回json给安卓
$name=$_GET["name"];
$sex=$_GET["sex"];

echo $name;
echo $sex;

$sql="INSERT INTO feature(name,sex) values ('{$name}','{$sex}')";
$res=mysqli_query($con,$sql);
$list[]=$res;
if($res)
{
    echo "insert success";

    //xml组装函数

    $sql="SELECT * FROM feature";
    $list[] =$res=mysqli_query($con,$sql);
    changeArrToXml($list);
}
else
{
    echo "insert error".die("error to insert data");
}
//关闭数据库
mysqli_close($con);

function changeArrToXml($reply = []) {

    $xmlStr = '<xml>';
    foreach($reply as $k => $v) {
        $k = trim($k);
        $v = trim($v);
        $xmlStr .= '<' . $k . '><![CDATA[' . $v . ']]></' . $k . '>';
    }
    $xmlStr .= '</xml>';
    echo $xmlStr;         //  最后用echo输出
}
?>