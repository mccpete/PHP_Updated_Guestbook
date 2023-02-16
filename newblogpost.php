<?php
session_start();

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

<div class = 'menu'>
<h2>Please enter new Blogpost:</h2>
Title
<br>
<textarea name="blogpost_body" cols="25" rows="1"></textarea>
<br>
<br>


Body
<br>
<textarea name="blogpost_body" cols="40" rows="5"></textarea>
<br>
<br>
<input type="submit" name="submit" value="Submit" />


</div>
