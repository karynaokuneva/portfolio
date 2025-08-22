<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Szyfr Cezara</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .container {
      max-width: 600px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }
    textarea, input[type="number"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      font-size: 16px;
    }
    button {
      padding: 10px 20px;
      margin: 10px 5px;
      font-size: 16px;
      
      background-color:rgb(210, 25, 74);
      color: #fff;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    button:hover {
       background-color:rgb(153, 8, 39);
    }
    h1 {
      text-align: center;
    }
    .result {
      background: #eef;
      padding: 15px;
      margin-top: 15px;
      border-radius: 6px;
      white-space: pre-wrap;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Szyfr Cezara</h1>
    <form method="POST">
      <label for="text">Tekst:</label>
      <textarea name="text" rows="4" required></textarea>

      <label for="shift">Przesunięcie (1–25):</label>
      <input type="number" name="shift" min="1" max="25" required>

      <button type="submit" name="encrypt">Szyfruj</button>
      <button type="submit" name="decrypt">Deszyfruj</button>
    </form>

    <?php
    function caesar($text, $shift, $decrypt = false) {
        $result = "";
        $shift = $decrypt ? (26 - $shift) : $shift;

        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];
            if (ctype_alpha($char)) {
                $isLower = ctype_lower($char);
                $base = $isLower ? ord('a') : ord('A');
                $result .= chr(($ord = ord($char) - $base + $shift) % 26 + $base);
            } else {
                $result .= $char;
            }
        }

        return $result;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $text = $_POST["text"];
        $shift = intval($_POST["shift"]);

        if (isset($_POST["encrypt"])) {
            $output = caesar($text, $shift);
            echo "<div class='result'><strong>Zaszyfrowany tekst:</strong><br>$output</div>";
        }

        if (isset($_POST["decrypt"])) {
            $output = caesar($text, $shift, true);
            echo "<div class='result'><strong>Odszyfrowany tekst:</strong><br>$output</div>";
        }
    }
    ?>
  </div>
</body>
</html>
