<?php
// connection
$server = "localhost";
$username = "root";
$password = "";
$dbname = "employee_db";

$conn = new mysqli($server, $username, $password, $dbname);

if(isset($_POST['empnum'])){
    $empnum = $_POST['empnum'];
    $search = "SELECT * 
    FROM employees
    WHERE id = '$empnum'";
    $holder = $conn->query($search);
    $data = $holder->fetch_assoc(); 
}

if(isset($_POST['empnum']) && isset($_POST['name'])&& isset($_POST['department']) && isset($_POST['salary'])&& isset($_POST['years_with_company'])){

    $empnum = $_POST['empnum'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    $years_with_company = $_POST['years_with_company'];

    $sql = "UPDATE employees 
            SET Name = '$name', department = '$department' , salary = '$salary', years_with_company = '$years_with_company'
            WHERE id = $empnum";

    $conn->query($sql);

    $edited = "employee Info: ". $empnum . " has been edited";  
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
        <div class = "info">
            <h3>Search form</h3>
            <form action="" method="POST">
                <input type="text" name="empnum" required placeholder = "Employee Id">
                <br><br>
                <button type="submit">Search Employee</button>
            </form>
        </div>
    </div>
    <!-- deactivated div -->
    <?php if(isset ($data)):?>
    <div class = "info">
            <h3>Update form</h3>
            <form action="" method="POST">
                <p>Employee Id</p>
                <input type="text" name="empnum" required value = "<?php echo $data['id']?>">
                <p>Name</p>
                <input type="text" name="name" value  = "<?php echo $data['name']?>">
                <p>Deratpemt</p>
                <input type="text" name="department" value = "<?php echo $data['department']?>">
                <p>salary</p>
                <input type="text" name="salary" value = "<?php echo $data['salary']?>">
                <p>Years With Company</p>
                <input type="text" name="years_with_company" value = "<?php echo $data['years_with_company']?>"><br><br>
                <button type="submit">Update Employee</button>
            </form>
        </div>
        <?php else:?>
        <div class = "info">
            <h3>Employee didn't exist</h3>
        </div>
        <?php endif?>

        <?php if(isset ($edited)):?>
            <div class = "info">
                <div style = "background-color: #cbffc0">
                    <h1st style = "font-size = 18px; color: #2d362b "> <?php echo $edited ?> <h1>
                </div>
            </div>
        <?php endif?>
    
</body>
</html>






