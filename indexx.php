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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="contain">
<div id="header">
<h1>News Breaks Here.. </h1>

</div>
<div id="menus">
<a href="index.php" target="_self">Home</a>

<?php
/*
Displaying List of Categories from the Table - Category and that is limited to 10
*/
$qry=mysql_query("SELECT * FROM category LIMIT 0, 10", $con);
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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="login.php" target="_self">Login</a>
</div>
<div id="l_space">
<h2>Breaking News..</h2>
<?php
/*
Selecting the last added articles to display in the secton - "Breaking news" from the table "articles"
*/
$qry=mysql_query("SELECT * FROM food order by food.id DESC LIMIT 0, 1", $con);
if(!$qry)
{
die("Query Failed: ". mysql_error());
}

/* Fetching and dispalying the datas to breakign news section from the databse table "articles" */
/*
the php in-built function substr() is used to limit the no of characters displayed in breakign news section to 200 and when "Read more" is clicked article id is transfered through url to articles.php for displaying in full
*/
while($row=mysql_fetch_array($qry))
{
echo "<h2>".$row['title']."</h2>";
echo "<img src=".$row['image']." />";
echo "<p>".substr($row['description'],0,200)."<a href=articles.php?id=".$row['id']." > Read more</a></p>";
}
?>
<p>&nbsp;</p>
</div>
<div id="r_space">
<h2>News::</h2>
<?php
/* Selecting & querying the Table "articles"
in descending order referring to the field "id"
and limiting the number of result to 10 */
$qry=mysql_query("SELECT * FROM food order by food.id DESC LIMIT 0, 3", $con);
if(!$qry)
{
die("Query Failed: ". mysql_error());
}

/* Fetching data from the field "title" */
while($row=mysql_fetch_array($qry))
{
echo "<li><a href=articles.php?id=".$row['id'].">".$row['title']."</a></li>";
}
?>
</div>
<div id="footer">
<div align="center"><strong>Copyright @ 2016 - All Rights Reserved</strong></div>
</div>
"</div>
</body>
</html>