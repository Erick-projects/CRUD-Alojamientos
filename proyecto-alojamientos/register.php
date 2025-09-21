<?php
include 'config/db.php';
include 'includes/functions.php';
include 'includes/header.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
    if($stmt->execute([$username,$email,$password])){
        header("Location: login.php");
        exit();
    } else { $error="Error al registrar usuario"; }
}
?>

<div class="container">
    <h2>Registro</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="email" name="email" placeholder="Correo" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Registrarse</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
