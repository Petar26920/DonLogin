<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
 
<body>
    <?php
    session_start();
    include_once "connection.php";
 
    if($_SESSION['privilegija']!=='admin' || !isset($_SESSION)){
        header("Location:404.html");
    }
 
    echo "<h2>Dobrodosli: " . $_SESSION['user'] . "</h2>";
    $stmt = $conn->prepare("select * from korisnici");
    if (!$stmt->execute()) {
        die("Greska: " . $conn->error);
    }
 
    $rez = $stmt->get_result();
 
    echo"<form action='editAdmin.php' method='post'>";
        echo "<select name='nKorisnici'>";
            while($podaci = $rez->fetch_assoc())
            {
                echo "<option value=".$podaci['username'].">".$podaci['username']."</option>";
            }
        echo"</select>";
 
        echo "<select name='nRole'>";
        // mysqli_data_seek($rez,0);
        //     while($podaci = $rez->fetch_assoc())
        //     {
        //         if()
        //         echo "<option value=".$podaci['role'].">".$podaci['role']."</option>";
        //     }
        echo '  <option value="admin">admin</option>
                <option value="editor">editor</option>
                <option value="autor">autor</option>
                <option value="sub">sub</option>';
 
        echo"</select>";
        echo "<input type='submit' value='Potvrdi'>";
    echo "</form>";
 
    ?>

</body>
 
</html>