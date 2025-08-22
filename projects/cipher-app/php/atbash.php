<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Szyfr Atbash</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
    }

    textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      background-color:rgb(210, 25, 74);
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color:rgb(153, 8, 39);
    }

    .result {
      background: #eef;
      padding: 15px;
      border-radius: 6px;
      margin-top: 15px;
      white-space: pre-wrap;
    }

    h1 {
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Szyfr Atbash</h1>
    <form method="POST">
      <label for="text">Wprowadź tekst:</label>
      <textarea name="text" rows="4" required></textarea>
      <button type="submit" name="convert">Zaszyfruj</button>
    </form>

    <?php
    function atbash($text) {
        $result = '';
        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];
            if (ctype_upper($char)) {
                $result .= chr(155 - ord($char)); // 65 + 90 = 155
            } elseif (ctype_lower($char)) {
                $result .= chr(219 - ord($char)); // 97 + 122 = 219
            } else {
                $result .= $char;
            }
        }
        return $result;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["convert"])) {
        $text = $_POST["text"];
        $output = atbash($text);
        echo "<div class='result'><strong>Wynik szyfrowania:</strong><br>$output</div>";
    }
    ?>
  </div>
</body>
</html>
