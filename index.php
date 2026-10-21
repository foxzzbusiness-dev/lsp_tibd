<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['login'] = 'true';
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Username atau password salah";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LSP TIBD</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background: #1f4287;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: #fff;
            width: 340px;
            padding: 30px;
            border-radius: 14px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .login-box h2 {
            color: #1f3a7a;
            margin-bottom: 6px;
        }
        .login-box p {
            font-size: 13px;
            margin-bottom: 18px;
        }
        .login-box input {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .login-box button {
            width: 100%;
            padding: 10px;
            background: #1f3a7a;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        .login-box button:hover {
            background: #162b5c;
        }
        .error {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
        }
        .info {
            font-size: 11px;
            margin-top: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login Website</h2>
        <p>Silakan masuk untuk membuka halaman utama</p>

        <?php if ($error != "") { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Masukkan Username" required>
            <input type="password" name="password" placeholder="Masukkan Password" required>
            <button type="submit" name="login">Login</button>
        </form>

        <div class="info">Username: admin | Password: 12345</div>
    </div>
</body>
</html>