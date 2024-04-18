<?php
session_start();
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']); 

    // mencari data pengguna dari database
    if ($role == 'admin') {
        $query = "SELECT * FROM admin_login WHERE username='$username'";
    } elseif ($role == 'user') {
        $query = "SELECT * FROM user_login WHERE username='$username'";
    } else {
        $_SESSION['login_error'] = "Role tidak valid.";
        header("location: login.php");
        exit();
    }

    // query
    $result = mysqli_query($conn, $query);

    // Periksa 
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // simpan data pengguna
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            // sesuai role
            if ($role == 'admin') {
                header("location: admin.php");
            } elseif ($role == 'user') {
                header("location: user.php");
            }
            exit();
        } else {
            $_SESSION['login_error'] = "Username atau password salah.";
            header("location: login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Username atau password salah.";
        header("location: login.php");
        exit();
    }
} else {
    header("location: login.php");
    exit();
}
?>
