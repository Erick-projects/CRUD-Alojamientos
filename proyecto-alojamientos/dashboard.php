<?php
include 'config/db.php';
include 'includes/functions.php';
redirectIfNotLoggedIn();
include 'includes/header.php';

if(isset($_POST['add_alojamiento'])){
    $stmt = $pdo->prepare("INSERT INTO user_alojamientos (user_id, alojamiento_id) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $_POST['alojamiento_id']]);
}

if(isset($_POST['remove_alojamiento'])){
    $stmt = $pdo->prepare("DELETE FROM user_alojamientos WHERE id = ?");
    $stmt->execute([$_POST['id']]);
}

$stmt = $pdo->prepare("SELECT ua.id, a.nombre, a.descripcion, a.imagen
                       FROM user_alojamientos ua
                       JOIN alojamientos a ON ua.alojamiento_id = a.id
                       WHERE ua.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$myAlojamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2 class="color2" style="text-align:center;">Hola, <?php echo $_SESSION['username']; ?></h2>
    <h3 class="color3" style="text-align:center;">Mis Alojamientos</h3>

    <?php if(count($myAlojamientos) == 0) echo "<p class='color1' style='text-align:center;'>No tienes alojamientos agregados.</p>"; ?>

    <div style="display:flex; flex-wrap:wrap; gap:20px; justify-content:center;">
        <?php foreach($myAlojamientos as $alojamiento): ?>
            <div class="card" style="width:250px; padding:15px; text-align:center; background:#f0f2f5; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
                <img src="<?php echo $alojamiento['imagen']; ?>" alt="<?php echo $alojamiento['nombre']; ?>" style="width:100%; height:150px; object-fit:cover; border-radius:10px;">
                <h3 class="color2"><?php echo $alojamiento['nombre']; ?></h3>
                <p class="color3"><?php echo $alojamiento['descripcion']; ?></p>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $alojamiento['id']; ?>">
                    <button type="submit" name="remove_alojamiento" class="color5">Eliminar</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
