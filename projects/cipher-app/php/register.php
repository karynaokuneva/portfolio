<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Rejestracja</h1>
    <form method="POST" action="">
      <label for="login">Login:</label>
      <input type="text" name="login" required>

      <label for="password">Hasło:</label>
      <input type="password" name="password" required>

      <button type="submit">Zarejestruj się</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $login = trim($_POST["login"]);
        $password = trim($_POST["password"]);

        if ($login && $password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // haszowanie haslsa
            $entry = "$login|$hashedPassword\n";

            file_put_contents("users.txt", $entry, FILE_APPEND);
            echo "<p>User <strong>$login</strong> registered successfully!</p>";
        } else {
            echo "<p>Please fill in all fields.</p>";
        }
    }
    ?>
  </div>
</body>
</html>
