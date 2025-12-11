<?php 
header("Content-Type: application/json");
echo json_encode([
    "status" => "success",
    "message" => "PHP is working on Vercel",
    "timestamp" => date("c"),
    "php_version" => phpversion()
]);
?>
