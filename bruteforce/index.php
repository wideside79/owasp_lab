<?php
session_start();

// Code PIN secret (en dur ici pour la démo)
$secret_pin = "4729";

$message = "";
$attempt = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attempt = isset($_POST['pin']) ? trim($_POST['pin']) : '';

    if ($attempt === $secret_pin) {
        $message = "<div class='success'>🎉 Bravo ! Vous avez trouvé le bon code PIN.</div>";
    } else {
        $message = "<div class='error'>❌ Code PIN incorrect. Réessayez !</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>🔐 Code PIN à Craquer</title>
    <style>
        body {
            background: #1a1a2e;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #16213e;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            width: 350px;
            text-align: center;
        }
        h1 {
            color: #e94560;
            margin-bottom: 25px;
        }
        input[type="text"] {
            width: 100%;
            padding: 14px 12px;
            font-size: 18px;
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
            text-align: center;
            letter-spacing: 4px;
        }
        input[type="submit"] {
            background-color: #e94560;
            border: none;
            color: white;
            font-weight: 700;
            padding: 14px 0;
            font-size: 18px;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #d7374c;
        }
        .success {
            background-color: #3cb371;
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .error {
            background-color: #e94560;
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .note {
            font-size: 13px;
            color: #bbb;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔐 Code PIN à Craquer</h1>

        <?php if ($message): ?>
            <?= $message ?>
        <?php endif; ?>

        <form method="post" autocomplete="off">
            <input type="text" name="pin" maxlength="4" pattern="\d{4}" placeholder="Entrez le code PIN (4 chiffres)" required value="<?= htmlspecialchars($attempt) ?>" autofocus>
            <input type="submit" value="Tester le PIN">
        </form>
        <p class="note">Indice : Le code PIN est un nombre à 4 chiffres.</p>
    </div>
</body>
</html>
