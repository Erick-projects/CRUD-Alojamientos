<?php
include 'config/db.php';
include 'includes/functions.php';
include 'includes/header.php';

$error = '';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header("Location: ".($user['role']=='admin'?'admin.php':'dashboard.php'));
        exit();
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>

<div class="container" style="max-width:400px; margin:50px auto; text-align:center;">
    <h2 class="color2">Iniciar Sesión</h2>
    <?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Correo" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit" style="margin-top:10px;">Iniciar Sesión</button>
    </form>
    <p style="margin-top:15px;">¿No tienes cuenta? <a href="register.php" class="color4">Regístrate aquí</a></p>
</div>

<?php include 'includes/footer.php'; ?>
