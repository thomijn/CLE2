<?Php

require_once "./includes/database.php";

$query =   "SELECT appointment.*
FROM appointment";

$result = mysqli_query($db, $query)
or die('Error' .mysqli_error($db).'<br>query:'. $query);

$appointments = [];
While( $row = mysqli_fetch_assoc($result) ) {
    $appointments[] = $row;
}


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
  <link href="./css/all.css" rel="stylesheet">
  <!--load all styles -->
  <script defer src="./css/js/all.js"></script>
  <!--load all styles -->


  <title>Fotografie Gertenbach</title>
</head>

<body>

  <div class="container">


          <section id="view">

            <div class="header">
              <h3>Overzicht van alle afspraken</h3>
                <button type="submit" class="btn btn-primary"><a href="new.php"><i class="far fa-plus fa-2x"style="color: white"></i></a></button>


                    <div class="input-group">
                 <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
                 </span>
                        <input type="text" class="form-control" placeholder="Search for...">
                    </div><!-- /input-group -->


                <div data-toggle="modal" data-target=".bs-example-modal-sm" class="logout"> <i  class="fal fa-sign-out-alt fa-1x" style="color: black"></i> Uitloggen   </div>
            </div>

<?php
              foreach ($appointments as $key => $appointment) { ?>

                  <a href="detailpagina.php?id=<?= $appointment['AppointmentId']; ?>">
                      <div class=" appointment">
                      <?php
                      if ($appointment['Type'] == 'Marriage'){
                          ?> <i class="fal fa-comments fa-3x" style="color: #F49100"></i> <?php
                      }
                      else {
                          ?> <i class="fal fa-camera-alt fa-3x" style="color: #F49100"></i> <?php
                      }
                      ?>


                          <?php

                      if ($appointment['Type'] == 'Loveshoot') { ?>
                          <h5> LOVESHOOT </h5>
                      <?php  }

                      else if ($appointment['Type'] == 'Familyshoot') { ?>
                          <h5> FAMILYSHOOT </h5>
                      <?php  }

                      else  { ?>
                          <h5> INTAKE GESPREK </h5>
                      <?php  }
                      ?>
                      <i class="fal fa-calendar-alt fa-3x" style="color: black"></i>
                      <h5><?php
                          echo date(" d-m-Y ", strtotime($appointment['DateTime']));
                          ?></h5>
                      <p>

                      </p>
                          <div data-toggle="modal" data-target=".bs-delete-modal-sm" ><i class="far fa-trash-alt"></i>   </div>
                          <a href="edit.php?id=<?= $appointment['AppointmentId'];?>"><i class="far fa-edit"></i></a>
                  </div> </a>
              <?php    } ?>



              <div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                          <div class="modal-header"><h4>Logout <i class="far fa-lock"></i></h4></div>
                          <div class="modal-body"> Weet je zeker dat je wilt uitloggen?</div>
                          <div class="modal-footer"><a href="logout.php" class="btn btn-primary ">UITLOGGEN</a></div>
                      </div>
                  </div>
              </div>


              <div class="modal bs-delete-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                          <div class="modal-header"><h4>verwijderen <i class="far fa-trash"></i></h4></div>
                          <div class="modal-body"> Weet je zeker dat je deze afspraak wilt verwijderen</div>
                          <div class="modal-footer"><a href="logout.php" class="btn btn-primary ">VERWIJDEREN</a></div>
                      </div>
                  </div>
              </div>









          </section>
      





    


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"></script>
</body>

</html>