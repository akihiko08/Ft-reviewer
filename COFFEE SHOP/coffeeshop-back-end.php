<?php

// connection
$server   = "localhost";
$username = "root";
$password = "";
$dbname   = "coffee_shop";

$conn = new mysqli($server, $username, $password, $dbname);


// insert coffee
if (isset($_POST['insert'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $availability = $_POST['availability'];
    $popularity = $_POST['popularity'];

    if (!empty($name) && !empty($price) && !empty($availability) && !empty($popularity)) {

        $sql = "INSERT INTO coffees (name, price, availability, popularity)
                VALUES ('$name', '$price', '$availability', '$popularity')";

        $conn->query($sql);

        $inserted = "Coffee '$name' has been added successfully.";

    } else {

        $inserted = "Error: Please fill in all fields.";

    }

}


// search coffee for update
if (isset($_POST['search_update'])) {

    $coffee_id = $_POST['search_coffee_id'];

    $sql    = "SELECT * FROM coffees WHERE coffee_id = '$coffee_id'";
    $holder = $conn->query($sql);
    $data   = $holder->fetch_assoc();

}


// update coffee
if (isset($_POST['update'])) {

    $coffee_id = $_POST['coffee_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $availability = $_POST['availability'];
    $popularity = $_POST['popularity'];

    $sql = "UPDATE coffees
            SET name = '$name', price = '$price', availability = '$availability', popularity = '$popularity'
            WHERE coffee_id = '$coffee_id'";

    $conn->query($sql);

    $edited = "Coffee ID $coffee_id has been updated successfully.";

}


// search coffee for delete
if (isset($_POST['search_delete'])) {

    $coffee_id = $_POST['delete_coffee_id'];

    $sql = "SELECT * FROM coffees WHERE coffee_id = '$coffee_id'";
    $holder = $conn->query($sql);
    $delete_data = $holder->fetch_assoc();

}


// delete coffee
if (isset($_POST['delete'])) {

    $coffee_id = $_POST['delete_coffee_id'];

    $sql = "DELETE FROM coffees WHERE coffee_id = '$coffee_id'";

    $conn->query($sql);

    $deleted = "Coffee ID $coffee_id has been deleted successfully.";

}


// fetch all coffees for the table
$sql     = "SELECT * FROM coffees";
$handler = $conn->query($sql);

?>