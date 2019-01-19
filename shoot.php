<?php

require_once "./includes/database.php";
$AppointmentId = $_GET['id'];

if(isset($_POST['submit'])){

    $FirstName = mysqli_real_escape_string($db, $_POST['FirstName']);
    $LastName = mysqli_real_escape_string($db, $_POST['LastName']);
    $FirstName1 = mysqli_real_escape_string($db, $_POST['FirstName1']);
    $LastName1 = mysqli_real_escape_string($db, $_POST['LastName1']);
    $Email = mysqli_real_escape_string($db, $_POST['Email']);
    $Mobilenumber = mysqli_real_escape_string($db, $_POST['Mobilenumber']);
    $AppointmentId = $_POST['id'];
    $Emailv = mysqli_real_escape_string($db, $_POST['Emailv']);
    $Type = $_POST['Type'];


    require_once "./includes/formval.php";

if (empty($errors)) {

    $query = "UPDATE `appointment` SET `Type`='$Type' WHERE AppointmentId = $AppointmentId";

    $result = mysqli_query($db, $query)
    or die('Error: ' . $query);

    $query1 = "INSERT INTO `customer`(`FirstName`, `LastName`) VALUES ('$FirstName','$LastName')";

    $result = mysqli_query($db, $query1)
    or die('Error: ' . $query1);

    $customer1 = mysqli_insert_id($db);

    $query2 = "INSERT INTO `customer`(`FirstName`, `LastName`) VALUES ('$FirstName1','$LastName1')";

    $result2 = mysqli_query($db, $query2)
    or die('Error: ' . $query2);

    $customer2 = mysqli_insert_id($db);

    $query3 = "INSERT INTO `contactinfo`( `AppointmentId`, `Mobilenumber`, `Email`) VALUES ('$AppointmentId',$Mobilenumber,'$Email')";

    $result3 = mysqli_query($db, $query3)
    or die('Error: ' . $query3);

    $query4 = "INSERT INTO `appointment_customer`(`AppointmentId`, `CustomerId`) VALUES ('$AppointmentId','$customer1')";

    $result4 = mysqli_query($db, $query4)
    or die('Error: ' . $query4);

    $query5 = "INSERT INTO `appointment_customer`(`AppointmentId`, `CustomerId`) VALUES ('$AppointmentId','$customer2')";

    $result5 = mysqli_query($db, $query5)
    or die('Error: ' . $query5);


    if ($result5) {
        $url = "datepicker.php?id=$AppointmentId";
        header("Location: " . $url);
        exit;
    } else {
        $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
    }
    //Close connection
    mysqli_close($db);

}
}

if(isset($_POST['submit2'])){

    $FirstName = mysqli_real_escape_string($db, $_POST['FirstName']);
    $LastName = mysqli_real_escape_string($db, $_POST['LastName']);
    $Email = mysqli_real_escape_string($db, $_POST['Email']);
    $Mobilenumber = mysqli_real_escape_string($db, $_POST['Mobilenumber']);
    $NumberOfPeople = mysqli_real_escape_string($db, $_POST['NumberOfPeople']);
    $AppointmentId = $_POST['id'];
    $Emailv = mysqli_real_escape_string($db, $_POST['Emailv']);
    $Type = $_POST['Type'];



    require_once "./includes/formvalshoot.php";

    if (empty($errors)) {
        $query = "UPDATE `appointment` SET `Type`='$Type' WHERE AppointmentId = $AppointmentId";

        $result = mysqli_query($db, $query)
        or die('Error: ' . $query);

        $query1 = "INSERT INTO `customer`(`FirstName`, `LastName`) VALUES ('$FirstName','$LastName')";

        $result = mysqli_query($db, $query1)
        or die('Error: ' . $query1);

        $customer1 = mysqli_insert_id($db);



        $query3 = "INSERT INTO `contactinfo`( `AppointmentId`, `Mobilenumber`, `Email`) VALUES ('$AppointmentId',$Mobilenumber,'$Email')";

        $result3 = mysqli_query($db, $query3)
        or die('Error: ' . $query3);

        $query4 = "INSERT INTO `appointment_customer`(`AppointmentId`, `CustomerId`) VALUES ('$AppointmentId','$customer1')";

        $result4 = mysqli_query($db, $query4)
        or die('Error: ' . $query4);



        $query6 = "UPDATE `appointment` SET `NumberOfPeople`='$NumberOfPeople' WHERE AppointmentId = $AppointmentId";

        $result6 = mysqli_query($db, $query6)
        or die('Error: ' . $query6);


        if ($result6) {
            $url = "datepicker.php?id=$AppointmentId";
            header("Location: " . $url);
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }
        //Close connection
        mysqli_close($db);

    }
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
    <section id="intake">

        <aside id="progress">
            <ul>
                <li class="active">Gegevens</li>
                <li>Datum</li>
            </ul>
        </aside>

        <section id="form">

            <h3> Plan hier een afspraak in <br> voor uw fotoshoot </h3>

            <h3> Kies een soort fotoshoot </h3>

            <select class="form-control" onchange="changeOptions(this)">
                <option selected="">...</option>
                <option value="form_1">Loveshoot</option>
                <option value="form_2">Familyshoot</option>
            </select>

            <form action="" method="post" class="className" name="form_1" id="form_1" style="display:none"  >



                <h5> Vul onderstaande gegevens in. </h5>
                <h6> Persoon 1</h6>
                <div class="form-row">
                    <div class="col">
                        <input type="text" name="FirstName" class="form-control" placeholder="Voornaam">
                        <span class="error"><?= isset($errors['FirstName']) ? $errors['FirstName'] : '' ?></span>
                    </div>
                    <div class="col">
                        <input type="text" name="LastName" class="form-control" placeholder="Achternaam">
                        <span class="error"><?= isset($errors['LastName']) ? $errors['LastName'] : '' ?></span>

                    </div>
                </div>

                <h6> Persoon 2</h6>
                <div class="form-row">
                    <div class="col">
                        <input type="text" name="FirstName1" class="form-control" placeholder="Voornaam">
                        <span class="error"><?= isset($errors['FirstName1']) ? $errors['FirstName1'] : '' ?></span>

                    </div>
                    <div class="col">
                        <input type="text" name="LastName1" class="form-control" placeholder="Achternaam">
                        <span class="error"><?= isset($errors['LastName1']) ? $errors['LastName1'] : '' ?></span>

                    </div>
                </div>

                <h6> Contactgegevens</h6>
                <div class="form-group">

                    <input type="text" name="Mobilenumber" class="form-control" id="formGroupExampleInput" placeholder="Mobiele nummer">
                    <span class="error"><?= isset($errors['Mobilenumber']) ? $errors['Mobilenumber'] : '' ?></span>

                </div>

                <div class="form-group">

                    <input type="email" name="Email" class="form-control" id="formGroupExampleInput" placeholder="E-mailadres">
                    <span class="error"><?= isset($errors['Email']) ? $errors['Email'] : '' ?></span>

                </div>

                <div class="form-group">

                    <input type="email" name="Emailv" class="form-control" id="formGroupExampleInput" placeholder="Herhaal E-mailadres">
                    <span class="error"><?= isset($errors['Emailv']) ? $errors['Emailv'] : '' ?></span>

                </div>


                <input type="hidden" name="id" value="<?= $AppointmentId; ?>"/>
                <input type="hidden" name="Type" value="Loveshoot"/>

                <button type="submit" name="submit" class="btn btn-primary">VOLGENDE</button>
                <button type="submit" name="cancel" class="btn btn-secondary">ANNULEREN</button>

            </form>

            <form action="" method="post" class="className" name="form_2" id="form_2" style="display:none"  >
                <h5> Vul onderstaande gegevens in. </h5>
                <h6> Persoon 1</h6>
                <div class="form-row">
                    <div class="col">
                        <input type="text" name="FirstName" class="form-control" placeholder="Voornaam">
                        <span class="error"><?= isset($errors['FirstName']) ? $errors['FirstName'] : '' ?></span>

                    </div>
                    <div class="col">
                        <input type="text" name="LastName" class="form-control" placeholder="Achternaam">
                        <span class="error"><?= isset($errors['LastName']) ? $errors['LastName'] : '' ?></span>

                    </div>
                </div>

                <h6> Contactgegevens</h6>
                <div class="form-group">

                    <input type="text" name="Mobilenumber" class="form-control" id="formGroupExampleInput" placeholder="Mobiele nummer">
                    <span class="error"><?= isset($errors['Mobilenumber']) ? $errors['Mobilenumber'] : '' ?></span>

                </div>

                <div class="form-group">

                    <input type="email" name="Email" class="form-control" id="formGroupExampleInput" placeholder="E-mailadres">
                    <span class="error"><?= isset($errors['Email']) ? $errors['Email'] : '' ?></span>

                </div>

                <div class="form-group">

                    <input type="email" name="Emailv" class="form-control" id="formGroupExampleInput" placeholder="Herhaal E-mailadres">
                    <span class="error"><?= isset($errors['Emailv']) ? $errors['Emailv'] : '' ?></span>

                </div>

                <div class="form-group">

                    <input type="number" name="NumberOfPeople" class="form-control" id="formGroupExampleInput" placeholder="Aantal personen">
                    <span class="error"><?= isset($errors['NumberOfPeople']) ? $errors['NumberOfPeople'] : '' ?></span>

                </div>

                <input type="hidden" name="Type" value="Familyshoot"/>

                <input type="hidden" name="id" value="<?= $AppointmentId; ?>"/>

                <button type="submit" name="submit2" class="btn btn-primary">VOLGENDE</button>
                <button type="submit" name="cancel" class="btn btn-secondary">ANNULEREN</button>

            </form>

        </section>
    </section>
</div>

<script>
    $('.input').dateDropper();
</script>

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