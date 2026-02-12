<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);  
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hashing

    $sql = "INSERT INTO users (full_name, email, phone, password) VALUES ('$full_name', '$email', '$phone', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Signup Successful Bareilly Foodie! Please Login.'); window.location.href='index.php';
</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>