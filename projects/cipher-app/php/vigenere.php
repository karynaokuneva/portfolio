<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Szyfr Vigenère’a</title>
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

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
    }

    textarea, input[type="text"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      background-color:rgb(210, 25, 74);
      color: white;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color:rgb(153, 8, 39);
    }

    .result {
      margin-top: 20px;
      background: #eef;
      padding: 15px;
      border-radius: 6px;
      white-space: pre-wrap;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Szyfr Vigenère’a</h1>
    <form method="POST">
      <label for="text">Tekst do zaszyfrowania:</label>
      <textarea name="text" rows="4" required></textarea>

      <label for="key">Słowo kluczowe:</label>
      <input type="text" name="key" required>

      <div class="buttons">
        <button type="submit" name="encrypt">Szyfruj</button>
        <button type="submit" name="decrypt">Deszyfruj</button>
      </div>
    </form>

    <?php
    function vigenere($text, $key, $decrypt = false) {
        $text = strtoupper($text);
        $key = strtoupper($key);
        $result = "";
        $keyIndex = 0;

        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];
            if (ctype_alpha($char)) {
                $shift = ord($key[$keyIndex % strlen($key)]) - 65;
                if ($decrypt) {
                    $shift = -$shift;
                }
                $offset = (ord($char) - 65 + $shift + 26) % 26;
                $result .= chr($offset + 65);
                $keyIndex++;
            } else {
                $result .= $char;
            }
        }

        return $result;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $text = $_POST["text"];
        $key = $_POST["key"];

        if (isset($_POST["encrypt"])) {
            $output = vigenere($text, $key, false);
            echo "<div class='result'><strong>Zaszyfrowany tekst:</strong><br>$output</div>";
        }

        if (isset($_POST["decrypt"])) {
            $output = vigenere($text, $key, true);
            echo "<div class='result'><strong>Odszyfrowany tekst:</strong><br>$output</div>";
        }
    }
    ?>
  </div>
</body>
</html>
