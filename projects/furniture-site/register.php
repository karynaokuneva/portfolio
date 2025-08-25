<?php
require_once 'includes/db.php'; // подключение к базе
$error = '';
$success = '';

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Get user input from form

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if ($username === '' || $password === '' || $confirm === '') {
        $error = "Wszystkie pola są wymagane.";
    } elseif ($password !== $confirm) {
        $error = "Hasła nie są takie same.";
    } else {
          // Check if username already exists in DB
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            $error = "Taki użytkownik już istnieje.";
        } else {

           // Hash the password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Save new user to DB
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hash]);
            $success = "Rejestracja zakończona sukcesem. Możesz się teraz zalogować.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Rejestracja</title>

    <!-- Load external stylesheet -->

  <link rel="stylesheet" href="css/style.css">
</head>
<body>


 <header class="top-header">
    <div class="header-content">
      <div class="logo">

        <h1>MyMebel</h1> 
        
        <span class="subtitle">Meble na wymiar</span>
      </div>
      <nav class="main-nav">
        <a href="index.html">Strona Glówna</a>
        <a href="catalog.php">Catalog</a>
        <a href="about.html">O nas</a>
        <a href="#uslugi">Usługi</a>
        <a href="contact.html">Kontakt</a>
      </nav>

    
      <div class="contact-social">
        <span class="phone">📞 +48 123 456 789</span>
        <a href="#"><img src="images/facebook.svg" alt="Facebook" class="icon"></a>
        <a href="#"><img src="images/instagram.svg" alt="Instagram" class="icon"></a>
        <a href="login.php" class="profile-link"><img src="images/login.png" alt = "Mój profil" class = "icon"></a>

      </div>
    </div>
  </header>

<!-- Container with registration form -->
  <div class="login-box">
    <h2>Rejestracja</h2>

    <?php if ($error): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
      <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post">
      <input type="text" name="username" placeholder="Nazwa użytkownika" required>
      <input type="password" name="password" placeholder="Hasło" required>
      <input type="password" name="confirm" placeholder="Powtórz hasło" required>
      <button type="submit">Zarejestruj się</button>
    </form>

    <p>Masz już konto? <a href="login.php">Zaloguj się</a></p>
  </div>

</body>
</html>
