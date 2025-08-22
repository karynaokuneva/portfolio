<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Projekt: Szyfrowanie danych</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fcd3dd;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 40px auto;
      padding: 30px;
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    img {
      width: 100%;
      max-width: 400px;
      height: auto;
      display: block;
      margin: 0 auto 30px;
      border-radius: 12px;
    }

    h1 {
      color: #b00050;
      margin-bottom: 10px;
    }

    .user {
      margin-bottom: 20px;
      font-size: 14px;
      color: #666;
    }

    .menu {
      display: flex;
      flex-direction: column;
      gap: 12px;
      align-items: center;
      margin-top: 30px;
    }

    .menu a {
      text-decoration: none;
      background-color:rgb(210, 25, 74);
      color: white;
      padding: 12px 20px;
      border-radius: 8px;
      font-size: 16px;
      width: 70%;
      max-width: 300px;
      transition: background-color 0.3s;
    }

    .menu a:hover {
      background-color:rgb(153, 8, 39);
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="imag1.png" alt="Projekt: Szyfrowanie danych">

    <h1>Projekt: Szyfrowanie danych</h1>

    <?php if (isset($_SESSION["user"])): ?>
      <p class="user">Zalogowany jako: <strong><?php echo htmlspecialchars($_SESSION["user"]); ?></strong></p>
    <?php endif; ?>

    <div class="menu">
      <a href="vigenere.php">🔐 Szyfr Vigenère’a</a>
      <a href="caesar.php">🗝️ Szyfr Cezara</a>
      <a href="atbash.php">🔄 Szyfr Atbash</a>
      <a href="info.php">📘 O szyfrach</a>
      <a href="register.php">✍️ Zarejestruj się</a>
      <a href="login.php">🔑 Zaloguj się</a>
      <a href="account.php">👤 Moje konto</a>
    </div>
  </div>
</body>
</html>
