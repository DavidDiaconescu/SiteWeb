<?php
session_start();
if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin' && isset($_GET['from']) && $_GET['from'] === 'admin')
 {
    echo "<p style='color: red;'>Acces interzis. Această pagină este disponibilă doar pentru administratori.</p>";
    echo "<p><a href='MainPage.php'>Înapoi la pagina principală</a></p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="UTF-8">
  <title>Panou Administrator - ExpoAuto</title>
  <link rel="stylesheet" type="text/css" href="MenuModel3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body bgcolor="white">
<center>
  <table border="0" width="100%" bgcolor="#333333" style="color:white;">
    <tr>
      <td align="left" style="vertical-align: middle;">
        <img src="/.idea/BroscutaEpoca.jpg" alt="Expo Auto Logo" width="100">
        <span style="color:white; margin-left: 15px; font-weight: bold; font-size: 16px;">
          <i class="fas fa-user-shield"></i> Admin: <?php echo htmlspecialchars($_SESSION['username']); ?>
        </span>
      </td>
      <td align="center">
        <h1 style="color:white; font-style:italic; font-size:18px;">ExpoAuto - Cea mai mare colectie de masini de epoca din Transilvania!</h1>
      </td>
      <td align="right">
        <a href="MainPage.php" style="color: white; text-decoration: none;">Înapoi la site</a> |
        <a href="logout.php" style="color: white; text-decoration: none;">Logout</a>
      </td>
    </tr>
  </table>

  <h2>Panou administrativ</h2>

  <div style="margin-top: 30px;">
    <a href="CarList.php?from=admin" class="admin-button">
      <i class="fas fa-plus-circle"></i> Adaugă mașină nouă
    </a>
    <a href="adauga_fotografie.php" class="admin-button">
      <i class="fas fa-image"></i> Adaugă fotografie în album
    </a>
  </div>
</center>

<footer align="center" style="background-color: #333333; color: white; border-top: 1px solid #000; padding: 20px 0; margin-top: 50px;">
  <p>&copy; 2025 ExpoAuto. Toate drepturile rezervate.</p>
  <p>Email: contact@expoauto.com | Telefon: +40 756 320 944</p>
</footer>
</body>
</html>
