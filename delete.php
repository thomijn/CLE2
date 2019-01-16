<?php
require_once "./includes/database.php";

$id = $_GET['id'];

$query = "SELECT * FROM `appointment_customer` WHERE AppointmentId = $id";

$result = mysqli_query($db, $query)
or die('Error' .mysqli_error($db).'<br>query:'. $query);


$customers = [];
While( $row = mysqli_fetch_assoc($result) ) {
    $customers[] = $row;
}



$customerid = $customers[0]['CustomerId'];
$customerid1 = $customers[1]['CustomerId'];



// sql to delete a record



$query4 = "DELETE FROM customer WHERE CustomerId=$customerid";

$query5 = "DELETE FROM customer WHERE CustomerId=$customerid1";

$query1 = "DELETE FROM appointment WHERE AppointmentId=$id";



$result4 = mysqli_query($db, $query4);

$result5 = mysqli_query($db, $query5);

$result1 = mysqli_query($db, $query1);

if ($result5) {
    header('Location: overview.php');
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($db);
    exit;
}

mysqli_close($db);
?>