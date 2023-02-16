<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $page_title; ?></title>
</head>

<body>
	<!--Code to make website mobile responsive -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />	
	<div id="navigation">
		<ul>
			<li><a href="index.php">Home Page</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a href="view_users.php">View Users</a></li>
			<li><a href="password.php">Change Password</a></li>
			<li><?php // Create a login/logout link:
if ( (isset($_SESSION['user_id'])) && (basename($_SERVER['PHP_SELF']) != 'logout.php') ) {
	echo '<a href="logout.php">Logout</a>';
} else {
	echo '<a href="login.php">Login</a>';
}
?></li>

<?php
if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == 7)) {
	echo '<li> <a href="newblogpost.php"> Add New Blogpost</a></li>';
}
?>

		</ul>
	</div>
	<div id="content"><!-- Start of the page-specific content. -->
<!-- Script 12.7 - header.html -->
