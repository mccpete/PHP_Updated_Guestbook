<?php

//This includes the header and mysqldatabase.
$page_title = "View Comments";
include('header.php');
include('mysqli_connect.php');

//Get whatever information you need from either GET, SESSION, or POST
$blogid = mysqli_real_escape_string($dbc, trim($_GET['blogpost_id']));

//Your SQL Query
$query = "SELECT * FROM comments WHERE blogpost_id =" .$blogid;
$result = mysqli_query($dbc, $query);

//Your loop to display everything
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

echo "<h2>Comments: </h2>";
echo "<br>";
echo "Nice Post!";
echo "<br>";
echo "- John Smith at 2022-12-07 10:13:30";
}

?>
