<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gaya untuk mengubah warna latar belakang tombol menjadi kuning */
        .btn-primary {
            background-color: #ffc107; /* Warna latar belakang kuning */
            border-color: #ffc107; /* Warna garis tepi kuning */
            color: #343a40; /* Warna teks abu-abu tua */
        }

        /* Gaya untuk mengubah warna teks tombol menjadi putih saat tombol dihover */
        .btn-primary:hover {
            color: #fff; /* Warna teks putih */
        }
        
        /* Gaya untuk mengubah warna teks tautan "Login" menjadi kuning */
        a.login-link {
            color: #ffc107; /* Warna kuning */
        }
    
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Registration Form
                    </div>
                    <div class="card-body">
                        <form action="register_process.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                            <div class="mt-3 text-center">
                            <p>Jika sudah memiliki akun silakan melakukan <a href="login.php" class="login-link">Login</a>.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
