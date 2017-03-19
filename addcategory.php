<?php

session_start();
require 'db.php';
error_reporting(1);

include('assets/posts.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['add_category']))
	{
		$stmt = $connection->prepare("INSERT INTO categories (name) VALUES (:name)");
		$stmt->bindParam(":name", $_POST['category_name'], PDO::PARAM_STR);
		$stmt->execute();
		header("location: addcategory.php");
		exit();
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Category</title>
</head>
<body>

<form method="POST">

<input type="text" name="category_name" placeholder="Category name">
<input type="submit" name="add_category" value="Add">

</form>

</body>
</html>