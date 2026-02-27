<?php
session_start();
// Ity no tenimiafinao (Azonao ovaina)
$password_admin = "grace2024"; 

if (isset($_POST['login'])) {
    if ($_POST['password'] == $password_admin) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Diso ny tenimiafina!";
    }
}
?>
<!DOCTYPE html>
<html lang="mg">
<head>
    <meta charset="UTF-8">
    <title>Login Admin | Grace Store</title>
    <style>
        body { background: #0b0b14; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: rgba(255,255,255,0.05); padding: 40px; border-radius: 20px; border: 1px solid #9d4edd; text-align: center; width: 300px; }
        input { width: 100%; padding: 12px; margin: 10px 0; border-radius: 10px; border: none; background: #1a1a2e; color: white; }
        button { width: 100%; padding: 12px; border-radius: 10px; border: none; background: #9d4edd; color: white; font-weight: bold; cursor: pointer; }
        .error { color: #ff4d4d; font-size: 0.8rem; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Grace <span>Admin</span></h2>
        <form method="POST">
            <input type="password" name="password" placeholder="Tenimiafina" required>
            <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
            <button type="submit" name="login">Hiditra</button>
        </form>
    </div>
</body>
</html>