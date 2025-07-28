<?php
$conn = new mysqli("localhost", "root", "", "vuln_training");
if ($conn->connect_error) die("Erreur de connexion : " . $conn->connect_error);

$message = "";
$products = []; // tableau pour stocker toutes les lignes renvoyées

// Récupération de tous les produits pour la liste déroulante
$productsList = [];
$res = $conn->query("SELECT id, name FROM products ORDER BY name");
if ($res) {
    while ($row = $res->fetch_assoc()) {
        $productsList[] = $row;
    }
}

if (isset($_GET['product_id']) && $_GET['product_id'] !== '') {
    $product_id = $_GET['product_id']; // vulnérable, pas d'échappement

    // Requête vulnérable SQL Injection UNION (3 colonnes)
    $query = "SELECT id, name, description FROM products WHERE id = $product_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        // Récupérer toutes les lignes
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        $message = "<div class='error'>Produit non trouvé.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Catalogue Produits - Injection SQL UNION</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f7f9fc;
        margin: 0; padding: 40px;
        display: flex; justify-content: center; align-items: flex-start; min-height: 100vh;
    }
    .container {
        background: white;
        border-radius: 12px;
        padding: 30px 40px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        width: 500px;
    }
    h1 {
        color: #222;
        text-align: center;
        margin-bottom: 25px;
    }
    select {
        width: 100%;
        padding: 14px 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 16px;
        margin-bottom: 25px;
        cursor: pointer;
        transition: border-color 0.3s ease;
    }
    select:focus {
        outline: none;
        border-color: #4caf50;
    }
    .product-info {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        border-radius: 10px;
        padding: 20px;
        font-size: 16px;
        color: #2e7d32;
        margin-bottom: 20px;
    }
    .error {
        background-color: #ffebee;
        border: 1px solid #ef9a9a;
        color: #c62828;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    code {
        display: block;
        background: #eee;
        padding: 10px 15px;
        border-radius: 6px;
        margin-top: 15px;
        font-size: 14px;
        color: #444;
        white-space: pre-wrap;
        word-break: break-all;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>Catalogue Produits</h1>

        <form method="get" action="">
            <label for="product_id">Choisissez un produit :</label>
            <select name="product_id" id="product_id" onchange="this.form.submit()">
                <option value="">-- Sélectionnez --</option>
                <?php foreach ($productsList as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= (isset($_GET['product_id']) && $_GET['product_id'] == $p['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <?php if ($message): ?>
            <?= $message ?>
        <?php elseif (!empty($products)): ?>
            <?php foreach ($products as $prod): ?>
                <div class="product-info">
                    <h2><?= htmlspecialchars($prod['name']) ?></h2>
                    <p><?= nl2br(htmlspecialchars($prod['description'])) ?></p>
                    <p><strong>ID produit :</strong> <?= htmlspecialchars($prod['id']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Sélectionnez un produit pour afficher ses détails.</p>
        <?php endif; ?>

        <hr>
    </div>
</body>
</html>
