<?php

$AppointmentId = $_GET['id'];

if (isset($_POST['submit'])) {


    $originalDate2 = $_POST['DateTime'];
    $date = new DateTime($originalDate2);
    $newDate = $date->format('Y-m-d');
    $AppointmentId = $_POST['id'];

    $url = "confirm.php?id=$AppointmentId&DateTime=$newDate";
    header("Location: ".$url);

}

if(!isset($_GET['id'])) {

    header('Location: choose.php');

}

if(isset($_POST['cancel'])){

    require_once "./includes/database.php";


    $query = "DELETE FROM appointment WHERE AppointmentId=$AppointmentId";

    $result = mysqli_query($db, $query);
    header('Location: choose.php');

    //Close connection
    mysqli_close($db);

}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS and Fontawesome -->
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
        <section id="intake">

            <aside id="progress">
                <ul>
                    <li>Gegevens <i class="far fa-check fa-2x" style="color: 5AC345"></i> </li>
                    <li class="active">Datum</li>
                </ul>
            </aside>

            <section id="form">
                <h3> Plan hier een gesprek in <br> voor uw bruiloftsfotografie </h3>


                <form action="" method="post">
                    <h5> Kies een datum voor het intake gesprek </h5>
                    <div class="form-group">
                        <input type="text" name="DateTime" data-lock="from" data-max-year="2030" data-format="d-m-Y" data-disabled-days="12/11/2018" data-lang="nl"
                            data-large-mode="true" data-modal="true" data-large-default="true" data-theme="datedropperstyle"
                            class="input" id="formGroupExampleInput">
                    </div>

                    <p>Jouw gekozen datum is: </p>
                    <input type="hidden" name="id" value="<?= $AppointmentId; ?>"/>
                    <button type="submit" name="submit" class="btn btn-primary">VOLGENDE</button>
                    <button type="cancel" name="cancel" class="btn btn-secondary">ANNULEREN</button>


                </form>

            </section>
        </section>
    </div>

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