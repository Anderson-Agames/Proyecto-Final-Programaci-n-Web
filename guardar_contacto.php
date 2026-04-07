<?php
require_once 'config/database.php';

// verificamos que venga del formulario con POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $database = new Database();
    $db = $database->getConnection();
    
    // recibimos los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $asunto = $_POST['asunto'];
    $comentario = $_POST['comentario'];
    $fecha = date('Y-m-d H:i:s');
    
    // preparamos la consulta para insertar en la tabla contacto
    $sql = "INSERT INTO contacto (fecha, correo, nombre, asunto, comentario) 
            VALUES (:fecha, :correo, :nombre, :asunto, :comentario)";
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':asunto', $asunto);
    $stmt->bindParam(':comentario', $comentario);
    
    if($stmt->execute()) {
        header('Location: contacto.php?mensaje=ok');
    } else {
        header('Location: contacto.php?error=1');
    }
} else {
    // si alguien intenta acceder directamente
    header('Location: contacto.php');
}
?>