<?php
// Les cookies doivent être envoyés avant tout HTML
setcookie("username", "khalid", time() + 3600, "/");
setcookie("PHPSESSID", "session12345", time() + 3600, "/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Démonstration XSS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            background-color: #f4f4f4;
        }
        input[type="text"] {
            padding: 10px;
            width: 250px;
        }
        input[type="submit"] {
            padding: 10px;
        }
        .result {
            margin-top: 30px;
            background-color: #fff;
            padding: 20px;
            border-left: 5px solid #4CAF50;
        }
    </style>
</head>
<body>
    <h2>Bienvenue sur notre site !</h2>
    <form method="GET">
        <label>Entrez votre nom :</label>
        <input type="text" name="name">
        <input type="submit" value="Envoyer">
    </form>

    <div class="result">
        <h3>Résultat :</h3>
        <p>
            Bonjour,
            <?php
                if (isset($_GET['name'])) {
                    echo $_GET['name']; // Vulnérabilité XSS ici
                }
            ?>
        </p>
    </div>
</body>
</html>
