<?php require 'Rolebase Back-end.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Vet Clinic Appointment System</title>
</head>
<body>

<h1>VET CLINIC APPOINTMENT SYSTEM</h1>
<hr>

<?php if (!isset($_SESSION['user_id'])) { ?>

    <h2>REGISTER</h2>

    <?php
    if (isset($register_success)) echo $register_success . "<br>";
    if (isset($register_error)) echo $register_error . "<br>";
    ?>

    <form method="POST">
        Full Name:<br>
        <input type="text" name="fullname" required><br><br>

        Email:<br>
        <input type="email" name="email" required><br><br>

        Password:<br>
        <input type="password" name="password" required><br><br>

        Confirm Password:<br>
        <input type="password" name="confirm_password" required><br><br>

        <input type="submit" name="register" value="Register">
    </form>

    <hr>

    <h2>LOGIN</h2>

    <?php
    if (isset($login_error)) echo $login_error . "<br>";
    ?>

    <form method="POST">
        Email:<br>
        <input type="email" name="email" required><br><br>

        Password:<br>
        <input type="password" name="password" required><br><br>

        <input type="submit" name="login" value="Login">
    </form>

<?php } else { ?>

    <h2>Welcome <?php echo $_SESSION['fullname']; ?></h2>
    <p>Role: <?php echo $_SESSION['role']; ?></p>

    <form method="POST">
        <input type="submit" name="logout" value="Logout">
    </form>

    <hr>

    <?php if ($_SESSION['role'] == 'client') { ?>

        <h2>BOOK APPOINTMENT</h2>

        <?php
        if (isset($book_success)) echo $book_success . "<br>";
        ?>

        <form method="POST">
            Pet Type:<br>
            <input type="text" name="pet_type" required><br><br>

            Reason:<br>
            <input type="text" name="reason" required><br><br>

            Date:<br>
            <input type="date" name="appt_date" required><br><br>

            Time:<br>
            <input type="time" name="appt_time" required><br><br>

            <input type="submit" name="book" value="Book">
        </form>

        <hr>

        <h2>MY APPOINTMENTS</h2>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Pet Type</th>
                <th>Reason</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>

            <?php
            if ($my_appointments->num_rows > 0) {
                while ($row = $my_appointments->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['appt_id']; ?></td>
                <td><?php echo $row['pet_type']; ?></td>
                <td><?php echo $row['reason']; ?></td>
                <td><?php echo $row['appt_date']; ?></td>
                <td><?php echo $row['appt_time']; ?></td>
                <td><?php echo $row['status']; ?></td>
            </tr>
            <?php
                }
            }
            ?>
        </table>

    <?php } ?>

    <?php if ($_SESSION['role'] == 'admin') { ?>

        <h2>ALL APPOINTMENTS</h2>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Client Name</th>
                <th>Pet Type</th>
                <th>Reason</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
            if ($all_appointments->num_rows > 0) {
                while ($row = $all_appointments->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['appt_id']; ?></td>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['pet_type']; ?></td>
                <td><?php echo $row['reason']; ?></td>
                <td><?php echo $row['appt_date']; ?></td>
                <td><?php echo $row['appt_time']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="appt_id" value="<?php echo $row['appt_id']; ?>">
                        <input type="submit" name="cancel" value="Cancel">
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="appt_id" value="<?php echo $row['appt_id']; ?>">
                        <input type="submit" name="delete" value="Delete">
                    </form>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </table>

    <?php } ?>

<?php } ?>

</body>
</html>