<?php
session_start();
if(isset($_SESSION['name']))
{
if(!$_SESSION['name']=='admin')
{
header("Location:login.php?id=You are not authorised to access this page unless you are administrator of this website");
}
}
else
{
header("Location:login.php?id=You are not authorised to access this page unless you are administrator of this website");
}
?>
<?php
$name=$_FILES['image']['name'];
$tmp=$_FILES['image']['tmp_name'];
$err=$_FILES['image']['error'];
if($err==0)
{
move_uploaded_file($tmp, $name);
}
$cat=$_POST['category'];
$tit=$_POST['title'];
$img=$_FILES["image"]["name"];
$cont=$_POST['description'];
?>
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

/* selecting the database "holiday" */
$dataselect = mysql_select_db("holiday",$con);
if(!$dataselect)
{
die("Database namelist not selected".mysql_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>creating article</title>
<style type="text/css">
</style>
<link href="admin_style.css" rel="stylesheet" type="text/css" />
<div class="container"> 
   <div class="page-header" >
   <img src = "Holiday_Inn_Logo.png" href="#" id = "nttlogo"/>
</head>

<body>
<div id="hold">
<div id="top">
<h2 align="center"> ADMINISTRATION PANEL</h2>
</div>

<div id="log"></div>
<div id="work_area">
<?php
$qry=mysql_query("INSERT INTO articles(title,image,description,category)VALUES('$tit','$img','$cont','$cat')", $con);
if(!$qry)
{
die("Query Failed: ". mysql_error());
}
else
{
echo "<br/>";
echo "Article Added Successfully";
echo "<br/>";
}
?>
<a href=admin_panel.php>Go back to Admin Panel</a>
</div>
</div>
</body>
</html>