<?php
// login procces, checks is user exists and password is correct

if(isset($_SESSION['logged_in'])) {
    // already logged in
    header('Location: overview.php');
    exit;
}

require_once "./includes/database.php";

//Escape email to protect against SQL injections
$email = mysqli_escape_string($db, $_POST['email']);
$password = $_POST['password'];

$hashedpwdindb = password_hash("phdrie05", PASSWORD_DEFAULT);

$query = "SELECT * FROM admin WHERE email='$email'";

$result = mysqli_query($db, $query)
or die('Error' .mysqli_error($db).'<br>query:'. $query);



if ( mysqli_num_rows($result) == 0) { //user doesn't exist!

    $errors['email'] = 'Er is geen gebruiker met dit emailadres';


}
else { //user exists
    $user = mysqli_fetch_assoc($result);

    if ( password_verify($password, $hashedpwdindb) ) {



        //This is how we know if the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: overview.php");

    }
    else{
        $errors['password'] = 'Wachtwoord is onjuist';
    }
}