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
/*
connecting to mysql database
hostname : localhost
username : root
password :
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
<title>Untitled Document</title>
<style type="text/css">
</style>
<link href="admin_style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="hold">
<div id="top">
<h2 align="center">CONTENT MANAGEMENT SYSTEM ADMINISTRATION PANEL</h2>
</div>
<div id="log"></div>
<div id="work_area">
<?php
if(isset($_GET['id']))
{
$id=$_GET['id'];
$qry=mysql_query("SELECT * FROM food WHERE id=$id", $con);
if(!$qry)
{
die("Query Failed: ". mysql_error());
}

                /* Fetching data from the field "title" */
$row=mysql_fetch_array($qry);

echo $row['id'];
echo $row['category'];
echo $row['title'];
echo $row['image'];
echo $row['descriptiom'];
/*echo $row['price'];*/

}

?>
<form action="article_edited.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
<p>Article Id &nbsp;&nbsp;:
<input type="text" name="id" id="idd" value="<?php echo $row['id']; ?>" />
</p>
<p>Category &nbsp;&nbsp;:
<label for="cat"></label>
<input type="text" name="category" id="category" value="<?php echo $row['category']; ?>" />
</p>
<p>Title &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
<label for="tit"></label>
<input type="text" name="title" id="title" value="<?php echo $row['title']; ?>" />
</p>
<p>Image&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
<label for="image"></label>
<input type="file" name="image" id="image" />
(Upload New Image only is there is a change in the existing image)</p>
<p>Contents &nbsp;&nbsp;&nbsp;:
<label for="cont"></label>
<textarea name="description" id="description" cols="100" rows="12" ><?php echo $row['description']; ?></textarea>
</p>
<p align="center">
<input type="submit" name="Submit" id="Submit" value="Submit" />
</p>
</form>
</div>
</div>
</body>
</html>