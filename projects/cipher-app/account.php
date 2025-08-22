<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Twoje konto</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Witamy, <?php echo htmlspecialchars($_SESSION["user"]); ?>!</h1>
    <p>To jest strona konta prywatnego. Tutaj możesz:</p>
    <ul>
      <li>Zapisywać i szyfrować wiadomości</li>
      <li>Wyświetlać zaszyfrowane notatki</li>
      <li>Pobierać swoje wiadomości jako plik</li>
      <li>Wylogować się</li>
    </ul>

    <!-- Wylogowanie -->
    <form method="POST" action="logout.php">
      <button type="submit">Wylogować się</button>
    </form>

    <hr>
    <!-- Formularz szyfrowania wiadomości -->
    <h2>Zapisz zaszyfrowaną wiadomość</h2>
    <form method="POST" action="">
      <label for="message">Twoja wiadomość:</label>
      <textarea name="message" rows="4" required></textarea>

      <label for="key">Słowo kluczowe:</label>
      <input type="text" name="key" required>

      <button type="submit" name="save">Zaszyfruj i zapisz</button>
    </form>

    <?php
    function vigenere($text, $key) {
        $text = strtoupper($text);
        $key = strtoupper($key);
        $result = "";
        $keyIndex = 0;

        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];
            if (ctype_alpha($char)) {
                $k = $key[$keyIndex % strlen($key)];
                $shift = ord($k) - 65;
                $enc = chr(((ord($char) - 65 + $shift) % 26) + 65);
                $result .= $enc;
                $keyIndex++;
            } else {
                $result .= $char;
            }
        }

        return $result;
    }

    if (isset($_POST["save"])) {
        $msg = $_POST["message"];
        $key = $_POST["key"];
        $user = $_SESSION["user"];
        $cipher = vigenere($msg, $key);

        $entry = "Klucz: $key\nWiadomość: $cipher\n---\n";
        $filename = "messages_" . str_replace("@", "_", $user) . ".txt";

        file_put_contents($filename, $entry, FILE_APPEND);
        echo "<p><strong>Wiadomość została zaszyfrowana i zapisana!</strong></p>";
    }
    ?>

    <hr>
    <!-- Wyświetlanie wiadomości -->
    <h2>Twoje zapisane wiadomości:</h2>
    <?php
    $filename = "messages_" . str_replace("@", "_", $_SESSION["user"]) . ".txt";
    if (file_exists($filename)) {
        $messages = file($filename, FILE_IGNORE_NEW_LINES);
        echo "<pre>";
        foreach ($messages as $line) {
            echo htmlspecialchars($line) . "\n";
        }
        echo "</pre>";
    } else {
        echo "<p>Brak zapisanych wiadomości.</p>";
    }
    ?>

    <!-- Pobieranie pliku -->
    <form method="POST" action="download.php">
      <button type="submit">Pobierz wiadomości jako plik .txt</button>
    </form>

  </div>
</body>
</html>
