<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Logowanie</h1>
    <form method="POST" action="">
      <label for="login">Login:</label>
      <input type="text" name="login" required>

      <label for="password">Hasło:</label>
      <input type="password" name="password" required>

      <button type="submit">Login</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $login = trim($_POST["login"]);
        $password = trim($_POST["password"]);
        $success = false;

        $lines = file("users.txt", FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            list($storedLogin, $storedHash) = explode("|", $line);
            if ($storedLogin === $login && password_verify($password, $storedHash)) {
                $success = true;
                break;
            }
        }

        if ($success) {
            session_start();
            $_SESSION["user"] = $login;
            header("Location: account.php");
            exit;
        } else {
            echo "<p>Invalid login or password.</p>";
        }
    }
    ?>
  </div>
</body>
</html>
