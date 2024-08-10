<?php
include "koneksi.php"; // Pastikan koneksi.php ada di direktori yang benar dan dapat diakses

// Mengambil data dari form
$username = $_POST['username'];
$password = $_POST['password']; // Hash password menggunakan md5

// Menyiapkan query dengan parameter yang aman
$query = "SELECT * FROM user WHERE username = ? AND password = ?";
$stmt = $connect->prepare($query);

// Memeriksa jika persiapan statement berhasil
if (!$stmt) {
    die("Prepare failed: " . $connect->error);
}

// Mengikat parameter
$stmt->bind_param("ss", $username, $password);

// Menjalankan query
$stmt->execute();
$result = $stmt->get_result();

// Memulai sesi
session_start();

if ($result->num_rows > 0) {
    // Mengambil data pengguna
    $user = $result->fetch_assoc();

    // Menyimpan data ke sesi
    $_SESSION['username'] = $username;
    $_SESSION['status'] = 'login';

    // Memeriksa peran pengguna
    if ($user['role'] === 'admin') {
        echo "Anda berhasil login";
        echo "<a href='adminDasboard.php'>Admin</a>";
    } elseif ($user['role'] === 'user') {
        echo "Anda berhasil login";
        echo "<a href='userDasboard.php'>User Dashboard</a>";
    }
} else {
    echo "Anda gagal login";
    echo "<a href='loginForm.html'>Login Form</a>";
}

// Menutup statement dan koneksi
$stmt->close();
mysqli_close($connect);
?>
