<?php
//Create Session
session_start();
//header
$page_title = "INFOST440 Final";
include('header.php');

//If a user name is entered display login mesage
	if (isset($_SESSION['first_name'])) {
		echo "You currently logged in as {$_SESSION['first_name']}. Welcome to our website!";
}
include('mysqli_connect.php');

if (isset($_GET['delete_id']) && (isset($SESSION['user_id']) && ($_SESSION['user_id'] == 7))){
	$delete_id = mysqli_real_escape_string($dbc, trim($_GET['delete_id']));
	
	$delete_query = "DELETE FROM blogposts WHERE blogpost_id = " . $delete_id;
	$delete_results = mysqli_query($dbc, $delete_query);
	
	echo "<h3>The entry has been deleted.</h3>";
}else{
	$delete_id = "";
}

//***********************************************
//PAGINATION SETUP START
//From Textbook Script 10.5 - #5
//***********************************************

// Number of records to show per page:
$display = 5;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
$pages = $_GET['p'];
} else { // Need to determine.
// Count the number of records:
$q = "SELECT COUNT(blogpost_id) FROM blogposts";
$r = mysqli_query ($dbc, $q);
$rowp = mysqli_fetch_array ($r, MYSQLI_NUM);
$records = $rowp[0];
// Calculate the number of pages...
if ($records > $display) { // More than 1 page.
$pages = ceil ($records/$display);
} else {
$pages = 1;
}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
$start = $_GET['s'];
} else {
$start = 0;
}

//***********************************************
//PAGINATION SETUP END
//***********************************************
//***********************************************
//SORTING SETUP START
//From Textbook Script 10.5 - #5
//***********************************************

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'date';

// Determine the sorting order:
		switch ($sort) {
            case 'recent':
            $order_by = 'blogpost_timestamp DESC';
            break;
            case 'oldest':
            $order_by = 'blogpost_timestamp ASC';
            break;
            default:
            $order_by = 'blogpost_timestamp DESC';
            $sort = 'recent';
            break;


}

//Sort buttons
 echo '<div align="center">';
 echo '<strong> Sort By: </strong>';
 echo '<a href="?sort=recent">Most Recent</a> | ';
 echo '<a href="?sort=oldest">Oldest</a> ';
 echo '</div>';

//***********************************************
//SORTING SETUP END
//***********************************************
?>

<!--here I used a w3 schools css framework for my guestbook -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style>
	/*here I aligned the h2 tag to the center*/
h2{
	text-align: center;
}

</style>

<h2>Here are the Entries: </h2> 
<br>



<?php
//here with php and sql we are able to show all the guestbook entries
//query that shows guestbook entries
$query = "SELECT * FROM blogposts ORDER BY $order_by LIMIT $start, $display";
$results = mysqli_query($dbc,$query);
	
/*	if($results){
		echo "It worked the comment was deleted!";
		} else {
		echo "There was an error!" . mysqli_error($dbc);
	}
*/ 
//while loop that shows all the entries along with css formatting
while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
	?>
	<!-- css framework div with amber color -->
	<div class="w3-red w3-hover-shadow w3-padding-64 w3-center" style="margin: auto">
		
	<?php
	//here we echo out all the entries
	echo $row['blogpost_title'] . "<br>";
	echo $row['blogpost_body'] . "<br>";
	echo $row['blogpost_timestamp']. "<br><br>";
	echo "<a href='update.php?blogpost_id=" . $row['blogpost_id'] . "'>Update Post</a> | ";
	echo "<a href='viewcomments.php?blogpost_id=" . $row['blogpost_id'] . "'>View Comments</a> | ";
	echo "<a href='index.php?delete_id=" . $row['blogpost_id'] . "'>Delete Post</a> | ";
	echo "<a href='newcomment.php?blogpost_id=" . $row['blogpost_id'] . "'>Add Comment</a> ";
	

}	
//***********************************************
//PAGINATION PREVIOUS AND NEXT PAGE BUTTONS/LINKS START
//***********************************************

// Make the links to other pages, if necessary.
if ($pages > 1) {

echo '<br /><p>';
$current_page = ($start/$display) + 1;

// If it's not the first page, make a Previous button:
if ($current_page != 1) {
echo '<a href="?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
}

// Make all the numbered pages:
for ($i = 1; $i <= $pages; $i++) {
if ($i != $current_page) {
echo '<a href="?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
} else {
echo $i . ' ';
}
} // End of FOR loop.

// If it's not the last page, make a Next button:
if ($current_page != $pages) {
echo '<a href="?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
}

echo '</p>'; // Close the paragraph.

} // End of links section.

//***********************************************
//PAGINATION PREVIOUS AND NEXT PAGE BUTTONS/LINKS END
//***********************************************
?>



</div>
<?php
include('footer.php');
?>
