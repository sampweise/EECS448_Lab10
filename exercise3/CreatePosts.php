<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$mysqli = new mysqli("mysql.eecs.ku.edu", "s133w404", "aguqu3ph", "s133w404");

if ($mysqli->connect_errno) {
  printf("Connect failed: %s\n", $mysqli->connect_error);
}

$userID = $_REQUEST["user"];
$content = $_REQUEST["content"];
$queryCount = "SELECT * FROM Users WHERE user_id = '$userID'";
$queryPostID = "SELECT post_id FROM Posts WHERE post_id=(SELECT max(post_id) FROM Posts)";
$PostID = $mysqli->query($queryPostID)->fetch_assoc();
$PostCount = $PostID["post_id"] + 1;
$result = $mysqli->query($queryCount);

$queryPost = "INSERT INTO Posts (post_id, content, author_id) VALUES ('$PostCount', '$content', '$userID')";

if($result->num_rows > 0)
{
	if($content == "")
	{
		printf("You entered nothing please try again");	
	}
	else
	{
		//post
		$mysqli->query($queryPost);
		printf("Post saved!");
	}
}
else
{
	printf("Sorry you are not an existing user please try again!");
}



$mysqli->close();
?>
