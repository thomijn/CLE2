<?php

if(!isset($_GET['id'])){
    header("Location: choose.php");
}

$AppointmentId = $_GET['id'];
$DateTime= $_GET['DateTime'];

require_once "./includes/database.php";

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


if (isset($_POST['submit'])) {
    $query = "UPDATE `appointment` SET `DateTime`='$DateTime' WHERE AppointmentId = $AppointmentId";

    $result = mysqli_query($db, $query)
    or die('Error: '.$query);

    if ($result) {
        $url = "email.php?id=$AppointmentId";
        header("Location: ".$url);
        exit;
    } else {
        $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
    }
    //Close connection
    mysqli_close($db);

}

if (isset($_POST['cancel'])){

    $query3 = "SELECT * FROM `appointment_customer` WHERE AppointmentId = $AppointmentId";
    $query4 = "SELECT * FROM `appointment` WHERE AppointmentId = $AppointmentId";


    $result4 = mysqli_query($db, $query4)
    or die('Error' .mysqli_error($db).'<br>query:'. $query4);

    $result3 = mysqli_query($db, $query3)
    or die('Error' .mysqli_error($db).'<br>query:'. $query3);


    $customers = [];
    While( $row = mysqli_fetch_assoc($result3) ) {
        $customers[] = $row;
    }

    $appointments = [];
    While( $row = mysqli_fetch_assoc($result4) ) {
        $appointments[] = $row;
    }



    if ($appointments[0]['Type'] == 'Familyshoot') {

        $AppointmentId = $_GET['id'];

        $customerid = $customers[0]['CustomerId'];

// sql to delete a record
        $query4 = "DELETE FROM customer WHERE CustomerId=$customerid";



        $query1 = "DELETE FROM appointment WHERE AppointmentId=$AppointmentId";



        $result4 = mysqli_query($db, $query4);



        $result1 = mysqli_query($db, $query1);

        if ($result4) {
            header('Location: choose.php');
            exit;
        } else {
            echo "Error deleting record: " . mysqli_error($db);
            exit;
        }

        mysqli_close($db);
    }

    else {
        $customerid = $customers[0]['CustomerId'];
        $customerid1 = $customers[1]['CustomerId'];

// sql to delete a record
        $query4 = "DELETE FROM customer WHERE CustomerId=$customerid";

        $query5 = "DELETE FROM customer WHERE CustomerId=$customerid1";

        $query1 = "DELETE FROM appointment WHERE AppointmentId=$AppointmentId";



        $result4 = mysqli_query($db, $query4);

        $result5 = mysqli_query($db, $query5);

        $result1 = mysqli_query($db, $query1);

        if ($result5) {
            header('Location: choose.php');
            exit;
        } else {
            echo "Error deleting record: " . mysqli_error($db);
            exit;
        }

        mysqli_close($db);
    }
}


if(!isset($_GET['id'])) {

    header('Location: choose.php');

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
                <li>Datum <i class="far fa-check fa-2x" style="color: 5AC345"></i> </li>
            </ul>
        </aside>

        <section id="form">
            <h3> Bevestig uw reservering </h3>

            <?php
             if ($appointment[0]['Type'] == 'Familyshoot'){
                   ?> <div class="confirmdetail">

                     <label for="">Datum:</label> <?= date(" d-m-Y ", strtotime($appointment[0]['DateTime'])) ?> <br>
                     <label for="">Aantal personen:</label> <?= $appointment[0]['NumberOfPeople']; ?> <br>

                     <h5>contactgegevens:</h5>
                     <label for="">Contactpersoon</label> <?= $appointment[0]['FirstName']; ?> <?= $appointment[0]['LastName']; ?>  <br>

                     <label for="">Mobiele nummer:</label> <?= $appointment[0]['Mobilenumber']; ?> <br>
                     <label for="">Email:</label> <?= $appointment[0]['Email']; ?>

                     <form action="" method="post">
                         <input type="hidden" name="id" value="<?= $DateTime; ?>"/>
                         <input type="hidden" name="id" value="<?= $AppointmentId; ?>"/>
                         <button type="submit" name="submit" class="btn btn-primary">OPSLAAN</button>
                         <button type="submit" name="cancel" class="btn btn-secondary">ANNULEREN</button>

                     </form>
                 </div> <?php

             }
             else                                      {
                   ?> <div class="confirmdetail">

                     <label for="">Datum:</label> <?= date(" d-m-Y ", strtotime($appointment[0]['DateTime'])) ?> <br>
                     <label for="">Aantal personen:</label> <?= $appointment[0]['NumberOfPeople']; ?> <br>

                     <h5>contactgegevens:</h5>
                     <label for="">Parter 1</label> <?= $appointment[0]['FirstName']; ?> <?= $appointment[0]['LastName']; ?>  <br>
                     <label for="">Partner 2</label> <?= $appointment[1]['FirstName']; ?> <?= $appointment[1]['LastName']; ?>  <br>
                     <label for="">Mobiele nummer:</label> <?= $appointment[0]['Mobilenumber']; ?> <br>
                     <label for="">Email:</label> <?= $appointment[0]['Email']; ?>

                     <form action="" method="post">
                         <input type="hidden" name="id" value="<?= $DateTime; ?>"/>
                         <input type="hidden" name="id" value="<?= $AppointmentId; ?>"/>
                         <button type="submit" name="submit" class="btn btn-primary">OPSLAAN</button>
                         <button type="cancel" name="cancel" class="btn btn-secondary">ANNULEREN</button>
                     </form>
                 </div> <?php

             }
                      ?>



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