<?php
session_start();
$mysqli = include 'conectare.php';

if (isset($_POST['username'], $_POST['parola'])) {
  $username = $_POST['username'];
  $parola = $_POST['parola'];

  $stmt = $mysqli->prepare("SELECT id, parola, rol FROM utilizatori WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($parola, $user['parola'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $username;
    $_SESSION['rol'] = $user['rol'];
    header("Location: MainPage.php");
    exit();
  } else {
    echo "<p style='color:red; text-align:center;'>Username sau parolă greșită.</p>";
    echo "<p style='text-align:center;'><a href='Authentification.html'>Înapoi la autentificare</a></p>";
  }
} else {
  echo "<p style='color:red; text-align:center;'>Date lipsă. Vă rugăm completați toate câmpurile.</p>";
  echo "<p style='text-align:center;'><a href='Authentification.html'>Înapoi</a></p>";
}
?>
