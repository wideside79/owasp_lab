<?php
// Si pas de paramètre url, on force un url par défaut
$url = isset($_GET['url']) ? $_GET['url'] : "https://example.com";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Open Redirect Vulnérable - Lab réaliste</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: #f4f6f8;
    padding: 40px;
  }
  .container {
    background: white;
    padding: 30px;
    max-width: 600px;
    margin: auto;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }
  label {
    font-weight: bold;
    display: block;
    margin-bottom: 10px;
  }
  input[type=text] {
    width: 100%;
    padding: 12px 10px;
    margin-bottom: 20px;
    font-size: 16px;
    border: 2px solid #ddd;
    border-radius: 8px;
  }
  input[type=submit] {
    background: #007bff;
    color: white;
    border: none;
    padding: 14px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
  }
  input[type=submit]:hover {
    background: #0056b3;
  }
  p.note {
    font-size: 14px;
    color: #666;
  }
</style>
</head>
<body>
  <div class="container">
    <h1>Lab Open Redirect - Exemple réaliste</h1>

    <p class="note">
      L'URL en barre contient déjà le paramètre <code>?url=...</code><br>
      Modifiez-le ou cliquez sur "Rediriger" pour tester la vulnérabilité.
    </p>

    <form id="redirectForm" method="get" action="">
      <label for="urlInput">URL de redirection :</label>
      <input type="text" id="urlInput" name="url" value="<?= htmlspecialchars($url) ?>" />

      <input type="submit" value="Rediriger" />
    </form>
  </div>

  <script>
    // Met à jour l'URL dans la barre sans recharger la page (history.pushState)
    const urlInput = document.getElementById('urlInput');
    function updateURLParam() {
      const val = encodeURIComponent(urlInput.value);
      const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?url=" + val;
      window.history.replaceState({}, '', newUrl);
    }

    urlInput.addEventListener('input', updateURLParam);
    updateURLParam();

    // Redirection à la soumission
    document.getElementById('redirectForm').addEventListener('submit', function(e){
      e.preventDefault();
      const url = urlInput.value.trim();
      if (url) {
        window.location.href = url; // **redirection vulnérable**
      }
    });
  </script>
</body>
</html>
