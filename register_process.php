<?php
session_start();
include 'database.php';
$conn = connectDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query SQL untuk menyimpan data ke dalam tabel user_login
    $sql = "INSERT INTO user_login (username, password, email) VALUES ('$username', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
        // Jika registrasi berhasil, arahkan pengguna ke halaman login
        $_SESSION['registration_success'] = true; // Set session flag
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

