<?php
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        die("Email/Password missing!");
    }

    $sql = "SELECT id, full_name, email, phone, password FROM users WHERE email='$email' LIMIT 1";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) === 1) {
        $user = mysqli_fetch_assoc($res);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email'] = $user['email'];

            echo "<script>alert('Login Successful!'); window.location.href='index.php';</script>";
            exit;
        } else {
            echo "<script>alert('Wrong password'); window.location.href='index.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('User not found'); window.location.href='index.php';</script>";
        exit;
    }
}
?>
