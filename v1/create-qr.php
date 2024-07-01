<?php
require '../config/cors.php';
require '../config/database.php';

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Obtener los datos enviados
    $data = $input['data'];
    $nombre_ref = $input['nombre_ref'];
    $description = $input['description'];
    $created_by = $input['created_by'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO qr_codes (data, nombre_ref, description, created_by) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$data, $nombre_ref, $description, $created_by])) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'message' => 'Código QR creado exitosamente',
            'estado' => 'perfecto'
        ]);
    } else {
        throw new Exception('Error al ejecutar la sentencia SQL');
    }
} catch (Exception $e) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['message' => 'Error al crear código QR: ' . $e->getMessage()]);
}
?>
