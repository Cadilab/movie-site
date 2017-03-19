<?php

	session_start();
	require 'db.php';
	error_reporting(1);

	include('assets/posts.php');
	include('assets/functions.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>MyMovies</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="css/style.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
	<link href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">	
</head>

<body>

<?php 


include('assets/header.php'); 
include('assets/modals.php');

?>


<?php 

	if(isset($_GET['movie']) && !empty($_GET['movie']) && !isset($_GET['epizoda']))
	{
		$hash = $_GET['movie'];

		$stmt = $connection->prepare("SELECT * FROM movies WHERE hash = :hash");
		$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
		$stmt->execute();

		if($stmt->rowCount() > 0)
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$catego_display = $row['categories'];
			$pattern = str_replace(";", ", ", $catego_display);

			echo '

				<div class="display_movie alert">
					<div class="container">
						<br>
								<h3>',$row['name'],' (',$row['year'],')</h3>
							<p>
						',$row['description'],'
					</p>
						<p data-toggle="tooltip" data-placement="bottom" title="Najpopularnije"><span class="glyphicon glyphicon-tag"></span> ',$pattern,'</p>
						<p data-toggle="tooltip" data-placement="bottom" title="Najpopularnije"><span class="glyphicon glyphicon-user"></span> ',$row['actors'],'</p>
					</div>
				</div>
					<div class="container">

					<iframe src="',$row['embed_code'],'" scrolling="no" frameborder="0" width="1100" height="430" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>

					<h3>Views: ',$row['views'],'</h3>
			';

			$stmt = $connection->prepare("SELECT * FROM comments where hash_id = :hash");
			$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
			$stmt->execute();

			if($stmt->rowCount() > 0)
			{

				$check = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach($check as $row)
				{

					echo '

						<br><div class="media">
						  <div class="media-left">
						    <img  src="avatars/default.png" class="media-object" height="60" width="60" style="pointer-events: none;">
						  </div>
						  <div class="media-body">
						    <h4 class="media-heading">',$row['user'],'</h4>
						    <p>',$row['comment'],'</p>
						  </div>
						</div>
					';
				}
			}	
			else
			{
				echo '<br/><h4>U ovom filmu nema komentara.</h4>';				
			}

			if(check_login())
			{
				echo '
				<form method="post">
					 <br/><textarea name="movie_comment" class="form-control" rows="5" name="show_desc" placeholder="Ostavite komentar"></textarea><br/>
					 <input type="submit" name="movie_comment_submit" class="btn navbar-btn btn-primary" value="Ostavi komentar">
				</form>
				';
			}
			else
			{
				echo '<br/><h4>Da ostavite komentar morate se ulogovati!</h4>';
			}
			echo '</div>';

			$sample_rate = 24;
			$increase_rate = 4;
			if(mt_rand(1, $sample_rate) == 1) 
			{
				$stmt = $connection->prepare("UPDATE movies SET views = views + {$increase_rate} WHERE hash = :hash");
				$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
				$stmt->execute();				
			}

		}
		else
		{
			header("location: index.php");
			exit();
		}
	}
	else
	{
		header("location: index.php");
		exit();
	}

?>

</div>

</body>
</html>