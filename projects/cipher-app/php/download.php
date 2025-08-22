<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$filename = "messages_" . str_replace("@", "_", $_SESSION["user"]) . ".txt";

if (file_exists($filename)) {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    readfile($filename);
    exit;
} else {
    echo "Nie znaleziono pliku z wiadomościami.";
}
?>
