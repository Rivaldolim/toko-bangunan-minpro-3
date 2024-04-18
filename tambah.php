<?php
require_once "database.php";

// Pastikan form telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $nama_game = $_POST["nama_game"];
    $harga = $_POST["harga"];
    $deskripsi = $_POST["deskripsi"];

    // Lakukan koneksi ke database
    $conn = connectDB();

    // Persiapkan query SQL INSERT
    $sql = "INSERT INTO game (nama_game, harga, Deskripsi, gambar) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameter ke query
    $stmt->bind_param("sdss", $nama_game, $harga, $deskripsi, $gambar_data);

    // Lakukan pengolahan gambar jika file gambar telah diunggah
    if (isset($_FILES["gambar"]["tmp_name"]) && !empty($_FILES["gambar"]["tmp_name"])) {
        $gambar = $_FILES["gambar"]["tmp_name"];
        $gambar_data = file_get_contents($gambar);
    } else {
        // Atur nilai gambar ke null jika tidak ada file gambar yang diunggah
        $gambar_data = null;
    }

    // Jalankan query
    if ($stmt->execute()) {
        // Berhasil menambahkan data, beri peringatan berhasil
        echo "<script>alert('Data game berhasil ditambahkan.');</script>";
    } else {
        // Gagal menambahkan data, beri peringatan gagal
        echo "<script>alert('Gagal menambahkan data game: " . $stmt->error . "');</script>";
    }

    // Kembali ke halaman admin.php
    echo "<script>window.location.href = 'admin.php';</script>";

    // Tutup statement dan koneksi database
    $stmt->close();
    $conn->close();
}
?>