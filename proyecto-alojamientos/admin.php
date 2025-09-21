<?php
include 'config/db.php';
include 'includes/functions.php';
redirectIfNotLoggedIn();

if(!isAdmin()){ 
    die("<p class='color1' style='text-align:center;'>Acceso denegado</p>"); 
}

include 'includes/header.php';

if(isset($_POST['add_alojamiento'])){
    $nombre = sanitize($_POST['nombre']);
    $descripcion = sanitize($_POST['descripcion']);
    $imagen = sanitize($_POST['imagen']);

    $stmt = $pdo->prepare("INSERT INTO alojamientos (nombre, descripcion, imagen) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $descripcion, $imagen]);

    header("Location: admin.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM alojamientos");
$alojamientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2 class="color2" style="text-align:center; margin-bottom:30px;">Panel Administrador</h2>

    <div style="display:flex; gap:30px; align-items:flex-start; justify-content:center; flex-wrap:wrap;">

        <div style="flex:1; min-width:300px; max-width:400px; padding:20px; background-color:#f0f9ff; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
            <h3 class="color3" style="text-align:center;">Agregar Nuevo Alojamiento</h3>
            <form method="POST" style="display:flex; flex-direction:column; gap:10px;">
                <input type="text" name="nombre" placeholder="Nombre" required style="padding:10px; border-radius:5px; border:1px solid #ccc;">
                <input type="text" name="descripcion" placeholder="Descripción" required style="padding:10px; border-radius:5px; border:1px solid #ccc;">
                <input type="text" name="imagen" placeholder="URL de la imagen" required style="padding:10px; border-radius:5px; border:1px solid #ccc;">
                <button type="submit" name="add_alojamiento" style="padding:10px; border:none; border-radius:5px; background-color:#00aced; color:white; cursor:pointer;">Agregar</button>
            </form>
        </div>

        <div style="flex:2; display:flex; flex-wrap:wrap; gap:20px; justify-content:flex-start; min-width:300px;">
            <?php foreach($alojamientos as $alojamiento): ?>
                <div class="card" style="width:250px; padding:15px; text-align:center; background:#f0f2f5; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
                    <img src="<?php echo $alojamiento['imagen']; ?>" alt="" style="width:100%; height:150px; object-fit:cover; border-radius:10px;">
                    <h3 class="color2"><?php echo $alojamiento['nombre']; ?></h3>
                    <p class="color3"><?php echo $alojamiento['descripcion']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>
