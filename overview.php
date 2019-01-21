<?Php

session_start();

require_once "./includes/database.php";

$query =   "SELECT appointment.*
FROM appointment
ORDER BY DateTime ASC
";



$result = mysqli_query($db, $query)
or die('Error' .mysqli_error($db).'<br>query:'. $query);



$appointments = [];
While( $row = mysqli_fetch_assoc($result) ) {
    $appointments[] = $row;
}

if(!isset($_SESSION['logged_in'])) {
    // redirect to login page
    header('Location: adminlogin.php');
    exit;
}

$dateToday = date("Y-m-d");



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

    <link href="./css/hover.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <title>Fotografie Gertenbach</title>
</head>

<body>

  <div class="container">


          <section id="view">

            <div class="header">
              <h3 id="desktop" >Overzicht van alle afspraken</h3>
                <h3 id="mobile" >Overzicht </h3>

                <a href="new.php"><button type="submit" class="btn btn-primary"><i class="far fa-plus fa-2x"style="color: white"></i></a></button>



                <?php

                if(empty($appointments)){ ?>
                    <button data-toggle="modal" data-target=".bs-weather-modal-sm" type="submit" class="btn btn-secondary"><i class="fas fa-clouds fa-2x"style="color: white"></i></button>

                <?php                } else{
                if($appointments[0]['DateTime'] == $dateToday){ ?>
                <button data-toggle="modal" data-target=".bs-weather-modal-sm" type="submit" class="btn btn-today"><i class="fas fa-clouds fa-2x"style="color: white"></i></button>
                <?php
                } else { ?>
                <button data-toggle="modal" data-target=".bs-weather-modal-sm" type="submit" class="btn btn-secondary"><i class="fas fa-clouds fa-2x"style="color: white"></i></button>
                <?php
                }

                }
                ?>






                    <!--<div class="input-group">
                 <span class="input-group-btn">
                <button class="btn btn-default" type="button">Ga</button>
                 </span>
                        <input type="text" class="form-control" placeholder="Zoeken...">
                    </div>
-->

                <div  data-toggle="modal" data-target=".bs-example-modal-sm" class="logout  "> <i  class="fal fa-sign-out-alt fa-1x " style="color: black"></i> Uitloggen   </div>
            </div>

<?php
              foreach ($appointments as $key => $appointment) { ?>

                  <a href="detailpagina.php?id=<?= $appointment['AppointmentId']; ?>">
                      <div   class=" appointment hvr-underline-from-center ">
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

                          <a href="delete.php?id=<?= $appointment['AppointmentId'];?>"><i class="far fa-trash-alt"></i></a>

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

              <div class="modal bs-weather-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                          <div class="modal-header"><h4>Het weer nu in Papendrecht <i class="fas fa-clouds "></i></h4></div>
                          <div class="modal-body"> <h5 id="temp"> temperatuur:</h5> <h5 id="cloud"> het is % bewoklt</h5> </p> </div>


                      </div>
                  </div>
              </div>









          </section>



          <script>

              function reqListener () {
                  var weer = JSON.parse(this.responseText);
                  var temperatuur = weer.main.temp;
                  var bewolktheid = weer.clouds.all;

                  var blokje = document.querySelector("#temp");
                  blokje.innerHTML = 'Temperatuur: ' + temperatuur;

                  var blokje = document.querySelector("#cloud");
                  blokje.innerHTML = 'Bewolktheid: ' + bewolktheid + '%';
              }



              var oReq = new XMLHttpRequest();
              oReq.addEventListener("load", reqListener);
              oReq.open("GET", "http://api.openweathermap.org/data/2.5/weather?q=Papendrecht&APPID=f6cf9006e97a2ad5e1a4c92f6d3b449f&units=metric");
              oReq.send();



          </script>



      <script>
          $(document).ready(function(){
              $(".myAnchor").click(function(event){
                  event.preventDefault();
              });
          });
      </script>

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