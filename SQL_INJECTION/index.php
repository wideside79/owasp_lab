<?php
$conn = new mysqli("localhost", "root", "", "vuln_training");

// Initialiser les variables
$message = "";
$debug_query = "";

// Ne traiter que si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // ❌ Vulnérable à l'injection SQL
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    // Affichage de la requête pour le débogage
    $debug_query = "<pre><code>$query</code></pre>";

    if ($result && $result->num_rows > 0) {
        $message = "<div class='message success'>🎉 Bienvenue, <strong>" . htmlspecialchars($username) . "</strong> !</div>";
    } else {
        $message = "<div class='message error'>❌ Identifiants incorrects.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Portail Étudiant</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            border-top: 6px solid #4CAF50;
        }

        .login-container h2 {
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 14px 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #43a047;
        }

        .message {
            margin-top: 20px;
            padding: 12px;
            border-radius: 8px;
            font-size: 15px;
        }

        .success {
            background-color: #e6ffed;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }

        .error {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
        }

        pre {
            margin-top: 20px;
            background-color: #eee;
            padding: 10px;
            border-radius: 8px;
            text-align: left;
            overflow-x: auto;
            font-size: 13px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>🎓 Portail Étudiant - Connexion</h2>

        <?= $message ?>
        <?= $debug_query ?>

        <form method="post" autocomplete="off">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" value="Connexion">
        </form>
    </div>
</body>
</html>
