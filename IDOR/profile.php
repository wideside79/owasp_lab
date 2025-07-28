<?php
session_start();

// Simuler la connexion d'un utilisateur (user_id = 2)
$_SESSION['user_id'] = 2;

$users = [
    1 => ['name' => 'Alice', 'email' => 'alice@example.com', 'role' => 'admin'],
    2 => ['name' => 'Bob', 'email' => 'bob@example.com', 'role' => 'user'],
    3 => ['name' => 'Charlie', 'email' => 'charlie@example.com', 'role' => 'user'],
];

// Récupération du paramètre user_id, supposé présent dans l'URL
if (!isset($_GET['user_id'])) {
    echo "Paramètre user_id manquant.";
    exit;
}

$user_id = (int) $_GET['user_id'];

if (!isset($users[$user_id])) {
    echo "Utilisateur introuvable.";
    exit;
}

$user = $users[$user_id];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Profil Utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
        .profile {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0,0,0,0.05);
        }
        .info {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .note {
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
        code {
            background: #eee;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h1>Profil Utilisateur</h1>
    <div class="profile">
        <div class="info"><strong>Nom :</strong> <?= htmlspecialchars($user['name']) ?></div>
        <div class="info"><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></div>
        <div class="info"><strong>Rôle :</strong> <?= htmlspecialchars($user['role']) ?></div>
    </div>

    <div class="note">
        Vous êtes connecté en tant que : <strong>User ID <?= $_SESSION['user_id'] ?></strong><br>
        Modifiez le paramètre <code>user_id</code> dans l’URL pour voir d’autres profils (IDOR).
    </div>
</body>
</html>
