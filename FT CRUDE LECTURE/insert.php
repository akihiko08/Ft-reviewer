<?php
// connection
$server = "localhost";
$username = "root";
$password = "";
$dbname = "employee_db";

$conn = new mysqli($server, $username, $password, $dbname);

// insert data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['name']) && isset($_POST['department']) && isset($_POST['salary'])&& isset($_POST['years_with_company']) && !empty($_POST['name']) && !empty($_POST['department'])&& !empty($_POST['salary'])&& !empty($_POST['years_with_company'])) {

        $name = $_POST['name'];
        $department = $_POST['department'];
        $salary = $_POST['salary'];
        $years_with_company = $_POST['years_with_company'];
 
        $sql = "INSERT INTO employees (name, department, salary, years_with_company)
                VALUES(' $name','$department', '$salary', '$years_with_company')";

        $conn->query($sql);

        echo "Data Saved";
        header("Location: insert.php");

    } else {

        echo "Data Not Complete";

    }
}

// fetch data 
$ret = "SELECT * FROM employees";
$handler = $conn->query($ret);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>

    <style>
        table, th, td {
            border: 2px solid black;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
<body>

<form action="" method="POST">

    <p>Name</p>
    <input type="text" name="name">
    <p>Deratpemt</p>
    <input type="text" name="department">
    <p>Salary</p>
    <input type="text" name="salary">
    <p>Years With Company</p>
    <input type="text" name="years_with_company"><br><br>

    <button type="submit">Save Data</button>
</form>

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

</body>
</html>