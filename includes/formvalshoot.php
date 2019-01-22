<?php
//Check if data is valid & generate error if not so
$errors = [];
if (!$Emailv == $Email) {
    $errors['Emailv'] = 'Email-adres is niet hetzelfde';
}

if ($FirstName == '') {
    $errors['FirstName'] = 'Dit is een verplicht veld';
}

if ($LastName == '') {
    $errors['LastName'] = 'Dit is een verplicht veld';
}


if (!is_numeric($Mobilenumber )) {
    $errors['Mobilenumber'] = 'Dit is geen juist telefoonnummer';
}

if (strlen($Mobilenumber) < 10) {
    $errors['Mobilenumber'] = 'Dit telefoonnummer bevat niet genoeg cijfers';
}

if ($Mobilenumber == '') {
    $errors['Mobilenumber'] = 'Dit is een verplicht veld';
}

if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    $errors['Email'] = 'Dit is geen juist Email-adres';
}

if ($Email == '') {
    $errors['Email'] = 'Dit is een verplicht veld';
}

if ($Emailv == '') {
    $errors['Emailv'] = 'Dit is een verplicht veld';
}

if (!is_numeric($NumberOfPeople )) {
    $errors['NumberOfPeople'] = 'Dit is geen juist Aantal';
}

if ($NumberOfPeople == '') {
    $errors['NumberOfPeople'] = 'Dit is een verplicht veld';
}

