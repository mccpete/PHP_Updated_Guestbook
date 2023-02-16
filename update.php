<?
if (!isset($_SESSION['user_id']) OR $_SESSION['user_id'] != 7){
	header('Location: https://pemclane.uwmsois.com/classcontent440/finalproject/login.php');
	
}
?>

<?php
$page_title = "Update";
include('header.php');
include('mysqli_connect.php');
#include('footer.php');
$sticky_blogpost = "";

?>

<style>
	/* I aligned the page to the center and used some css for submit button*/
.menu {
	text-align center;
}

input[type=submit] {
    background: #0066A2;
	color: white;
	border-style: outset;
	border-color: #0066A2;
	height: 50px;
	width: 100px;
	font: bold15px arial,sans-serif;
	text-shadow: none;
}
</style>

<?php
	$user_id = mysqli_real_escape_string($dbc, trim($_SESSION['user_id']));
	
	if (isset($_GET['blogpost_id'])){
		$blogpost_id = mysqli_real_escape_string($dbc, trim($_GET['blogpost_id']));
	}else{
		$blogpost_id = "";
	}
	
	if (isset($_POST['blogpost_body'])){
		$blogpost_body = mysqli_real_escape_string($dbc, trim($_POST['blogpost_body']));
	}else{
		$blogpost_body = "";
	
}
	
	
	//$guestbook_id = $_POST['guestbook_id'];
	//$comment = $_POST['comment'];

//here is where we use php and sql to update our query 
if ($_SERVER['REQUEST_METHOD']=='POST'){
	
	if (isset($_POST['blogpost_title'])){
		$blogpost_title = mysqli_real_escape_string($dbc, trim($_POST['blogpost_title']));
	}else{
		$blogpost_title = "";
	
	//here is the sql query that is used to update our database
	$query = "UPDATE blogposts SET $blogpost_body= '$blogpost_body' WHERE blogpost_id = '$blogpost_id'";
	
	$results = mysqli_query($dbc,$query);
	
	if($results){
		echo "<h3>Your Post has been updated!</h3>";
		} else {
		echo "There was an error!" . mysqli_error($dbc);
}

}

?>

<?php
if (isset($blogpost_body)){
	$sticky_query="SELECT blogpost_body FROM blogposts WHERE blogpost_id=" .$blogpost_id;
	$sticky_results=mysqli_query($dbc,$sticky_query);
	$sticky_row=mysqli_fetch_array($sticky_results,MYSQLI_ASSOC);
	$sticky_comment=$sticky_row['blogpost_body'];
	
}


?>


<!--here is the form that is used to update a guestbook entry-->
<div class = 'menu'>
<form action="update.php?blogpost_id=<?php echo $blogpost_id;?>" method="post">
Please enter new title:
<input name="blogpost_title" cols="40" rows="5">
<br>
Please enter new comments:
<br>
<textarea name="blogpost_body" cols="40" rows="5"><?php echo $sticky_comment;?></textarea>
<br>
<input type="submit" name="submit" value="Submit" />

</form>

</div>
<?php

include('footer.php');

?>
