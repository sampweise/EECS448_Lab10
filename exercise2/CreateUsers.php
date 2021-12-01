<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$mysqli = new mysqli("mysql.eecs.ku.edu", "s133w404", "aguqu3ph", "s133w404");

if ($mysqli->connect_errno) {
  printf("Connect failed: %s\n", $mysqli->connect_error);
}

$userID = $_REQUEST["user"];
$queryUser = "INSERT INTO Users (user_id) VALUES ('$userID')";
$queryCount = "SELECT * FROM Users WHERE user_id = '$userID'";

$result = $mysqli->query($queryCount);

if($result)
{
	if($result->num_rows > 0)
	{
		printf("Sorry that username was taken!");
	}
	else
	{
		if($userID == "")
		{
			printf("Sorry you can't leave the field blank");
		}
		else
		{
			if($mysqli->query($queryUser))
			{
  			printf("Request was stored in the database!");
			}
		}
	}
}


$mysqli->close();
?>
