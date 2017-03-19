<!-- Add new episode -->

<div id="add_episode" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Dodavanje nove epizode</h4>           
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="text" class="form-control" name="episode_id" placeholder="ID serije"><br/><br/>
                    <input type="text" class="form-control" name="episode_name" placeholder="Ime epizode"><br/><br/>
                    <input type="text" class="form-control" name="episode_season" placeholder="Sezona"><br/><br/>
                    <input type="text" class="form-control" name="episode_episode" placeholder="Epizoda"><br/><br/>
                    <input type="text" class="form-control" name="episode_embed" placeholder="Embed link"><br/><br/>
                    <textarea class="form-control" rows="5" name="episode_desc" placeholder="Opis epizode"></textarea><br/><br/>
                    <input type="submit" name="episode_submit" class="btn navbar-btn btn-success" value="Dodaj seriju">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add movie category -->
<div id="add_tv_show" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dodavanje nove serije</h4>
      </div>
      <div class="modal-body">
        
      <form method="POST" enctype="multipart/form-data">

      <input type="text" class="form-control" name="show_name" placeholder="Ime serije"><br/><br/>
      <textarea class="form-control" rows="5" name="show_desc" placeholder="Opis serije"></textarea><br/><br/>
      <input type="text" class="form-control" name="show_year" placeholder="Godina izdavanja"><br/><br/>
      <input type="text" class="form-control" name="show_rating" placeholder="IMDB Ocena"><br/><br/>

      <label for="th_nail">Thumbnail:</label>
      <input type="file" hidden name="photo"><br/>

      <?php

        $stmt = $connection->prepare("SELECT * FROM categories");
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
            $check = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach( $check as $row )
            {
              echo 
              '
                <input type="checkbox" name="Categories[]" value="', $row['name'] ,'">', $row['name'] ,'<br>
              ';
            }           
          }

        ?>

      <input type="submit" name="add_show_submit" class="btn navbar-btn btn-success" value="Dodaj seriju">

      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Add movie category -->
<div id="add_movie_category" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dodavanje nove kategorije</h4>
      </div>
      <div class="modal-body">
        
      <form method="POST" enctype="multipart/form-data">

      <input type="text" class="form-control" name="category_name" placeholder="Ime kategorije"><br/><br/>

      <input type="submit" name="add_category_submit" class="btn navbar-btn btn-success" value="Dodaj kategoriju">

      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Add movie modal -->
<div id="add_movie_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dodavanje novog filma</h4>
      </div>
      <div class="modal-body">
        
      <form method="POST" enctype="multipart/form-data">

      <input type="text" class="form-control" name="movie_name" placeholder="Ime filma"><br/><br/>
      <textarea class="form-control" rows="5" name="movie_desc" placeholder="Opis filma"></textarea><br/><br/>
      <textarea class="form-control" rows="3" name="movie_actors" placeholder="Glumci, odvojite svakog glumca sa zapetom"></textarea><br/><br/>
      <input type="text" class="form-control" name="movie_link" placeholder="Openload embed"><br/><br/>
      <input type="text" class="form-control" name="movie_year" placeholder="Godina izdavanja"><br/><br/>
      <input type="text" class="form-control" name="movie_rating" placeholder="IMDB Ocena"><br/><br/>

      <label for="th_nail">Thumbnail:</label>
      <input type="file" hidden name="photo"><br/>

      <?php

        $stmt = $connection->prepare("SELECT * FROM categories");
        $stmt->execute();

        if($stmt->rowCount() > 0)
        {
        $check = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach( $check as $row )
        {
          echo 
          '

            <input type="checkbox" name="Categories[]" value="', $row['name'] ,'">', $row['name'] ,'<br>


          ';
        }           
          }

        ?>


      <input type="submit" name="add_movie_submit" class="btn navbar-btn btn-success" value="Dodaj film">


      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Login modal -->

<div class="modal fade" id="user-login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="loginmodal-container">
          <h1 style="color: #C0C0C0;">Login to Your Account</h1><br>
          <form method="POST">
            <input type="text" style="color: #C0C0C0;" name="login_user" placeholder="Username">
            <input type="password" style="color: #C0C0C0;" name="login_pass" placeholder="Password">
            <input type="submit" name="submit_login" class="login loginmodal-submit" value="Login">
          </form>
        </div>
  </div>
</div>