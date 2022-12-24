<?php

session_start();


// import objekta konekcije
require_once "connection.php";
// podacii korisnika
$korisnicko = $_POST['nUser'] ?? "Anonimus";
$password = $_POST['nPass'] ?? "";

$korisnicko = filter_var($korisnicko, FILTER_SANITIZE_STRING);
$password = sha1($password . "@#%tt180");

//priprema sql izraza
$stmt = $conn->prepare("select * from korisnici where username=? and password=?");
$stmt->bind_param("ss", $korisnicko, $password);

if (!$stmt->execute()) {
    die("Greska: " . $conn->error);
}


$rez = $stmt->get_result();

if (!$podaci = $rez->fetch_assoc()) {
    die ("Korisnik ne postoji!");
}

$_SESSION['user']=$podaci['username'];
$_SESSION['email']=$podaci['email'];
$_SESSION['vreme']=$podaci['ts'];
$_SESSION['privilegija']=$podaci['role'];
if($podaci['role']=='sub'){
    //header("Location:substranica.php?gKorisnik=".$podaci['username']);// moze biti i sesija ali se ne koristi posto je kreiranja
    header("Location:substranica.php");
}

if($podaci['role']=='admin')
{
    header("Location:admin.php");
}

echo "<pre>";
var_dump($podaci);
echo "</pre>";
