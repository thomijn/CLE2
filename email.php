<?php

if(!isset($_GET['id'])){
    header("Location: choose.php");
}

require_once "./includes/database.php";

$AppointmentId = $_GET['id'];

$query =   "SELECT Email FROM contactinfo WHERE AppointmentId = $AppointmentId";

$query2 =  "SELECT DateTime FROM appointment WHERE AppointmentId = $AppointmentId";

$result = mysqli_query($db, $query)
or die('Error' .mysqli_error($db).'<br>query:'. $query);

$result2 = mysqli_query($db, $query2)
or die('Error' .mysqli_error($db).'<br>query:'. $query2);


$DateTime= mysqli_fetch_assoc($result2);

$email = mysqli_fetch_assoc($result);

if(!isset($_GET['id'])) {

    header('Location: choose.php');

}

//php mailer


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
                                     // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'gertenbachthomas@gmail.com';      // SMTP username
    $mail->Password = '3355bn56';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('gertenbachthomas@gmail.com', 'Fotografie gertenbach');
    $mail->addAddress($email['Email']);     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Afspraak Fotografie Gertenbach ';
    $mail->Body    = "<h1>Uw afspraak is doorgegeven aan Fotografie gertenbach</h1>";

    

    $mail->AltBody = 'Dit is een test';

    $mail->send();

} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
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
            <div class="email">
            <h3 > Een bevestings email is verstuurd naar: </h3>

            <p style="font-weight: bold;"><?= $email['Email'] ?></p>
</div>
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