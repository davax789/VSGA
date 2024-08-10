<?php
// Default values
$font_size = '15px';
$background_color = '#4e79a0';
$msg = '';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from POST request
    $background_color = isset($_POST['background_color']) ? $_POST['background_color'] : $background_color;
    $font_size = isset($_POST['font_size']) ? $_POST['font_size'] : $font_size;

    // Check if delete cookies button was pressed
    if (isset($_POST['delete_cookie'])) {
        setcookie('background_color', '', time() - 3600, '/'); // Delete cookie
        setcookie('font_size', '', time() - 3600, '/'); // Delete cookie
        $msg = 'Data cookie berhasil dihapus';
    } else {
        // Set cookies for 7 days
        if (isset($_POST['remember'])) {
            setcookie('background_color', $background_color, time() + 604800, '/'); // 7 days
            setcookie('font_size', $font_size, time() + 604800, '/'); // 7 days
            $msg = 'Data cookie berhasil disimpan';
        } else {
            $msg = 'Cookie tidak disimpan';
        }
    }
} else {
    // Load values from cookies if they exist
    if (isset($_COOKIE['background_color'])) {
        $background_color = $_COOKIE['background_color'];
    }
    if (isset($_COOKIE['font_size'])) {
        $font_size = $_COOKIE['font_size'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Open Sans', 'Segoe UI', Tahoma;
            font-size: <?php echo htmlspecialchars($font_size); ?>;
            background-color: <?php echo htmlspecialchars($background_color); ?>;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 250px;
            margin: auto;
            margin-top: 15px;
            padding: 20px;
            background-color: #FFFFFF;
            border: 1px solid #CCCCCC;
        }
        .success {
            background-color: #abf1e1;
            padding: 5px 10px;
            color: #462626;
            margin-bottom: 10px;
        }
        select {
            padding: 5px 10px;
            font-size: <?php echo htmlspecialchars($font_size); ?>;
            border: 1px solid #CCCCCC;
            color: #5d5d5d;
            width: 100%;
            margin-bottom: 10px;
        }
        .button {
            border: 0;
            padding: 10px 20px;
            color: #FFFEEE;
            font-size: 16px;
            margin-right: 5px;
            cursor: pointer;
        }
        .button.blue {
            background-color: #3e97e2;
        }
        .button.red {
            background-color: #e26b6b;
        }
        .remember {
            margin-bottom: 12px;
        }
        .copyright {
            padding: 0;
            background: none;
            text-align: center;
            margin-top: 10px;
            color: #EFFFFF;
            font-size: smaller;
        }
        .clearfix::before, .clearfix::after {
            content: "";
            display: table;
        }
        .clearfix::after {
            clear: both;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="post" action="">
            <h3>Settings</h3>
            <?php
            if ($msg) {
                echo '<div class="success">' . htmlspecialchars($msg) . '</div>';
            }
            ?>

            <div>Background Color</div>
            <select name="background_color">
                <?php
                $colors = array(
                    '#4e79a0' => 'Biru',
                    '#75b1a3' => 'Hijau',
                    '#d06353' => 'Merah'
                );
                foreach ($colors as $value => $name) {
                    $selected = ($value === $background_color) ? 'selected="selected"' : '';
                    echo '<option value="' . htmlspecialchars($value) . '" ' . $selected . '>' . htmlspecialchars($name) . '</option>';
                }
                ?>
            </select>

            <div>Font Size</div>
            <select name="font_size">
                <?php
                $font_sizes = array('15px', '17px', '20px', '25px');
                foreach ($font_sizes as $value) {
                    $selected = ($value === $font_size) ? 'selected="selected"' : '';
                    echo '<option value="' . htmlspecialchars($value) . '" ' . $selected . '>' . htmlspecialchars($value) . '</option>';
                }
                ?>
            </select>

            <div class="remember">
                <input type="checkbox" id="remember" name="remember" />
                <label for="remember">Remember</label>
            </div>

            <div class="clearfix">
                <input type="submit" class="button blue" name="submit" value="Save" />
                <input type="submit" class="button red" name="delete_cookie" value="Delete Cookie" />
            </div>
        </form>
    </div>

    <div class="copyright">
        &copy; <?php echo date('Y'); ?> JagoWebDev.com<br />
        <a href="http://jagowebdev.com/cookie-pada-php/">Tutorial Cookies</a>
    </div>
</body>
</html>
