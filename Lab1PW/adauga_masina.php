<?php
session_start();
$mysqli = include 'conectare.php';

// Verificăm dacă utilizatorul e logat și e admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
  echo "unauthorized";
  exit();
}

if (isset($_POST['nume'], $_POST['descriere'], $_POST['imagine'], $_POST['pret'])) {
  $nume = $_POST['nume'];
  $descriere = $_POST['descriere'];
  $imagine = $_POST['imagine']; // numele fișierului (ex: "Poza1.jpg")
  $pret = floatval($_POST['pret']);

  $stmt = $mysqli->prepare("INSERT INTO masini (nume, descriere, imagine, pret) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("sssd", $nume, $descriere, $imagine, $pret);

  if ($stmt->execute()) {
    echo "success";
  } else {
    echo "fail";
  }
} else {
  echo "missing_data";
}
?>
