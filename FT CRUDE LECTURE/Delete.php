<?php
// connection
$server = "localhost";
$username = "root";
$password = "";
$dbname = "employee_db";

$conn = new mysqli($server, $username, $password, $dbname);

// fetch data 
$ret = "SELECT * FROM employees";
$handler = $conn->query($ret);

if(isset($_POST['empnum'])){
    $empnum = $_POST['empnum'];

    $sql = "DELETE FROM employees 
            WHERE id = $empnum ";

    $conn->query($sql);

        echo "<script>alert('Succesfully Deleted')</script>";
        header("Location: DELETE.php");

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
     <style>
        .container{
            display: flex;
            gap: 20px;
        }
        table, th, td {
            border: 2px solid black;
            border-collapse: collapse;
            text-align: center;
        }
        
    </style>
</head>
<body>
    <div class = "container">
        <div class = "data">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Salary</th>
                    <th>Years_With_Company</th>
                </tr>

                <?php if ($handler->num_rows > 0): ?>
                    <?php while ($row = $handler->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['salary']; ?></td>
                        <td><?php echo $row['years_with_company']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">no data found</td>
                    </tr>
                <?php endif; ?>

            </table>
        </div>
        <div class = "info">
            <h3>Delete form</h3>
            <form action="" method="POST">
                <p>Employee Id</p>
                <input type="text" name="empnum" required>
                <button type="submit">DELETE Employee</button>
            </form>
        </div>
    </div>
    
    
</body>
</html>