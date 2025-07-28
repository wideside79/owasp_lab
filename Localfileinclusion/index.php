<?php
// --- ATTENTION : Fichier vulnérable à LFI pour des démonstrations pédagogiques uniquement ---
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page vulnérable - LFI</title>
    <style>
        body {
            background-color: #121212;
            color: #00ff00;
            font-family: Consolas, monospace;
            padding: 20px;
        }
        h1 {
            color: #00ffcc;
        }
        nav a {
            margin-right: 15px;
            color: #00ffcc;
            text-decoration: none;
        }
        .box {
            border: 1px solid #00ff00;
            padding: 20px;
            margin-top: 20px;
            background-color: #1e1e1e;
        }
    </style>
</head>
<body>
    <h1>💀 Démo LFI (Local File Inclusion)</h1>
    <nav>
        <a href="?page=home.php">Accueil</a>
        <a href="?page=about.php">À propos</a>
        <a href="?page=contact.php">Contact</a>
    </nav>

    <div class="box">
        <h2>Contenu dynamique :</h2>
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            echo "<p><strong>Page incluse :</strong> <code>$page</code></p>";
            
            // Vulnérabilité : inclusion directe sans vérification
            include($page);
        } else {
            echo "<p>Bienvenue sur le site ! Utilisez le menu pour naviguer.</p>";
        }
        ?>
    </div>

    <footer style="margin-top: 50px; font-size: 0.9em; color: #888;">
        ⚠️ Cette page est vulnérable à LFI (Local File Inclusion). À ne jamais utiliser en production !
    </footer>
</body>
</html>
