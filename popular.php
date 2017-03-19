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

<div class="other_thingies alert">

<div class="container">
<br>
<h3>Most popular movies</h3>
<p>
Ovde se nalaze najpopularniji filmovi na nasoj stranici. 

</p>

</div>

</div>

<div class="container">

<?php

	$stmt = $connection->prepare("SELECT * FROM movies ORDER BY views DESC LIMIT 20");
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
						<a href="watch.php?movie=',$row['hash'],'" title="',$row['name'],'">
						<img alt="',$row['name'],'" width="165" height="250" class="img-responsive" src="',$row['thumb_location'],'">
							<span class="play animated flip">
							<i class="fa fa-play-circle fa-4x"></i>
							</span>
							</a>
							<div class="opis">
							<a href="watch.php?movie=',$row['hash'],'" title="',$row['name'],' "><h2>',$row['name'],' </h2></a>
							<div class="tekst">
							</div>
							<p>
							<span>
							<a href="godina.php?movie=',$row['year'],'" title="',$row['year'],'">',$row['year'],'</a>
							</span>
						</p>
					</div>
				</div>
			</div>

			';			
		}
	}
	else
	{
		echo '<p>U databazi nema filmova</p>';
	}

?>

</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip']').tooltip(); 
});
</script>

</body>
</html>