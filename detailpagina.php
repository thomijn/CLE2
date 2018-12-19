<?php

require_once "./includes/database.php";

$AppointmentId = $_GET['id'];

$query = "SELECT appointment.*, customer.*, contactinfo.*
FROM appointment, customer, appointment_customer, contactinfo
WHERE appointment.AppointmentId = appointment_customer.AppointmentId
AND customer.CustomerId = appointment_customer.CustomerId
AND contactinfo.AppointmentId = appointment.AppointmentId
AND appointment.AppointmentId = $AppointmentId";

$result = mysqli_query($db, $query)
or die('Error' .mysqli_error($db).'<br>query:'. $query);

$appointment = [];
While( $row = mysqli_fetch_assoc($result) ) {
    $appointment[] = $row;
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
            <a onclick="goBack()"><i class="far fa-angle-left fa-2x"></i></a>
            <h3>Detailpagina</php></h3>
        </div>

        <div class='appointmentheader';>

            <?php
            if ($appointment[0]['Type'] == 'Marriage'){
            ?> <i class="fal fa-comments fa-3x" style="color: #F49100"></i> <?php
            }
            else {
            ?> <i class="fal fa-camera-alt fa-3x" style="color: #F49100"></i> <?php
            }
            ?>
            <h2><?php if($appointment[0]['Type'] =='Marriage'){
                echo 'Intake gesprek';
                } else if ($appointment[0]['Type'] =='Loveshoot') {
                    echo 'loveshoot';
                } else{
                    echo 'familyshoot';
                }; ?></h2>
        </div>

        <div class="appointmentdetail">
            <label for="">Datum:</label> <?= date(" d-m-Y ", strtotime($appointment[0]['DateTime'])) ?> <br>
            <label for="">Aantal personen:</label> <?= $appointment[0]['NumberOfPeople']; ?> <br>

            <h5>contactgegevens:</h5>
            <label for="">Parter 1</label> <?= $appointment[0]['FirstName']; ?> <?= $appointment[0]['LastName']; ?>  <br>
            <label for="">Partner 2</label> <?= $appointment[1]['FirstName']; ?> <?= $appointment[1]['LastName']; ?>  <br>
            <label for="">Mobiele nummer:</label> <?= $appointment[0]['Mobilenumber']; ?> <br>
            <label for="">Email:</label> <?= $appointment[0]['Email']; ?>



        </div>


    </section>









    <script>
        function goBack() {
            window.history.back();
        }
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