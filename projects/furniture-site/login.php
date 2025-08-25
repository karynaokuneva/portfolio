<?php
session_start(); // запускаем сессию
require_once 'includes/db.php'; // подключение к базе

$error = '';

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Get user input from form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

   // Find user in database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

// If user exists and password is correct
    if ($user && password_verify($password, $user['password'])) {
        // Успешный вход
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: admin/admin.php"); // переходим в админку
        exit;
    } else {
        $error = "Nieprawidłowy login lub hasło";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Logowanie</title>
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

<!-- Login form for users -->
  <div class="login-box">
    <h2>Zaloguj się</h2>
    <?php if ($error): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
      <input type="text" name="username" placeholder="Nazwa użytkownika" required>
      <input type="password" name="password" placeholder="Hasło" required>
      <button type="submit">Zaloguj</button>
      <p>Nie masz konta? <a href="register.php">Zarejestruj się</a></p>

    </form>
  </div>

  <footer class="footer">
    <div class="container">
      <p>&copy; 2025 MyMebel | Designed with love by Karina</p>
    </div>
  </footer>

</body>
</html>
