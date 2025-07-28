<?php
$output = "";
if (isset($_GET['ip'])) {
    $ip = $_GET['ip']; // vulnérable, pas d'échappement
    // Exécution de la commande ping
    $cmd = "ping -c 3 " . $ip; // sur Linux (change pour -n 3 si Windows)
    exec($cmd, $output);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Commande ping - Vulnérabilité Command Injection</title>
<style>
    body { font-family: Arial; background:#fafafa; padding:20px; }
    input[type=text] { width: 300px; padding: 8px; }
    input[type=submit] { padding: 8px 15px; background:#2196F3; color:#fff; border:none; cursor:pointer; }
    pre { background:#eee; padding: 15px; border-radius: 5px; }
</style>
</head>
<body>
    <h1>Ping - Test Command Injection</h1>
    <form method="get">
        <label for="ip">Adresse IP ou hostname :</label><br>
        <input type="text" id="ip" name="ip" placeholder="ex: 8.8.8.8 ou google.com" required>
        <input type="submit" value="Lancer le ping">
    </form>

    <?php if ($output): ?>
        <h2>Résultat :</h2>
        <pre><?= htmlspecialchars(implode("\n", $output)) ?></pre>
    <?php endif; ?>
</body>
</html>
