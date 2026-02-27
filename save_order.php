<?php
include 'config.php';

// Maka ny data JSON nalefan'ny JavaScript
$inputData = file_get_contents('php://input');
$data = json_decode($inputData, true);

if ($data) {
    // Manadio ny data (fiarovana amin'ny hackers)
    $nom = $conn->real_escape_string($data['nom']);
    $fb = $conn->real_escape_string($data['fb']);
    $tel = $conn->real_escape_string($data['tel']);
    $adr = $conn->real_escape_string($data['adresse']);
    $total = (int)$data['total'];
    
    // Hanova ny lisitry ny stickers (Array) ho soratra tsotra
    $lisitra = "";
    foreach($data['produits'] as $item) {
        $lisitra .= $item['name'] . ", ";
    }
    $lisitra = rtrim($lisitra, ", "); 

    // Requete SQL hampidirana ny baiko
    $sql = "INSERT INTO commandes (nom_client, fb_client, tel, adresse, produits, total) 
            VALUES ('$nom', '$fb', '$tel', '$adr', '$lisitra', '$total')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $conn->error]);
    }
}
$conn->close();
?>