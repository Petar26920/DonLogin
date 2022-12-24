<?php

// import objekta konekcije
require_once "connection.php";
// podacii korisnika
$korisnicko = $_POST['nUser'] ?? "Anonimus";
$email = $_POST['nEmail'] ?? "";
$password = $_POST['nPass'] ?? "";
$passwordProvera = $_POST['nPass2']??"NaN";

if($password !== $passwordProvera){
    die("Sifre nisu iste...");
}


//validacija podataka
$korisnicko = filter_var($korisnicko, FILTER_SANITIZE_STRING);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("<h2>EMAIL nije dobar!!!</h2>");
}
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
    die("Password nije dobar! Morate imati mala slova, velika slova, brojke i spec karaktere #,@ i$");
}

$password = sha1($password . "@#%tt180"); //pass sa dodatkom

// insert to db
$stmt = $conn->prepare("INSERT INTO `korisnici` (`id`, `username`, `password`, `role`, `ts`, `email`) 
                        VALUES (NULL, ?, ?, 'sub', current_timestamp(), ?)");

//povezivanje podataka sa pripremljenim upitom
$stmt->bind_param("sss", $korisnicko, $password, $email);

//naredba za upis u bazu i provera
if ($stmt->execute()) {
    echo "<h2>Uspesno ste se registrovali!<h2>";
} else {
    die("Greska:" . $conn->error);
}
