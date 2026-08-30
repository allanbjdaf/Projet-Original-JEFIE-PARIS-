<?php

declare(strict_types=1);

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Ne jamais laisser PHP cracher des warnings/notices dans la réponse :
// ça casse le JSON côté client (fetch().json() plante -> message générique).
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

// Passe à false une fois que tout fonctionne, pour ne pas exposer
// les détails techniques (structure de la base, etc.) au client final.
const DEBUG = true;

// ⚠️ Pas de type de retour "never" ici (nécessite PHP 8.1+).
// Beaucoup d'hébergements OVH mutualisés tournent encore en 7.4 / 8.0,
// et "never" y provoque une erreur fatale de syntaxe -> 500 sans JSON.
function respond(array $payload)
{
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

// Requête préflight CORS (si jamais appelé depuis un autre domaine un jour)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    respond(["status" => "error", "message" => "Méthode non autorisée."]);
}

// 🔑 Identifiants OVH
$host     = "jefiepvjefie.mysql.db";
$dbname   = "jefiepvjefie";
$username = "jefiepvjefie";
$password = "AllanBjdaffney2000";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    respond([
        "status"  => "error",
        "message" => DEBUG
            ? "Connexion DB impossible : " . $e->getMessage()
            : "Impossible de se connecter à la base de données.",
    ]);
}

// 🌟 Lire le JSON brut envoyé par fetch() — $_POST est TOUJOURS vide ici
// car le front-end envoie Content-Type: application/json.
$raw  = file_get_contents('php://input');
$body = json_decode($raw ?: '', true);

// On accepte aussi un envoi classique en secours (form-urlencoded).
$emailRaw = isset($body['email']) ? $body['email'] : (isset($_POST['email']) ? $_POST['email'] : '');
$email    = filter_var(trim((string) $emailRaw), FILTER_VALIDATE_EMAIL);

if (!$email) {
    http_response_code(422);
    respond(["status" => "error", "message" => "Adresse e-mail non valide."]);
}

try {
    // Vérification anti-doublon
    $stmt = $pdo->prepare("SELECT id FROM newsletter_subscriptions WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        respond(["status" => "success", "message" => "Déjà inscrit"]);
    }

    // Insertion
    $stmt = $pdo->prepare("INSERT INTO newsletter_subscriptions (email, created_at) VALUES (?, NOW())");
    $stmt->execute([$email]);

    respond(["status" => "success", "message" => "Inscription enregistrée"]);
} catch (Exception $e) {
    http_response_code(500);
    respond([
        "status"  => "error",
        "message" => DEBUG
            ? "Détail de l'erreur : " . $e->getMessage()
            : "Une erreur est survenue, veuillez réessayer.",
    ]);
}
