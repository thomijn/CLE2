<?php

session_start();

if (isset($_POST['submit'])) {

    require_once "./includes/database.php";


    $originalDate2 = $_POST['DateTime'];
    $date = new DateTime($originalDate2);
    $newDate = $date->format('Y-m-d');

    $Type = mysqli_real_escape_string($db, $_POST['Type']);
    $DateTime = mysqli_real_escape_string($db, $newDate);
    $NumberOfPeople = mysqli_real_escape_string($db, $_POST['NumberOfPeople']);





    $query = "INSERT INTO `appointment`( `Type`, `DateTime`, `NumberOfPeople`) VALUES ('$Type','$DateTime','$NumberOfPeople')";

    $result = mysqli_query($db, $query)
    or die('Error: '.$query);

    $last_id = mysqli_insert_id($db);




    if ($result) {
        $url = "new2.php?id=$last_id";
        header("Location: ".$url);
        exit;
    } else {
        $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
    }
    //Close connection
    mysqli_close($db);

}


if(!isset($_SESSION['logged_in'])) {
    // redirect to login page
    header('Location: adminlogin.php');
    exit;
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
            <a onclick="goBack()"><i class="far fa-angle-left fa-2x"></i></a>
            <h3>Detailpagina</php></h3>
        </div>





        <div class="newappointment">

            <div class='appointmentheader';>
                <h2>Nieuwe afspraak aanmaken</h2>
            </div>

            <h5>Kies een soort afspraak</h5>


            <form method="post" action="new.php">

                <div class="form-group">
                    <select name="Type" class="form-control" id="sel1" ">
                    <option name="Intake" value="Intake">Intake</option>
                    <option name="Familyshoot" value="Familyshoot">Familyshoot</option>
                    <option name="Loveshoot" value="Loveshoot">Loveshoot</option>
                    </select>

                    <div class="form-group row">
                        <label style="font-weight: bold" class="col-1 col-form-label">Datum:</label>
                        <div class="col-7">
                            <input class="input" data-lock="from" data-max-year="2030" name="DateTime" data-format="d-m-Y" data-disabled-days="" data-lang="nl"
                                   data-large-mode="true" data-modal="true" data-large-default="true" data-theme="datedropperstyle"  type="date" value="" id="example-date-input">
                        </div>
                            <div class="col-4">
                                <input type="number"  name="NumberOfPeople" class="form-control" placeholder="Aantal personen (standaard 2)">
                            </div>

                    </div>





                    <button type="submit" name="submit" class="btn btn-primary">VOLGENDE</button>
            </form>

        </div>

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