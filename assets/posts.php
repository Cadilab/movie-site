<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if(isset($_POST['add_movie_submit']))
		{
			if(isset($_POST['movie_name']) && isset($_POST['movie_desc']) && isset($_POST['movie_actors']) && isset($_POST['movie_link']) && isset($_FILES['photo']))
			{

				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$temp = explode(".", $_FILES['photo']['name']);
				$extension = end($temp);

				if((($_FILES['photo']['type'] == "image/gif") || ($_FILES['photo']['type'] == "image/jpeg") || ($_FILES['photo']['type'] == "image/jpg") || ($_FILES['photo']['type'] == "image/pjpeg") || ($_FILES['photo']['type'] == "image/x-png") || ($_FILES['photo']['type'] == "image/png")) && ($_FILES['photo']['size'] < 1024000) && in_array($extension, $allowedExts))  
  				{
					if ($_FILES['photo']['error'] > 0) 
					{
						header("location: index.php");
						exit();
					}
					else
					{
						$temp = explode(".", $_FILES['photo']['name']);
        				$newfilename = round(microtime(true)) . '_movie.' . end($temp);
        				if (file_exists("thumbnail_photos/" . $newfilename . "")) 
						{
						    header("location: index.php");
						    exit();
						} 
						else   
						{
							if( move_uploaded_file($_FILES['photo']['tmp_name'], "thumbnail_photos/" . $newfilename) )
							{
								$checkBox = implode(';', $_POST['Categories']);
								$catego_display = $checkBox;
								$pattern = str_replace(";", " ", $catego_display);

								$auth_key = round(microtime(true));
								$name_path = "thumbnail_photos/".$newfilename;
								$orig_image = imagecreatefromjpeg($name_path);
								$image_info = getimagesize($name_path); 
								$width_orig  = $image_info[0];
								$height_orig = $image_info[1];
								$width = 214; 
								$height = 317;
								$destination_image = imagecreatetruecolor($width, $height);
								imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
								imagejpeg($destination_image, $name_path, 100);

								$stmt = $connection->prepare("INSERT INTO movies (name, description, categories, hash, thumb_location, actors, embed_code, year, rating) VALUES (:name, :description, :categories, :hash, :location, :actors, :code, :year, :rating)");
								$stmt->bindParam(':name', $_POST['movie_name'], PDO::PARAM_STR);
								$stmt->bindParam(':description', $_POST['movie_desc'], PDO::PARAM_STR);
								$stmt->bindParam(':categories', $pattern, PDO::PARAM_STR);
								$stmt->bindParam(':hash', $auth_key, PDO::PARAM_STR);
								$stmt->bindParam(':location', $name_path, PDO::PARAM_STR);
								$stmt->bindParam(':actors', $_POST['movie_actors'], PDO::PARAM_STR);
								$stmt->bindParam(':code', $_POST['movie_link'], PDO::PARAM_STR);
								$stmt->bindParam(':year', $_POST['movie_year'], PDO::PARAM_STR);
								$stmt->bindParam(':rating', $_POST['movie_rating'], PDO::PARAM_STR);
								$stmt->execute();

								$stmt = $connection->prepare("INSERT INTO movie_categories (movie_hash, category) VALUES (:hash, :category)");
								$stmt->bindParam(':hash', $auth_key, PDO::PARAM_STR);
								$stmt->bindParam(':category', $cat_id);
								foreach($_POST['Categories'] as $cat_id) $stmt->execute();

								header("location: index.php");
								exit();											
							}
						}			
					}  							
  				}	
			}
		}
		elseif (isset($_POST['episode_submit']))
		{
			if(isset($_POST['episode_id']) && isset($_POST['episode_name']) && isset($_POST['episode_season']) && isset($_POST['episode_episode']) && isset($_POST['episode_embed']) && isset($_POST['episode_desc']))
			{

				$stmt = $connection->prepare("SELECT * FROM series WHERE hash = :auth_key");
				$stmt->bindParam(':auth_key', $_POST['episode_id'], PDO::PARAM_STR);
				$stmt->execute();

				if($stmt->rowCount() > 0)
				{
					$auth_key = round(microtime(true));

					$stmt = $connection->prepare("INSERT INTO episodes (serie_id, episode_hash, episode_name, season, episode, episode_description, embed) VALUES (:hash, :ep_hash :name, :season, :episode, :description, :embed)");
					$stmt->bindParam(':hash', $_POST['episode_id'], PDO::PARAM_STR);
					$stmt->bindParam(':ep_hash', $auth_key, PDO::PARAM_STR);
					$stmt->bindParam(':name', $_POST['episode_name'], PDO::PARAM_STR);
					$stmt->bindParam(':season', $_POST['episode_season'], PDO::PARAM_STR);
					$stmt->bindParam(':episode', $_POST['episode_episode'], PDO::PARAM_STR);
					$stmt->bindParam(':description', $_POST['episode_desc'], PDO::PARAM_STR);
					$stmt->bindParam(':embed', $_POST['episode_embed'], PDO::PARAM_STR);
					$stmt->execute();
				}
				else
				{
					header("location: index.php");
					exit();						
				}
			}
		}
		elseif (isset($_POST['add_show_submit']))
		{
			if(isset($_POST['show_name']) && isset($_POST['show_desc']) && isset($_POST['show_year']) && isset($_POST['show_rating']) && isset($_FILES['photo']))
			{
				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$temp = explode(".", $_FILES['photo']['name']);
				$extension = end($temp);

				if((($_FILES['photo']['type'] == "image/gif") || ($_FILES['photo']['type'] == "image/jpeg") || ($_FILES['photo']['type'] == "image/jpg") || ($_FILES['photo']['type'] == "image/pjpeg") || ($_FILES['photo']['type'] == "image/x-png") || ($_FILES['photo']['type'] == "image/png")) && ($_FILES['photo']['size'] < 1024000) && in_array($extension, $allowedExts))  
  				{
					if ($_FILES['photo']['error'] > 0) 
					{
						header("location: index.php");
						exit();
					}
					else
					{
						$temp = explode(".", $_FILES['photo']['name']);
        				$newfilename = round(microtime(true)) . '_show.' . end($temp);
        				if (file_exists("thumbnail_photos/" . $newfilename . "")) 
						{
						    header("location: index.php");
						    exit();
						}
						else
						{
							if( move_uploaded_file($_FILES['photo']['tmp_name'], "thumbnail_photos/" . $newfilename) )
							{
								$checkBox = implode(';', $_POST['Categories']);
								$catego_display = $checkBox;
								$pattern = str_replace(";", " ", $catego_display);

								$auth_key = round(microtime(true));
								$name_path = "thumbnail_photos/".$newfilename;
								$orig_image = imagecreatefromjpeg($name_path);
								$image_info = getimagesize($name_path); 
								$width_orig  = $image_info[0];
								$height_orig = $image_info[1];
								$width = 214; 
								$height = 317;
								$destination_image = imagecreatetruecolor($width, $height);
								imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
								imagejpeg($destination_image, $name_path, 100);

								$stmt = $connection->prepare("INSERT INTO series (hash, name, thumb_location, description, year, rating, categories) VALUES (:hash, :name, :location, :description, :year, :rating, :cats)");
								$stmt->bindParam(':hash', $auth_key, PDO::PARAM_STR);
								$stmt->bindParam(':name', $_POST['show_name'], PDO::PARAM_STR);
								$stmt->bindParam(':location', $name_path, PDO::PARAM_STR);
								$stmt->bindParam(':description', $_POST['show_desc'], PDO::PARAM_STR);
								$stmt->bindParam(':year', $_POST['show_year'], PDO::PARAM_STR);
								$stmt->bindParam(':rating', $_POST['show_rating'], PDO::PARAM_STR);
								$stmt->bindParam(':cats', $pattern, PDO::PARAM_STR);
								$stmt->execute();

								$stmt = $connection->prepare("INSERT INTO show_categories (serie_hash, category) VALUES (:hash, :category)");
								$stmt->bindParam(':hash', $auth_key, PDO::PARAM_STR);
								$stmt->bindParam(':category', $cat_id);
								foreach($_POST['Categories'] as $cat_id) $stmt->execute();

								header("location: index.php");
								exit();							
							}
						}
					}
  				}								
			}
		}
		elseif (isset($_POST['add_category_submit']))
		{
			if(!empty($_POST['category_name']))
			{
				$stmt = $connection->prepare("INSERT INTO categories (name) VALUES (:name)");
				$stmt->bindParam(":name", $_POST['category_name'], PDO::PARAM_STR);
				$stmt->execute();
				header("location: index.php");
				exit();				
			}	
		}
		elseif (isset($_POST['submit_login']))
		{
			if(!empty($_POST['login_user']) && !empty($_POST['login_pass']))
			{
				$stmt = $connection->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
				$stmt->bindParam(':username', $_POST['login_user'], PDO::PARAM_STR);		
				$stmt->execute();

				if($stmt->rowCount() > 0)
				{
					$row = $stmt->fetch(PDO::FETCH_ASSOC);

					if(password_verify($_POST['login_pass'], $row['password']))
					{
						$_SESSION['logged_in'] = true;
						$_SESSION['user_id'] = $row['id'];
						$_SESSION['username'] = $row['username'];

						header("location: index.php");
						exit();								
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
			}
			else
			{
				header("location: index.php");
				exit();
			}
		}
		else if(isset($_POST['movie_comment_submit']))
		{
			if(!empty($_POST['movie_comment']))
			{
				$movie_url = $_GET['movie'];

				$stmt = $connection->prepare("INSERT INTO comments (hash_id, user, comment) VALUES (:hash_id, :user, :comment)");
				$stmt->bindParam(':hash_id', $movie_url, PDO::PARAM_STR);
				$stmt->bindParam(':user', $_SESSION['username'], PDO::PARAM_STR);
				$stmt->bindParam(':comment', $_POST['movie_comment'], PDO::PARAM_STR);
				$stmt->execute();

				header("location: watch.php?movie=$movie_url");
				exit();
			}
		}
	}

?>	