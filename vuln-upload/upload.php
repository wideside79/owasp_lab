<?php
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $upload_dir = "uploads/";
    $upload_file = $upload_dir . basename($file['name']);

    // Vulnérabilité : PAS de filtre sur l'extension ni MIME
    if (move_uploaded_file($file['tmp_name'], $upload_file)) {
        echo "✅ Fichier uploadé avec succès !<br>";
        echo "<a href='$upload_file'>Clique ici pour l'exécuter</a>";
    } else {
        echo "❌ Erreur pendant l'upload.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload vulnérable</title>
</head>
<body>
    <h2>Uploader un fichier</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required><br><br>
        <input type="submit" value="Uploader">
    </form>
</body>
</html>
