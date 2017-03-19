<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#col_after_zoom">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
          </button>
        </div>

	  <ul class="nav navbar-nav center">
            <li><a data-toggle="tooltip" data-placement="bottom" title="Najnovije" href="index.php"><span class="glyphicon glyphicon-play-circle"></span> Zadnje dodato</a></li>
            <li><a data-toggle="tooltip" data-placement="bottom" title="Najpopularnije" href="popular.php"><span class="glyphicon glyphicon-star"></span> Najpopularnije</a></li>
            <li><a data-toggle="tooltip" data-placement="bottom" title="Filmovi" href="#"><span class="glyphicon glyphicon-facetime-video"></span> Filmovi</a></li>
            <li><a data-toggle="tooltip" data-placement="bottom" title="Serije" href="shows.php"><span class="glyphicon glyphicon-blackboard"></span> Serije</a></li>

            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-asterisk"></span> Kategorije
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <?php

                	$stmt = $connection->prepare("SELECT * FROM categories");
                	$stmt->execute();

                	if($stmt->rowCount() > 0)
                	{
        				$check = $stmt->fetchAll(PDO::FETCH_ASSOC);

        				foreach( $check as $row )
        				{
        					echo '
        						<li><a href="category.php?category_id=', $row['name'] ,'&movies">',$row['name'],'</a></li>
        					';
        				}       		
                	}
                ?>
            </ul>
         </li>
	  </ul>

    <?php

    if(check_login())
    {
    	echo '

		<div class="pull-right">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-plus"></span> Moderator
                        <span class="caret"></span></a>

                     <ul class="dropdown-menu">
                         <li><a name="add_movie" id="add_movie" data-toggle="modal" data-target="#add_movie_modal" href="">Dodaj film</a></li>
                         <li><a name="add_movie_cat" id="add_movie" data-toggle="modal" data-target="#add_movie_category" href="">Dodaj filmsku kategoriju</a></li>
                         <li><a name="add_show" id="add_movie" data-toggle="modal" data-target="#add_tv_show" href="">Dodaj novu seriju</a></li>
                         <li><a name="add_show_episode" id="add_movie" data-toggle="modal" data-target="#add_episode" href="">Dodaj novu epizodu</a></li>
                         <li><a name="delete_movie" id="add_movie" data-toggle="modal" data-target="#add_movie_modal" href="">Obrisi film</a></li>
                         <li><a name="delete_show" id="add_movie" data-toggle="modal" data-target="#add_movie_modal" href="">Obrisi seriju</a></li>
                         <li><a name="delete_episode" id="add_movie" data-toggle="modal" data-target="#add_movie_modal" href="">Obrisi epizodu</a></li>
                     </ul>
               </li>
              <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> ', $_SESSION['username'] ,'
                        <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="profile.php?user=', $_SESSION['username'] ,'">Moj profil</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>     
        	   </div>
    	';
    }
    else
    {
    	echo '
		<div class="pull-right">
		        <ul class="nav navbar-nav">
		            <button type="submit" class="btn navbar-btn btn-primary" name="user_login" id="user_login" data-toggle="modal" data-target="#user-login-modal">Prijava</button>
		        </ul>     
		</div>
    	';
    }

    ?>
    </div>
  </div>
</nav>

