<?php
$message = "";
$content = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['xmlfile'])) {
    $xmlFile = $_FILES['xmlfile']['tmp_name'];
    libxml_disable_entity_loader(false); // Activation des entités externes (vulnérable)

    $xml = file_get_contents($xmlFile);

    $dom = new DOMDocument();
    try {
        $dom->loadXML($xml, LIBXML_NOENT | LIBXML_DTDLOAD);
        $content = $dom->textContent;
        $message = "Fichier XML parsé avec succès.";
    } catch (Exception $e) {
        $message = "Erreur lors du parsing XML : " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Démo XXE - Upload XML vulnérable</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f9f9f9;
        }
        textarea {
            width: 100%;
            height: 150px;
            margin-top: 15px;
            font-family: monospace;
            font-size: 14px;
        }
        input[type="submit"] {
            background: #0057e7;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .message {
            margin-top: 15px;
            color: green;
        }
    </style>
</head>
<body>
    <h1>Démo XXE - Upload XML vulnérable</h1>
    <form method="post" enctype="multipart/form-data">
        <label for="xmlfile">Choisissez un fichier XML :</label><br>
        <input type="file" name="xmlfile" id="xmlfile" required>
        <br><br>
        <input type="submit" value="Parser le XML">
    </form>

    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <?php if ($content): ?>
        <h2>Contenu extrait :</h2>
        <textarea readonly><?= htmlspecialchars($content) ?></textarea>
    <?php endif; ?>
</body>
</html>
