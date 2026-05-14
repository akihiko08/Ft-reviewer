<?php
//connection
$sever = "localhost";
$username = "root";
$password = "";
$dbname = "company_db";

$conn = new mysqli($sever, $username, $password, $dbname);

// data retreiver
$ret = "SELECT * FROM employee";
$handler = $conn->query($ret);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read</title>
    <style>
        table, th, td {
            border: 2px solid black;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
<body>
    //Read front-end 
    <table>
        <tr>
            <th>emp_id</th>
            <th>fname</th>
            <th>lname</th>
        </tr>
    <?php if ($handler->num_rows > 0):?>
        <?php while($row = $handler->fetch_assoc()):?>
        <tr>
            <td><?php echo $row['emp_id']; ?></td>
            <td><?php echo $row['fname']; ?></td>
            <td><?php echo $row['lname']; ?></td>
        </tr>
    <?php endwhile;?>    
    <?php else:?>
        <tr>
            <td colspan = '3'>no data found</td>
        </tr>
        
    <?php endif ?>    
    </table>

    




</body>
</html>
