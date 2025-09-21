<?php
include 'config/db.php';
include 'includes/functions.php';
include 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM alojamientos");
$alojamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2 class="color2">Alojamientos Disponibles</h2>
    <?php foreach($alojamientos as $alojamiento): ?>
        <div class="card">
            <img src="<?php echo $alojamiento['imagen']; ?>" alt="<?php echo $alojamiento['nombre']; ?>">
            <h3 class="color2"><?php echo $alojamiento['nombre']; ?></h3>
            <p class="color3"><?php echo $alojamiento['descripcion']; ?></p>
            <?php if(isLoggedIn() && !isAdmin()): ?>
                <form method="POST" action="dashboard.php">
                    <input type="hidden" name="alojamiento_id" value="<?php echo $alojamiento['id']; ?>">
                    <button type="submit" name="add_alojamiento" class="color5">Agregar a mi cuenta</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>
