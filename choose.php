<?php

require_once "./includes/database.php";

if(isset($_POST['Marriage'])){

    $Type = mysqli_real_escape_string($db, $_POST['Type']);

    $query = "INSERT INTO `appointment`( `Type` ) VALUES ('$Type')";
    $result = mysqli_query($db, $query)
    or die('Error: '.$query);

    $last_id = mysqli_insert_id($db);

    $url = "intake.php?id=$last_id";
    header("Location: ".$url);
}

if(isset($_POST['Shoot'])){

    $Type = mysqli_real_escape_string($db, $_POST['Type']);

    $query = "INSERT INTO `appointment`( `Type` ) VALUES ('$Type')";
    $result = mysqli_query($db, $query)
    or die('Error: '.$query);

    $last_id = mysqli_insert_id($db);

    $url = "shoot.php?id=$last_id";
    header("Location: ".$url);
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
    <div class="middle-logo">
        <img src="./css/logo.jpg" alt="" width="100" height="100">
    </div>
    <section id="choose">
        <div class="containerhome" class="home ">
            <div class="card-center">
                <h3> Welkom op de reserveerpagina van </h3>
                <div class="title">
                    <img src="./css/logo.png" alt="">
                </div>
                <p> Kies hier wat voor soort afspraak je wilt plannen </p>
                <div class="row" class="d-flex justify-content-center">
                    <form action="" method="post">
                    <div class="col-sm-6">
                            <div class="card">

                                <button type="submit" name="Marriage" class="btn btn-primary">
                                    <input name="Type" type="hidden" value="Marriage"/>
                                    <div class="card-body">
                                    <i class="fal fa-comments fa-3x" style="color: #F49100"></i>
                                    <h5 class="card-title">Intake gesprek</h5>
                                </div>
                                </button>
                            </div>
                    </form>
                    </div>
            </div>
                <form action="" method="post">
                    <div class="col-sm-6">
                        <input type="hidden" name="id" value="<?= $AppointmentId; ?>"/>
                        <div  name="shoot" class="card">
                            <button type="submit" name="Shoot" class="btn btn-primary">
                                <div class="card-body">
                                    <i class="fal fa-camera-alt fa-3x" style="color: #F49100"></i>
                                    <h5 class="card-title">Fotoshoot</h5>
                                </div>
                        </div>
                    </button>
                    </div>
                </form>

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