<?php
$conn = new mysqli("localhost", "root", "", "vuln_training");
$message = "";

// Suppression utilisateur si id passé en GET (vulnérable CSRF)
if (isset($_GET['delete_user_id'])) {
    $id = intval($_GET['delete_user_id']);
    $conn->query("DELETE FROM users WHERE id = $id");
    $message = "Utilisateur avec ID $id supprimé.";
}

// Récupération liste utilisateurs
$result = $conn->query("SELECT id, username FROM users");
$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Gestion Utilisateurs - Vulnérable CSRF</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>

    <?php if ($message): ?>
        <p style="color:green"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <?= htmlspecialchars($user['username']) ?> 
                - <a href="?delete_user_id=<?= $user['id'] ?>" onclick="return confirm('Supprimer cet utilisateur ?');">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <p style="color:red;">⚠️ Cette page est vulnérable à CSRF, pas de protection !</p>
</body>
</html>
