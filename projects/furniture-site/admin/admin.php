<?php
session_start();
require_once '../includes/db.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    die("Brak dostępu. Tylko administrator ma dostęp do tej strony.");
}

$message = "";

// Handle product deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = (int)$_POST['delete_id'];

    // Get product image path from database
    $stmt = $pdo->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    if ($product) {
        // Remove image file from server
        $imagePath = "../" . $product['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Remove product from database
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $message = "Produkt został usunięty.";
    }
}

// Handle adding a new product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && isset($_POST['category_id'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $categoryId = (int)$_POST['category_id'];
    $imagePath = '';

    // Upload image to folder
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $filename = basename($_FILES['image']['name']);
        $filename = preg_replace('/[^a-zA-Z0-9\._-]/', '_', $filename); // clean filename
        $targetDir = "../images/uploads/";
        $targetFile = $targetDir . time() . "_" . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Save relative image path to DB
            $imagePath = "images/uploads/" . basename($targetFile);
        } else {
            $message = "Nie udało się przesłać zdjęcia.";
        }
    }

    // Add product to database if all fields are correct
    if ($title && $description && $imagePath && $categoryId) {
        $stmt = $pdo->prepare("INSERT INTO products (title, description, category_id, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $description, $categoryId, $imagePath]);
        $message = "Produkt został dodany!";
    } else {
        $message = "Wypełnij wszystkie pola i załaduj zdjęcie.";
    }
}

// Load all categories for dropdown list
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

// Load all products with category name using JOIN
$products = $pdo->query("
    SELECT p.*, c.name AS category 
    FROM products p 
    LEFT JOIN categories c ON p.category_id = c.id 
    ORDER BY p.id DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <title>Panel admina</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<form method="GET" style=" margin-left: 30px; margin-bottom: 60px;">
  <h1>Panel administracyjny</h1>
  <p>Witaj, <?= htmlspecialchars($_SESSION['username']) ?>!</p>

  <?php if ($message): ?>
    <p style="color:green;"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

  <!-- Form for adding a new product -->
  <form action="admin.php" method="POST" enctype="multipart/form-data">
    <label>Nazwa produktu:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Opis:</label><br>
    <textarea name="description" rows="4" required></textarea><br><br>

    <label>Kategoria:</label><br>
    <select name="category_id" required>
      <option value="">-- wybierz kategorię --</option>
      <?php foreach ($categories as $cat): ?>
        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
      <?php endforeach; ?>
    </select><br><br>

    <label>Zdjęcie:</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>

    <button type="submit">Dodaj produkt</button>
  </form>

  <hr><br>

  <h2>Wszystkie produkty</h2>

  <div class="catalog-grid">
    <?php foreach ($products as $product): ?>
      <div class="catalog-card">
        <img src="../<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>">
        <h2><?= htmlspecialchars($product['title']) ?></h2>
        <p class="category"><?= htmlspecialchars($product['category']) ?></p>
        <p><?= htmlspecialchars($product['description']) ?></p>

        <!-- Button for deleting a product -->
        <form method="post" onsubmit="return confirm('Czy na pewno chcesz usunąć ten produkt?');">
          <input type="hidden" name="delete_id" value="<?= $product['id'] ?>">
          <button type="submit" style="background:#c0392b;color:white;padding:8px 16px;border:none;border-radius:6px;">Usuń</button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>

</body>
</html>
