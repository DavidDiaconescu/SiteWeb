<?php
session_start();
$mysqli = include 'conectare.php';

if (isset($_POST['username'], $_POST['parola'])) {
  $username = $_POST['username'];
  $parola = password_hash($_POST['parola'], PASSWORD_DEFAULT);
  $rol = isset($_POST['rol']) ? $_POST['rol'] : 'user';

  $stmt = $mysqli->prepare("INSERT INTO utilizatori (username, parola, rol) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $parola, $rol);

  if ($stmt->execute()) {
    // Redirecționare către pagina de autentificare
    header("Location: Authentification.html");
    exit(); // IMPORTANT! Oprește execuția după redirecționare
  } else {
    echo "fail";
  }
} else {
  echo "missing_data";
}
?>
