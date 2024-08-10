<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <?php
    session_start(); // Memulai sesi

    if (isset($_SESSION['status']) && $_SESSION['status'] === 'login') {
        echo '<h1>Selamat Datang, ' . htmlspecialchars($_SESSION['username']) . '</h1>';
        echo '<br>';
        echo '<a href="sessionLogout.php">Logout</a>';
    } else {
        echo 'Anda belum login. <a href="loginForm.html">Login</a>';
    }
    ?>
</body>
</html>
