<?php
require "../config/cors.php";
require "../config/database.php";

$sql = "SELECT * FROM qr_codes";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$qr_codes = $stmt->fetchAll();
header('Content-Type: application/json; charset=utf-8');
echo json_encode(['qr_codes' => $qr_codes]);


?>