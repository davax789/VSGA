<?php
include "koneksi.php"; // Pastikan koneksi.php diletakkan di tempat yang benar dan dapat diakses

// Mengambil data dari form
$username = $_POST['username'];
$password = $_POST['password']; // Hash password menggunakan password_hash dan password_verify lebih aman

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

// Mengambil data hasil query
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Mengambil data pengguna

    // Memeriksa peran pengguna
    if ($user['role'] === 'admin') {
        // Debug: Tampilkan peran pengguna
        echo "Role: " . $user['role'] . "<br>";
        echo "Anda berhasil login sebagai admin.";
        echo "<a href='adminDasboard.html'>Admin Dashboard</a>";
    } elseif ($user['role'] === 'user') {
        // Debug: Tampilkan peran pengguna
        echo "Role: " . $user['role'] . "<br>";
        echo "Anda berhasil login sebagai user.";
        echo "<a href='userDasboard.html'>User Dashboard</a>";
    } else {
        echo "Peran pengguna tidak dikenali.";
    }
} else {
    echo "Anda gagal login. Periksa username dan password Anda.";
    echo "<a href='loginForm.html'>Login Form</a>";
}

// Menutup statement dan koneksi
$stmt->close(); // Menutup statement
$connect->close(); // Menutup koneksi
?>
