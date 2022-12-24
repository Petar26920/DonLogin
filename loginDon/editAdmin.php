<?php
    session_start();
    include_once("connection.php");
    if($_SESSION['privilegija']!='admin' || !isset($_SESSION)){
        header("Location: 404.html");
    }
    $stmt = $conn->prepare("UPDATE `korisnici` SET `role` = ? where username=?");
    $stmt->bind_param("ss",$_POST['nRole'],$_POST['nKorisnici']);
    $stmt->execute();
    header("Location:admin.php");
?>