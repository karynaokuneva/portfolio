<?php
require_once 'includes/db.php';

// Load all categories from the database
$allCategories = $pdo->query("SELECT * FROM categories")->fetchAll();

// Check if user selected a category for filtering
$selectedCategoryId = $_GET['category_id'] ?? '';

// Load products depending on selected category
if ($selectedCategoryId) {
    // If category selected, load only products from that category
    $stmt = $pdo->prepare("
        SELECT p.*, c.name AS category 
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.category_id = ?
        ORDER BY p.id DESC
    ");
    $stmt->execute([$selectedCategoryId]);
} else {
    // If no category selected, load all products
    $stmt = $pdo->query("
        SELECT p.*, c.name AS category 
        FROM products p
        LEFT JOIN categories c ON p.category_id = c.id
        ORDER BY p.id DESC
    ");
}

// Get all products into array
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Katalog mebli</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="top-header">
    <div class="header-content">

      <!-- Website logo  -->
      <div class="logo">
        <h1>MyMebel</h1>
        <span class="subtitle">Meble na wymiar</span>
      </div>

      <!-- Navigation links -->
      <nav class="main-nav">
        <a href="index.html">Strona Główna</a>
        <a href="catalog.php">Catalog</a>
        <a href="about.html">O nas</a>
        <a href="#uslugi">Usługi</a>
        <a href="contact.html">Kontakt</a>
      </nav>

      <!-- Contact info and social media -->
      <div class="contact-social">
        <span class="phone">📞 +48 123 456 789</span>
        <a href="#"><img src="images/facebook.svg" alt="Facebook" class="icon"></a>
        <a href="#"><img src="images/instagram.svg" alt="Instagram" class="icon"></a>
        <a href="login.php" class="profile-link">
          <img src="images/login.png" alt="Mój profil" class="icon">
        </a>
      </div>

    </div>
  </header>

  <form method="GET" style=" margin-left: 30px; margin-bottom: 60px;">
  <h1>Katalog mebli</h1>

  <!-- Category filter form -->
  <form method="GET" style=" margin-left: 30px; margin-bottom: 60px;">
    <label>Filtruj według kategorii:</label>
    <select name="category_id" onchange="this.form.submit()" style=" margin-left: 15px; padding:8px 24px; font-size:16px; margine: 30px;">
      <option value="">-- Wszystkie --</option>
      <?php foreach ($allCategories as $cat): ?>
        <!-- Mark category as selected if it matches user selection -->
        <option value="<?= $cat['id'] ?>" <?= $selectedCategoryId == $cat['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($cat['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </form>

  <!-- Grid with product cards -->
  <div class="catalog-grid">
    <?php foreach ($products as $product): ?>
      <div class="catalog-card">
        <!-- Product image -->
        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>">

        <!-- Product title -->
        <h2><?= htmlspecialchars($product['title']) ?></h2>

        <!-- Category name (from JOIN) -->
        <p class="category"><?= htmlspecialchars($product['category']) ?></p>

        <!-- Short description -->
        <p><?= htmlspecialchars($product['description']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <footer class="footer">
    <div class="container">
      <p>&copy; 2025 MyMebel | Designed by Karina</p>
    </div>
  </footer>

</body>
</html>
