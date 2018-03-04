<?php
	
// original based on Martin Angelov script at tutorialzine.com
// 2nd generation based on https://github.com/berteh/url-shortener	
// This generation adds the ability to add links when they're not found

/* structure of document:
	1. HANDLE SUBMISSIONS
	2. TRY TO LOAD URL
	3. URL NOT FOUND, ASK TO ADD
*/


// 1. HANDLE SUBMISSIONS
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$newshortcut = strtolower($_REQUEST["newshortcut"]); // lowercase
	$newurl = $_REQUEST["newurl"]; // grab the url
	$newline = "$newshortcut = \"$newurl\"\n"; // set up the line	
	file_put_contents("links.ini", $newline, FILE_APPEND); // write it
	
	// todo: add confirmation
	
	echo "<a href='$newurl'>Go to $newurl?</a>"; // once it's submitted, provide the link		
	?>
		<h2>Add new thing</h2>
		<form method="post" action="index.php">
			<input type="text" name="newshortcut">
			<input type="text" name="newurl">
			<input type="submit">
		</form>
		<?php


// 2. TRY TO LOAD URL
}else{


	$url=$_SERVER['REQUEST_URI']; // get the url
	$shortcut = basename($url); // take the last thing in this URL and pass it along
	$links = parse_ini_file('links.ini'); // look for that reference in the ini file
	
	// let's make sure the search is case insensitive
	array_change_key_case($links);
	
	if(array_key_exists($shortcut, $links)){
	    header("Location: ".$links[$shortcut]);
	}else{ // 3. URL NOT FOUND, ASK TO ADD
		?>
		
		<h2>Want to add this?</h2>
		
		<form method="post" action="index.php">
			<input type="text" name="newshortcut" value="<?php echo $shortcut ?>">
			<input type="text" name="newurl">
			<input type="submit">
		</form>
		
		<?php
	}

}

?>
