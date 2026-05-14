<?php

session_start();

// connection
$server   = "localhost";
$username = "root";
$password = "";
$dbname   = "vet_clinic";

$conn = new mysqli($server, $username, $password, $dbname);

// register
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $check = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {

        $register_error = "Email already exists.";

    } else if ($password == $confirm_password) {

        $sql = "INSERT INTO users (fullname, email, password, role)
                VALUES ('$fullname', '$email', '$password', 'client')";

        $conn->query($sql);

        $register_success = "Account created! You can now log in.";

    } else {

        $register_error = "Passwords do not match.";
    }
}


// login
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $login_password = $_POST['password'];

    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND password='$login_password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['role'] = $row['role'];

        header("Location: Rolebase front-end.php");
        exit();

    } else {

        $login_error = "Incorrect email or password.";
    }
}


// logout
if (isset($_POST['logout'])) {

    session_destroy();
    header("Location: Rolebase front-end.php");
    exit();
}


// book appointment
if (isset($_POST['book'])) {

    $user_id = $_SESSION['user_id'];
    $pet_type = $_POST['pet_type'];
    $reason = $_POST['reason'];
    $appt_date = $_POST['appt_date'];
    $appt_time = $_POST['appt_time'];

    $sql = "INSERT INTO appointments
            (user_id, pet_type, reason, appt_date, appt_time, status)
            VALUES
            ('$user_id','$pet_type','$reason','$appt_date','$appt_time','Pending')";

    $conn->query($sql);

    $book_success = "Appointment booked successfully!";
}


// CANCEL (ADMIN ONLY)
if (isset($_POST['cancel'])) {

    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

        $appt_id = $_POST['appt_id'];

        $sql = "UPDATE appointments
                SET status='Cancelled'
                WHERE appt_id='$appt_id'";

        $conn->query($sql);

        header("Location: Rolebase front-end.php");
        exit();

    } else {
        echo "Only admin can cancel appointments.";
    }
}


// DELETE (ADMIN ONLY)
if (isset($_POST['delete'])) {

    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

        $appt_id = $_POST['appt_id'];

        $sql = "DELETE FROM appointments
                WHERE appt_id='$appt_id'";

        $conn->query($sql);

        header("Location: Rolebase front-end.php");
        exit();

    } else {
        echo "Only admin can delete appointments.";
    }
}


// client appointments
if (isset($_SESSION['role']) && $_SESSION['role'] == 'client') {

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM appointments
            WHERE user_id='$user_id'
            ORDER BY appt_date ASC";

    $my_appointments = $conn->query($sql);
}


// admin appointments
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

    $sql = "SELECT appointments.*, users.fullname
            FROM appointments
            JOIN users
            ON appointments.user_id = users.user_id
            ORDER BY appt_date ASC";

    $all_appointments = $conn->query($sql);
}

?>