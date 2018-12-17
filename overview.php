<?Php

require_once "./includes/database.php";

$query =   "SELECT appointment.*, customer.*
FROM appointment, customer, appointment_customer
WHERE appointment.AppointmentId = appointment_customer.AppointmentId
AND customer.CustomerId = appointment_customer.CustomerId";

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

    
      
        <aside id="nav">
          <ul>
            <li class="active"> <i class="far fa-list-ul fa-1x" style="color: F49100"></i> Overzicht</li>
            <li class="bottom"> <i class="fal fa-sign-out-alt fa-1x" style="color: black"></i> Uitloggen</li>
          </ul>
        </aside>

          <section id="view">

            <div class="header">

              <h3>Overzicht van alle afspraken</h3>
            </div>

<?php
              foreach ($appointments as $key => $appointment) { ?>
                  <a href="detailpagina.php?id=<?= $appointment['AppointmentId']; ?>"> <div class=" appointment">
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
                          <?php
                          echo $appointment['FirstName'];  echo $appointment['LastName'];
                          ?>
                      </p>
                      <i class="far fa-trash-alt"></i>
                      <i class="far fa-edit"></i>
                  </div> </a>
              <?php    } ?>












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