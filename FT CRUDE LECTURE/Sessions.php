<?php
// connection
$server = "localhost";
$username = "root";
$password = "";
$dbname = "employee_db";

$conn = new mysqli($server, $username, $password, $dbname);

session_start();

if(isset(($_POST)['namedata'])){
    $_SESSION['userName'] = $_POST['namedata'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method = "POST">
        <input type="text" name = "namedata" placeholder = "Tell me who you are">
        <button type = "submit">Enter</button>
        
    </form>

    <?php if(isset($_SESSION['userName'])):?>
        <h1>HELLO <?php echo $_SESSION['userName']?></h1>
    <?php endif?>

    
</body>
</html>
