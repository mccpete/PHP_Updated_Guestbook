<?php
session_start();
if (!isset($_SESSION['user_id'])){
	header('Location: https://pemclane.uwmsois.com/classcontent440/finalproject/login.php');
	
}
$page_title = "New Comment";


include('header.php');
include('mysqli_connect.php');

?>


<?php
$user_id = "";
$blogpost_id = "";

$user_id = mysqli_real_escape_string($dbc, trim($_SESSION['user_id']));
$blogpost_id = mysqli_real_escape_string($dbc, trim($_GET['blogpost_id']));
?>

<style>

.text{
	
   margin: auto;
   width: 50%;
  
}

</style>
  

<div id="text">
<h2>Please enter new comments:</h2>
<br>
<textarea name="blogpost_body" cols="40" rows="5"></textarea>
<br>
<input type="submit" name="submit" value="Submit New Comment" />



</div>
