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
    include_once("connection.php");
    $stmt = $conn->prepare("select * from korisnici");
    $stmt->execute();
    $rez = $stmt->get_result();
    


    if($_SESSION['privilegija']!='admin' || !isset($_SESSION)){
            header("Location: 404.html");
        }
        echo "<h2>Dobrodosli ".$_SESSION['user']."</h2>";
    ?>

    <form action="editAdmin.php" method="post">
        <select name="nkorisnici" id="">
            <?php
                while($podaci = $rez->fetch_assoc()){
                    echo "<option value='".$podaci['username']."'>".$podaci['username']."</option>";
                }
                
            ?>
        </select>
        <select name="nRole" id="">
            <option value="admin">admin</option>
            <option value="editor">editor</option>
            <option value="autor">autor</option>
            <option value="sub">sub</option>
        </select>
        
        
        <input type="submit" value="Potvrdi">
    </form>
</body>
</html>