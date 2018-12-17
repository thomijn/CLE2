<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Error</h1>

<p>
    <?php
    if(isset($_SESSION['message']) AND !empty($_SESSION['message']) ){
        echo $_SESSION['message'];
    }


    else {
        header("location : adminlogin.php");
    }
    ?>
</p>
<a href="adminlogin.php"><button class ="button button-block"/>Home</button></a>
</body>
</html>
