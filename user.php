<?php
require_once "database.php";

session_start();

// Periksa apakah pengguna sudah login dan memiliki peran user
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .edit-news-form {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #f8f9fa;
        padding: 10px;
        z-index: 1000;
        transition: bottom 0.3s ease;
    }

    .edit-news-form.open {
        bottom: 0;
    }
  </style>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
            color: #444;
        }

        .page-section {
            padding: 100px 0;
        }

        .section-heading {
            font-size: 40px;
            text-transform: uppercase;
            color: #333;
        }

        .section-subheading {
            font-size: 24px;
            font-style: italic;
            color: #888;
        }

        .portfolio-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .portfolio-item:hover {
            transform: translateY(-5px);
        }

        .portfolio-link {
            display: block;
            position: relative;
        }

        .portfolio-caption {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            text-align: center;
            border-radius: 0 0 10px 10px;
        }

        .portfolio-caption-heading {
            font-size: 24px;
            color: #333;
        }

        .portfolio-caption-subheading {
            font-size: 18px;
            color: #888;
        }

        /* Hover Effect */
        .portfolio-hover {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            background-color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s;
        }

        .portfolio-link:hover .portfolio-hover {
            opacity: 1;
        }

        .portfolio-hover-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: all 0.3s;
        }

        .portfolio-link:hover .portfolio-hover-content {
            opacity: 1;
        }

        .portfolio-link:hover .fa-plus {
            font-size: 3em;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
        <div class="container">
            <a class="navbar-brand" href="#">Alat Bangunan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#katalogproduk">Katalog Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Game -->
    <section class="page-section bg-light mb-2" id="katalogproduk">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase mb-4">Katalog Produk</h2>
                <h3 class="section-subheading text-muted">Semua Produk</h3>
            </div>
            <div class="row">
                <?php
                $data = getAllData();
                foreach ($data as $row) {
                    $id = $row['id_game'];
                    $nama_game = $row['nama_game'];
                    $harga = $row['harga'];
                    $deskripsi = $row['Deskripsi'];
                    $gambar = $row['gambar'];
                ?>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal<?php echo $id; ?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="data:image/jpeg;base64,<?php echo base64_encode($gambar); ?>" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading"><?php echo $nama_game; ?></div>
                                <div class="portfolio-caption-price"><?php echo 'IDR' . $harga; ?></div>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php
    $data = getAllData();
    foreach ($data as $row) {
        $id_game = $row['id_game'];
        $nama_game = $row['nama_game'];
        $harga = $row['harga'];
        $deskripsi = $row['Deskripsi'];
        $gambar = $row['gambar'];
    ?>
        <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $id_game; ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <h2 class="text-uppercase"><?php echo $nama_game; ?></h2>
                                    <img class="img-fluid d-block mx-auto" src="data:image/jpeg;base64,<?php echo base64_encode($gambar); ?>" alt="..." />
                                    <p class="item-intro text-muted"><?php echo $deskripsi; ?></p>
                                    <p>Harga: <?php echo $harga; ?></p>

                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close
                                    </button>

                                    <button class="btn btn-success btn-xl text-uppercase ms-2" type="button">
                                        <i class="fas fa-shopping-cart"></i>
                                        Checkout
                                    </button>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <script>
    // Fungsi untuk menampilkan pesan alert
    function showAlert() {
        alert("Produk berhasil dibeli!");
    }

    // Menambahkan event listener ke setiap tombol "Buy"
    var buyButtons = document.querySelectorAll('.btn-success');
    buyButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            showAlert(); // Memanggil fungsi showAlert ketika tombol "Buy" ditekan
        });
    });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
