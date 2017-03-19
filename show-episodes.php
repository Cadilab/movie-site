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

if(isset($_GET['serija']) && !empty($_GET['serija']))
{
	$hash = $_GET['serija'];

	$stmt = $connection->prepare("SELECT * FROM series WHERE hash = :hash");
	$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
	$stmt->execute();

	if($stmt->rowCount() > 0)
	{
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
		echo '

				<div class="display_movie alert">
					<div class="container">
						<br>
							<h3>',$row['name'],' (',$row['year'],')</h3>
						<p>
					 	',$row['description'],'
					</p>

						<p data-toggle="tooltip" data-placement="bottom" title="Najpopularnije"><span class="glyphicon glyphicon-tag"></span> ',$row['categories'],'</p>
						<p data-toggle="tooltip" data-placement="bottom" title="Najpopularnije"><span class="glyphicon glyphicon-user"></span> ',$row['actors'],'</p>
					</div>
				</div>
				<div class="container">
		';
	}

	$stmt = $connection->prepare("

		SELECT
		*
		FROM episodes
		INNER JOIN series ON episodes.serie_id = series.hash
		WHERE episodes.serie_id = :hash

	");

	$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
	$stmt->execute();

	if($stmt->rowCount() > 0)
	{

		$check = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($check as $row)
		{
			echo '
				<div class="row" id="content">
					<div class="col-md-2 col-sm-4 col-xs-6 animacija animated fadeInDown">
						<div class="film">
							<a href="watch.php?epizoda=',$row['episode_hash'],'" title="',$row['episode_name'],'">
							<img alt="',$row['episode_name'],'" width="165" height="250" class="img-responsive" src="',$row['thumb_location'],'">
								<span class="play animated flip">
								<i class="fa fa-play-circle fa-4x"></i>
								</span>
								</a>
								<div class="opis">
								<a href="watch.php?epizoda=',$row['episode_hash'],'" title="',$row['episode_name'],' "><h2>',$row['name'],' : ',$row['episode_name'],' (',$row['year'],') </h2></a>
								<div class="tekst">
								</div>
								<p>
								<span>
								<a href="godina.php?serija=',$row['year'],'" title="',$row['year'],'">',$row['year'],'</a>
								</span>
								<span class="sezona" data-toggle="tooltip" data-placement="top" title="" data-original-title="Epizoda">E',$row['episode'],'</span>
								<span class="sezona" style="background: #E55934;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sezona">S',$row['season'],'</span>							
							</p>
						</div>
					</div>
				</div>
			';				
		}
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