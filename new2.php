<?php

session_start();

require_once "./includes/database.php";



if (isset($_POST['submit'])) {

    $AppointmentId = $_GET['id'];

    //Require database in this file & image helpers
    require_once "./includes/database.php";

    $AppointmentId = $_GET['id'];

    $originalDate2 = $_POST['Trouwdatum'];
    $date = new DateTime($originalDate2);
    $newDate = $date->format('Y-m-d');

    $FirstName = mysqli_real_escape_string($db, $_POST['FirstName']);
    $LastName = mysqli_real_escape_string($db, $_POST['LastName']);
    $FirstName1 = mysqli_real_escape_string($db, $_POST['FirstName1']);
    $LastName1 = mysqli_real_escape_string($db, $_POST['LastName1']);
    $Email = mysqli_real_escape_string($db, $_POST['Email']);
    $Mobilenumber = mysqli_real_escape_string($db, $_POST['Mobilenumber']);
    $Trouwdatum = mysqli_real_escape_string($db, $newDate);
    $AppointmentId = $_POST['id'];

    $query1 = "INSERT INTO `customer`(`FirstName`, `LastName`) VALUES ('$FirstName','$LastName')";

    $result = mysqli_query($db, $query1)
    or die('Error: '.$query1);

    $customer1 = mysqli_insert_id($db);

    $query2 = "INSERT INTO `customer`(`FirstName`, `LastName`) VALUES ('$FirstName1','$LastName1')";

    $result2 = mysqli_query($db, $query2)
    or die('Error: '.$query2);

    $customer2 = mysqli_insert_id($db);

    $query3 = "INSERT INTO `contactinfo`( `AppointmentId`, `Mobilenumber`, `Email`, `Trouwdatum`) VALUES ('$AppointmentId','$Mobilenumber','$Email','$Trouwdatum')";

    $result3 = mysqli_query($db, $query3)
    or die('Error: '.$query3);

    $query4 = "INSERT INTO `appointment_customer`(`AppointmentId`, `CustomerId`) VALUES ('$AppointmentId','$customer1')";

    $result4 = mysqli_query($db, $query4)
    or die('Error: '.$query4);

    $query5 = "INSERT INTO `appointment_customer`(`AppointmentId`, `CustomerId`) VALUES ('$AppointmentId','$customer2')";

    $result5 = mysqli_query($db, $query5)
    or die('Error: '.$query5);

    if ($result5) {
        $url = "overview.php";
        header("Location: ".$url);
        exit;
    } else {
        $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
    }
    //Close connection
    mysqli_close($db);

}

if(isset($_GET['id'])) {

    $AppointmentId = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT appointment.*
    FROM appointment
    WHERE AppointmentId = $AppointmentId";
    $result = mysqli_query($db, $query)
    or die('Error' .mysqli_error($db).'<br>query:'. $query);

    $appointment = [];
    While( $row = mysqli_fetch_assoc($result) ) {
        $appointment[] = $row;
    }

}

if(!isset($_GET['id'])) {

    header('Location: new.php');

}

if(!isset($_SESSION['logged_in'])) {
    // redirect to login page
    header('Location: adminlogin.php');
    exit;
}



if(isset($_POST['cancel'])){

    $query = "DELETE FROM appointment WHERE AppointmentId=$AppointmentId";

    $result = mysqli_query($db, $query);
    header('Location: overview.php');

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
            <h3>Detailpagina</php></h3>
        </div>

        <div class='appointmentheader';>

            <h2>Nieuwe afspraak aanmaken</h2>

        </div>

        <div class="newappointment">


            <?php
            if ($appointment[0]['Type'] == 'Marriage'){
                ?> <form class="className" name="form_1" id="form_1" method="post" action="">

                    <h5> Vul onderstaande gegevens in. </h5>
                    <h6> Partner 1</h6>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="FirstName" class="form-control" placeholder="Voornaam">
                        </div>
                        <div class="col">
                            <input type="text" name="LastName" class="form-control" placeholder="Achternaam">
                        </div>
                    </div>

                    <h6> Partner 2</h6>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="FirstName1" class="form-control" placeholder="Voornaam">
                        </div>
                        <div class="col">
                            <input type="text" name="LastName1" class="form-control" placeholder="Achternaam">
                        </div>
                    </div>

                    <h6> Contactgegevens</h6>
                    <div class="form-group">

                        <input type="text" name="Mobilenumber" class="form-control" id="formGroupExampleInput" placeholder="Mobiele nummer">
                    </div>

                    <div class="form-group">

                        <input type="text" name="Email" class="form-control" id="formGroupExampleInput" placeholder="E-mailadres">
                    </div>



                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Trouwdatum</label>
                        <div class="col-10">
                            <input  class="input" data-max-year="2030" name="Trouwdatum" data-format="d-m-Y" data-disabled-days="" data-lang="nl"
                                    data-large-mode="true" data-modal="true" data-large-default="true" data-theme="datedropperstyle" class="form-control" type="date" value="" id="example-date-input">
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?= $AppointmentId; ?>"/>
                    <button type="submit" name="submit" class="btn btn-primary">OPSLAAN</button>
                    <button type="submit" class="btn btn-secondary"><a href="choose.php" onclick="goBack()" >ANNULEREN</a></button>

                </form> <?php
            }
            else if ($appointment[0]['Type'] == 'Familyshoot') {
                ?> <form class="className" name="form_1" id="form_1" method="post" action="">

                    <h5> Vul onderstaande gegevens in. </h5>

                    <h6> Contactpersoon</h6>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="FirstName" class="form-control" placeholder="Voornaam">
                        </div>
                        <div class="col">
                            <input type="text" name="LastName" class="form-control" placeholder="Achternaam">
                        </div>
                    </div>

                    <h6> Contactgegevens</h6>
                    <div class="form-group">

                        <input type="text" name="Mobilenumber" class="form-control" id="formGroupExampleInput" placeholder="Mobiele nummer">
                    </div>

                    <div class="form-group">

                        <input type="text" name="Email" class="form-control" id="formGroupExampleInput" placeholder="E-mailadres">
                    </div>

                    <input type="hidden" name="id" value="<?= $AppointmentId; ?>"/>
                    <button type="submit" name="submit" class="btn btn-primary">OPSLAAN</button>
                    <button type="submit" class="btn btn-secondary"><a href="overview.php">ANNULEREN</a></button>

                </form> <?php
            }
            else {
                ?> <form class="className" name="form_1" id="form_1" method="post" action="">

                    <h5> Vul onderstaande gegevens in. </h5>
                    <h6> Partner 1</h6>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="FirstName" class="form-control" placeholder="Voornaam">
                        </div>
                        <div class="col">
                            <input type="text" name="LastName" class="form-control" placeholder="Achternaam">
                        </div>
                    </div>

                    <h6> Partner 2</h6>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" name="FirstName1" class="form-control" placeholder="Voornaam">
                        </div>
                        <div class="col">
                            <input type="text" name="LastName1" class="form-control" placeholder="Achternaam">
                        </div>
                    </div>

                    <h6> Contactgegevens</h6>
                    <div class="form-group">

                        <input type="text" name="Mobilenumber" class="form-control" id="formGroupExampleInput" placeholder="Mobiele nummer">
                    </div>

                    <div class="form-group">

                        <input type="text" name="Email" class="form-control" id="formGroupExampleInput" placeholder="E-mailadres">
                    </div>

                    <input type="hidden" name="id" value="<?= $AppointmentId; ?>"/>
                    <button type="submit" name="submit" class="btn btn-primary">OPSLAAN</button>
                    <button type="submit" name="cancel" class="btn btn-secondary">ANNULEREN</button>

                </form> <?php
            }
            ?>

        </div>





    </section>







    <script>
        function changeOptions(selectEl) {
            let selectedValue = selectEl.options[selectEl.selectedIndex].value;
            let subForms = document.getElementsByClassName('className')
            for (let i = 0; i < subForms.length; i += 1) {
                if (selectedValue === subForms[i].name) {
                    subForms[i].setAttribute('style', 'display:block')
                } else {
                    subForms[i].setAttribute('style', 'display:none')
                }
            }
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