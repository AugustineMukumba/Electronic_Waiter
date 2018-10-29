<?php

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
<title>articles</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
a:link {
text-decoration: none;
}
a:visited {
text-decoration: none;
}
a:hover {
text-decoration: underline;
}
a:active {
text-decoration: none;
}
</style>
</head>

<body>
<div id="contain">
<div id="header">
<h1>News Breaks Here..</h1>
</div>
<div id="menus">
<a href="index.php" target="_self">Home</a>
<?php
/*
Displaying List of Categories from the Table - Category and that is limited to 6
*/
$qry=mysql_query("SELECT * FROM category LIMIT 0, 6", $con);
if(!$qry)
{
die("Query Failed: ". mysql_error());
}

/* Fetching datas from the field "category" and article id is transfered to articles.php file */
while($row=mysql_fetch_array($qry))
{
echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href=articles.php?cat=".$row['category'].">".$row['category']."</a>

&nbsp;&nbsp;&nbsp;&nbsp;";
}
?>
</div>

<div id="l_space">
<h2>News::</h2>
<?php
/*
isset() is used to check wheather arctile id is received through url from "index.php" file and if it is set corresponding arctile is displayted using SELECT statement.
*/

if(isset($_GET['id']))
{
$id=$_GET['id'];
$qry=mysql_query("SELECT * FROM food WHERE id=$id", $con);
if(!$qry)
{
die("Query Failed: ". mysql_error());
}

                /* Fetching data from the field "title" */
while($row=mysqli_fetch_array($qry))
{
echo "<h2>".$row['name']."</h2>";
echo "<img src=".$row['image']." />";
echo "<p>".$row['description']."</p>";
}
}

/*
based on the category name received from index.php file the last added article is displayed
*/
if(isset($_GET['cat']))
{
//echo $_GET['cat'];
$cat=$_GET['cat'];
$qry=mysql_query("SELECT * FROM food WHERE category='$cat' order by food.id DESC LIMIT 0, 1", $con);
if(!$qry)
{
die("Query Failed: ". mysql_error());
}

                /* Fetching data from the field "title" */
while($row=mysql_fetch_array($qry))
{
echo "<h2>".$row['name']."</h2>";
echo "<img src=".$row['image']." />";
echo "<p>".$row['description']."</p>";
}
}

?>

</div>

 

  <div id="r_space">
<h2>News</h2>
<?php
/*
based on the id received from index.php through url, the category of the particular article is determined
*/
if(isset($_GET['id']))
{
$id=$_GET['id'];
$qry=mysql_query("SELECT category FROM food WHERE id='$id'", $con);
if(!$qry)
{
die("Query Failed: ". mysql_error());
}
/* Fetching data from the field "title" */
$row=mysql_fetch_array($qry);
$cat=$row['category'];

/*
once the category of the article is determined this section is used to display the title of all the articles belonging to that category
*/                          
$qry=mysql_query("SELECT * FROM food WHERE category='$cat' order by food.id DESC", $con);
if(!$qry)
{
die("Query Failed: ". mysql_error());
}
while($row=mysql_fetch_array($qry))
{
//echo $row['title'];
echo "<li><a href=articles.php?id=".$row['id'].">".$row['name']."</a></li>";
}
}

/*
based on the category name received from index.php file title names of all the articles belong to the category is displayed with hyperlinks
*/          
if(isset($_GET['cat']))
{
$cat=$_GET['cat'];


$qry=mysql_query("SELECT * FROM food WHERE category='$cat' order by food.id DESC", $con);
if(!$qry)
{
die("Query Failed: ". mysql_error());
}
while($row=mysql_fetch_array($qry))
{
echo "<li><a href=articles.php?id=".$row['id'].">".$row['name']."</a></li>";
}

}
?>
</div>

<div id="footer">
<div align="center"><strong>Copyright @ 2011 - All Rights Reserved</strong></div>

</body>
</html>