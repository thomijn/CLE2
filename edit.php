<?php

session_start();

require_once "./includes/database.php";



if(isset($_POST['submit']))
{

    // get values form input text and number
    $CustomerId  = $_POST['CustomerId'];
    $CustomerId1   = $_POST['CustomerId1'];
    $AppointmentId = $_POST['id'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $FirstName1 = $_POST['FirstName1'];
    $LastName1 = $_POST['LastName1'];
    $Mobilenumber = $_POST['Mobilenumber'];
    $Email = $_POST['Email'];
    $Trouwdatum = $_POST['Trouwdatum'];
    $Datum = $_POST['Datum'];
    $Type = $_POST['Type'];

    $appointment =
        [
            [
                'AppointmentId' => $AppointmentId,
                'Type' => $Type,
                'CustomerId' => $CustomerId ,
                'FirstName' => $FirstName,
                'LastName' => $LastName,
                'Email' => $Email,
                'Mobilenumber' => $Mobilenumber,
            ],
            [
                'FirstName' => $FirstName1,
                'LastName' => $LastName1,
            ]
];



    $query1 = "UPDATE Customer
              SET FirstName = '$FirstName', LastName = '$LastName'
              WHERE CustomerId = '$CustomerId'";

    $query2 = "UPDATE Customer
              SET FirstName = '$FirstName1', LastName = '$LastName1'
              WHERE CustomerId = '$CustomerId1'";

    $query3 = "UPDATE Contactinfo
              SET Mobilenumber = '$Mobilenumber', Email = '$Email' , Trouwdatum = '$Trouwdatum'
              WHERE AppointmentId = '$AppointmentId'";

    $query4 = "UPDATE Appointment
              SET DateTime = '$Datum'
              WHERE AppointmentId = '$AppointmentId'";



    $result = mysqli_query($db, $query1);
    $result2 = mysqli_query($db, $query2);
    $result3 = mysqli_query($db, $query3);
    $result4 = mysqli_query($db, $query4);
    if ($result AND $result2 AND $result3 AND $result4) {
        header('Location: overview.php');
        exit;
    } else {
        $errors[] = 'Something went wrong in your database query:' . mysqli_error($db);
    }

}

else if(isset($_GET['id'])) {

    $AppointmentId = $_GET['id'];

    //Get the record from the database result
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

} else {
    header('Location: overview.php');
    exit;

    mysqli_close($db);
}

if(!isset($_SESSION['logged_in'])) {
    // redirect to login page
    header('Location: adminlogin.php');
    exit;
}

$originalDate = $appointment[0]['Trouwdatum'];;
$originalDate2 = $appointment[0]['DateTime'];;


$date = new DateTime($originalDate);
$newDate = $date->format('m-d-Y'); // 31.07.2012

$date2 = new DateTime($originalDate2);
$newDate2 = $date2->format('m-d-Y'); // 31.07.2012
/*echo $newDate;
exit;*/
/*print_r($appointment);
exit;*/

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

    <!-- Datedropper -->
    <link href="./css/datedropper.css" rel="stylesheet" type="text/css" />
    <link href="./css/datedropperstyle.css" rel="stylesheet" type="text/css" />
    <script src="./css/jquery.js"></script>
    <script src="./css/datedropper.js"></script>

    <link rel="stylesheet" href="./css/bulma.css">

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


        <div class="newappointment">

        <form action="edit.php" method="post" class="className" name="form_1" id="form_1" >

            <h5> Vul onderstaande gegevens in. </h5>
            <h6> Partner 1</h6>
            <div class="form-row">
                <div class="col">
                    <input type="text" name="FirstName" class="form-control" value="<?= $appointment[0]['FirstName']; ?>">
                </div>
                <div class="col">
                    <input type="text" name="LastName" class="form-control" value="<?= $appointment[0]['LastName']; ?>">
                </div>
            </div>

            <h6> Partner 2</h6>
            <div class="form-row">
                <div class="col">
                    <input type="text" name="FirstName1" class="form-control" value="<?= $appointment[1]['FirstName']; ?>">
                </div>
                <div class="col">
                    <input type="text" name="LastName1" class="form-control" value="<?= $appointment[1]['LastName']; ?>">
                </div>
            </div>

            <h6> Contactgegevens</h6>
            <div class="form-group">

                <input type="text" name="Mobilenumber" class="form-control" id="formGroupExampleInput" value="<?= $appointment[0]['Mobilenumber']; ?>">
            </div>

            <div class="form-group">

                <input type="text" name="Email" class="form-control" id="formGroupExampleInput" value="<?= $appointment[0]['Email']; ?>">
            </div>


        <?php

        if ($appointment[0]['Type'] == 'Marriage'){
            ?> <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">Trouwdatum</label>
                <div class="col-10">
                    <input  class="input" name="Trouwdatum" data-format="Y-m-d" data-disabled-days="" data-lang="nl"
                            data-large-mode="true" data-modal="true" data-large-default="true" data-theme="datedropperstyle" class="form-control" type="date" data-default-date="<?= $newDate ?>" id="example-date-input">
                </div>
            </div>  <?php
        }

        ?>

            <div class="form-group row">
                <label for="example-text-input" class="col-2 col-form-label">datum</label>
                <div class="col-10">
                    <input class="input" name="Datum" data-format="Y-m-d" data-disabled-days="" data-lang="nl"
                           data-large-mode="true" data-modal="true" data-large-default="true" data-theme="datedropperstyle" data-default-date="<?= $newDate2 ?>" type="date" value="" id="example-date-input">
                </div>
            </div>

            <input name="CustomerId" type="hidden" value="<?= $appointment[0]['CustomerId']; ?>"/>
            <input name="CustomerId1" type="hidden" value="<?= $appointment[1]['CustomerId']; ?>"/>
            <input name="Type" type="hidden" value="<?= $appointment[1]['Type']; ?>"/>
            <input type="hidden" name="id" value="<?= $AppointmentId; ?>"/>

            <button type="submit" name="submit" class="btn btn-primary">OPSLAAN</button>
            <button type="submit" name="cancel" class="btn btn-secondary"><a href="overview.php">ANNULEREN</a></button>

        </form>

        </div>

    </section>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>


    <script>
        $('.input').dateDropper();
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