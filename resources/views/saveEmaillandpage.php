<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

// 🔑 REMPLACEZ CES 4 LIGNES PAR VOS IDENTIFIANTS OVH
$host = "jefiepvjefie.mysql.db"; // Ex: mysql51-44.perso ou l'adresse IP fournie par OVH
$dbname = "jefiepvjefie";       // Souvent identique à l'utilisateur ou fini par un chiffre
$username = "jefiepvjefie";
$password = "AllanBjdaffney2000";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Impossible de se connecter à la base de données."]);
    exit;
}

// Récupération des données envoyées par le JavaScript
$data = json_decode(file_get_contents("php://input"), true);
$email = filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL);

if (!$email) {
    echo json_encode(["status" => "error", "message" => "Adresse e-mail non valide."]);
    exit;
}

try {
    // Vérification si l'e-mail existe déjà pour éviter les doublons
    $stmt = $pdo->prepare("SELECT id FROM newsletter_subscriptions WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(["status" => "success", "message" => "Déjà inscrit"]);
        exit;
    }

    // Insertion du nouvel e-mail
    $stmt = $pdo->prepare("INSERT INTO newsletter_subscriptions (email) VALUES (?)");
    $stmt->execute([$email]);

    echo json_encode(["status" => "success"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Une erreur technique est survenue."]);
}
