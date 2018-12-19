<?php

require_once "./includes/database.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) { //user is logging in
        require 'login.php';
    }
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
    <section id="login">
        <div class="containerhome" class="home">
            <div class="card-center">

                <div class="title">
                    <img src="./css/logo.png" alt="">
                </div>
                <h3> Admin Login </h3>
                <form class="login" action="adminlogin.php" method="POST">

                    <div class="form-group">
                        <span class="error"><?= isset($errors['email']) ? $errors['email'] : ''; ?></span>
                        <input type="email" name="email" class="form-control" placeholder="Gebruikersnaam" aria-label="Username">
                    </div>
                    <div class="form-group">
                        <span class="error"><?= isset($errors['password']) ? $errors['password'] : ''; ?></span>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Wachtwoord">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Log in
                    </button>

                    <p><a href="">Wachtwoord vergeten?</a></p>

                </form>

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