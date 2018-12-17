<?php
// login procces, checks is user exists and password is correct

require_once "./includes/database.php";

//Escape email to protect against SQL injections
$email = mysqli_escape_string($db, $_POST['email']);

$query = "SELECT * FROM admin WHERE email='$email'";

$result = mysqli_query($db, $query)
or die('Error' .mysqli_error($db).'<br>query:'. $query);



if ( mysqli_num_rows($result) == 0) { //user doesn't exist!
    $_SESSION['message'] = "There is no user with that email!";
    header("location: error.php");

}
else { //user exists
    $user = mysqli_fetch_assoc($result);

    if ( $_POST['password'] == $user['Password'] ) {

        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $user['password'];

        //This is how we know if the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: overview.php");

    }
    else{
        $_SESSION['message'] = "You have entered the wrong password, try again!";
        header("location: error.php");
    }
}