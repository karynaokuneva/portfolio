<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>O szyfrach</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .container {
      max-width: 800px;
      margin: 40px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 12px rgba(71, 36, 36, 0.1);
    }

    h1, h2 {
       color:rgb(153, 8, 39);
    }

    p {
      margin-bottom: 15px;
      line-height: 1.6;
    }

    code {
       background-color:rgb(246, 199, 209);
      padding: 2px 5px;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>O szyfrach</h1>

    <h2>Szyfr Cezara</h2>
    <p>Jeden z najprostszych i najstarszych szyfrów. Każda litera tekstu jest przesuwana w alfabecie o określoną liczbę pozycji.</p>
    <p><strong>Przykład:</strong><br>
      Tekst: <code>ABC</code><br>
      Przesunięcie: <code>3</code><br>
      Wynik: <code>DEF</code>
    </p>

    <h2>Szyfr Vigenère’a</h2>
    <p>Bardziej zaawansowana wersja szyfru Cezara. Używa <strong>słowa kluczowego</strong>, które powtarza się nad tekstem. Każda litera tekstu jest szyfrowana z innym przesunięciem w zależności od odpowiadającej litery w kluczu.</p>
    <p><strong>Przykład:</strong><br>
      Tekst: <code>HELLO</code><br>
      Klucz: <code>KEY</code><br>
      Wynik: <code>RIJVS</code>
    </p>

    <h2>Szyfr Atbash</h2>
    <p>Każda litera alfabetu jest zastępowana literą z końca alfabetu: A → Z, B → Y, C → X itd. Ten szyfr nie używa klucza.</p>
    <p><strong>Przykład:</strong><br>
      Tekst: <code>ABCXYZ</code><br>
      Wynik: <code>ZCXYBA</code>
    </p>

    <p>Każdy z tych szyfrów ma swoje zastosowanie edukacyjne. Współczesne systemy bezpieczeństwa używają znacznie bardziej zaawansowanych metod, takich jak AES, RSA czy SHA, ale zrozumienie podstaw to pierwszy krok do zostania specjalistą ds. bezpieczeństwa!</p>
  </div>
</body>
</html>
