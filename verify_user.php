<?php
/*
connecting to mysql database
hostname : localhost
username : root
password : 123456
*/
$con = mysql_connect("localhost","root","");
if(!$con)
{
die("connection to database failed".mysql_error());
}

/* selecting the database "cms" */
$dataselect = mysql_select_db("holiday",$con);
if(!$dataselect)
{
die("Database namelist not selected".mysql_error());
}
?>

<?php
$uname=$_POST['u_name'];
$pass=$_POST['pass'];

$qry=mysql_query("SELECT * FROM login WHERE user='$uname'", $con);
if(!$qry)
{
die("Query Failed: ". mysql_error());
}
else
{
$row=mysql_fetch_array($qry);
//echo $row["user"]." ".$row["password"]."<br/>";

if($_POST['u_name']==$row["user"]&&$_POST['pass']==$row["password"])
{
session_start();
$_SESSION['name']=$_POST['u_name'];
$uname=$_POST['u_name'];
header("Location:admin_panel.php");
}
else
{
header("Location:login.php?id=username or password you entered is incorrect");
}
}

?>