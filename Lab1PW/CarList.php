<?php
session_start();
$mysqli = include 'conectare.php';

if (
  $_SERVER['REQUEST_METHOD'] === 'POST' &&
  isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'
) {
  if (isset($_POST['nume'], $_POST['an'], $_POST['capacitate'])) {
    $nume = $mysqli->real_escape_string($_POST['nume']);
    $an = (int)$_POST['an'];
    $capacitate = (int)$_POST['capacitate'];

    $stmt = $mysqli->prepare("INSERT INTO masini (nume, an_fabricatie, capacitate_cilindrica) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $nume, $an, $capacitate);
    $stmt->execute();
    echo "<p style='color:green;'>Mașina a fost adăugată cu succes!</p>";
  }
  if (isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    $mysqli->query("DELETE FROM masini WHERE id = $delete_id");
    echo "<p style='color:red;'>Mașina a fost ștearsă cu succes!</p>";
  }
  if (isset($_POST['update_id'], $_POST['update_nume'], $_POST['update_an'], $_POST['update_capacitate'])) {
    $id = (int)$_POST['update_id'];
    $nume = $mysqli->real_escape_string($_POST['update_nume']);
    $an = (int)$_POST['update_an'];
    $capacitate = (int)$_POST['update_capacitate'];

    $stmt = $mysqli->prepare("UPDATE masini SET nume = ?, an_fabricatie = ?, capacitate_cilindrica = ? WHERE id = ?");
    $stmt->bind_param("siii", $nume, $an, $capacitate, $id);
    $stmt->execute();
    echo "<p style='color:blue;'>Mașina a fost actualizată cu succes!</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
  <meta charset="utf-8">
  <title>Expozitie Auto - Lista Mașinilor</title>
  <link rel="stylesheet" type="text/css" href="MenuModel3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    .admin-btn {
      padding: 6px 12px;
      border: none;
      border-radius: 5px;
      background-color: #333;
      color: white;
      cursor: pointer;
      font-weight: bold;
    }
    .admin-btn:hover {
      background-color: #555;
    }
    .admin-input {
      padding: 4px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-right: 5px;
    }
  </style>
</head>
<body bgcolor="white">
<center>
  <table border="0" width="100%" bgcolor="#333333" style="color:white;">
    <tr>
      <td align="left" style="vertical-align: middle;">
        <img src="BroscutaEpoca.jpg" alt="Expo Auto Logo" width="100" style="cursor: pointer;">
        <?php
        if (isset($_SESSION['username'])) {
          echo '<span style="color:white; margin-left: 15px; font-weight: bold; font-size: 16px;">
                  <i class="fas fa-user"></i> Bună, ' . htmlspecialchars($_SESSION['username']) . '
                </span>';
          echo '<a href="logout.php" style="color: white; margin-left: 15px; font-size: 14px; text-decoration: none;">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>';
        }
        ?>
      </td>
      <td align="center">
        <h1 style="color:white; font-style:italic; font-size:18px;">ExpoAuto - Cea mai mare colectie de masini de epoca din Transilvania!</h1>
      </td>
      <td align="right">
        <?php
        if (!isset($_SESSION['username'])) {
          echo '<a href="Register.html" style="color: white; text-decoration: none;">Creare cont</a> |
                <a href="Authentification.html" style="color: white; text-decoration: none;">Logare</a>';
        }
        ?>
      </td>
    </tr>
  </table>

  <!-- 🔍 AJAX Filter Inputs -->
  <div style="margin: 20px;">
    <input type="text" id="filtru-nume" placeholder="Filtru nume model">
    <input type="number" id="filtru-an" placeholder="Filtru an fabricație">
    <input type="number" id="filtru-capacitate" placeholder="Filtru capacitate">
  </div>

  <p>Vezi toata colectia noastra de masini de epoca.</p>
  <table border="1" width="80%" style="text-align:center;" class="car-specs">
    <thead>
    <tr>
      <th class="sortable">Nume model</th>
      <th class="sortable">An fabricatie</th>
      <th class="sortable">Capacitate motor</th>
      <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin' && isset($_GET['from']) && $_GET['from'] === 'admin') echo '<th>Acțiuni</th>'; ?>
    </tr>
    </thead>
    <tbody id="tabel-masini">
    <?php
    $result = $mysqli->query("SELECT * FROM masini");
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
                <td>" . htmlspecialchars($row['nume']) . "</td>
                <td>" . htmlspecialchars($row['an_fabricatie']) . "</td>
                <td>" . htmlspecialchars($row['capacitate_cilindrica']) . " cmc</td>";
      if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin' && isset($_GET['from']) && $_GET['from'] === 'admin') {
        echo "<td>
                  <form method='post' style='display:inline;'>
                    <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                    <input type='submit' value='Șterge' class='admin-btn'>
                  </form>
                  <form method='post' style='display:inline; margin-left:10px;'>
                    <input type='hidden' name='update_id' value='" . $row['id'] . "'>
                    <input type='text' name='update_nume' value='" . htmlspecialchars($row['nume']) . "' class='admin-input' required>
                    <input type='number' name='update_an' value='" . htmlspecialchars($row['an_fabricatie']) . "' class='admin-input' required>
                    <input type='number' name='update_capacitate' value='" . htmlspecialchars($row['capacitate_cilindrica']) . "' class='admin-input' required>
                    <input type='submit' value='Actualizează' class='admin-btn'>
                  </form>
                </td>";
      }
      echo "</tr>";
    }
    ?>
    </tbody>
  </table>

  <?php
  if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin' && isset($_GET['from']) && $_GET['from'] === 'admin') {
    echo '<div style="margin-top: 30px;">
            <form action="" method="post">
              <table style="margin: auto;">
                <tr>
                  <td><label for="nume">Denumire model:</label></td>
                  <td><input type="text" name="nume" id="nume" required class="admin-input"></td>
                </tr>
                <tr>
                  <td><label for="an">An fabricație:</label></td>
                  <td><input type="number" name="an" id="an" required class="admin-input"></td>
                </tr>
                <tr>
                  <td><label for="capacitate">Capacitate cilindrică (cmc):</label></td>
                  <td><input type="number" name="capacitate" id="capacitate" required class="admin-input"></td>
                </tr>
              </table>
              <br>
              <input type="submit" value="Adaugă Mașina" class="admin-btn">
            </form>
          </div>';
  }
  ?>

  <table id="linkTable" border="1" style="width: 100%; margin-top: 20px;">
    <tr><td><a href="CarList.php">Lista Mașinilor</a></td></tr>
    <tr><td><a href="WishList.html">Lista de Dorințe</a></td></tr>
    <tr><td><a href="Register.html">Creare Cont</a></td></tr>
    <tr><td><a href="Authentification.html">Logare</a></td></tr>
  </table>
</center>

<input type="checkbox" id="menu-toggle" class="menu-toggle">
<label for="menu-toggle" class="menu-button">MENIU</label>

<div class="menu-box">
  <ul>
    <li><a href="MainPage.php"><i class="fas fa-house"></i> Acasă</a></li>
    <li>
      <a href="#"><i class="fas fa-car"></i> Vezi toate mașinile</a>
      <ul class="sub-menu">
        <li><a href="CarList.php"><i class="fas fa-list"></i> Lista completă</a></li>
        <li><a href="VWBeetle.html"><i class="fas fa-bug"></i> VW Beetle</a></li>
        <li><a href="Cadillac.html"><i class="fas fa-car-side"></i> Cadillac V12</a></li>
      </ul>
    </li>
  </ul>
</div>

<footer align="center" style="background-color: #333333; color: white; border-top: 1px solid #000; padding: 20px 0;">
  <p>&copy; 2025 ExpoAuto. Toate drepturile rezervate.</p>
  <p>Email: contact@expoauto.com | Telefon: +40 756 320 944</p>
</footer>

<!-- 🔁 AJAX Live Filter Script -->
<script>
  function incarcaMasini() {
    const nume = $('#filtru-nume').val();
    const an = $('#filtru-an').val();
    const capacitate = $('#filtru-capacitate').val();

    $.ajax({
      url: 'filtru_masini.php',
      method: 'GET',
      data: {
        nume: nume,
        an: an,
        capacitate: capacitate
      },
      success: function(data) {
        $('#tabel-masini').html(data);
      }
    });
  }

  $(document).ready(function() {
    $('#filtru-nume, #filtru-an, #filtru-capacitate').on('input', incarcaMasini);
  });
</script>
<script src="tabel.js"></script>
</body>
</html>
