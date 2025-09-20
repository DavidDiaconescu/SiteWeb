<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ro">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Expozitie Auto</title>
  <link rel="stylesheet" type="text/css" href="MenuModel3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> <!-- FontAwesome -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body bgcolor="white">
<center>
  <table border="0" width="100%" bgcolor="#333333" style="color:white;">
    <tr>


      <td align="left" style="vertical-align: middle;">
        <img src="BroscutaEpoca.jpg" alt="Expo Auto Logo" width="100">

        <?php
        if (isset($_SESSION['username'])) {
          echo '
      <span style="color:white; margin-left: 15px; font-weight: bold; font-size: 16px;">
        <i class="fas fa-user"></i> Bună, ' . htmlspecialchars($_SESSION['username']) . '
      </span>
      <a href="logout.php" style="color: white; margin-left: 15px; font-size: 14px; text-decoration: none;">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>';

          // ✅ Buton vizibil doar pentru admin
          if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') {
            echo '
        <a href="admin.php" style="color: white; margin-left: 20px; background-color: #007bff; padding: 6px 12px; border-radius: 5px; text-decoration: none;">
          <i class="fas fa-cogs"></i> AdminControl
        </a>';
          }
        }
        ?>
      </td>



      <td align="center">
        <h1 style="color:white; font-style:italic; font-size:18px;">
          ExpoAuto - Cea mai mare colectie de masini de epoca din Transilvania!
        </h1>
      </td>
      <td align="right">
        <a href="Register.html" style="color: white; text-decoration: none;">Creare cont</a> |
        <a href="Authentification.html" style="color: white; text-decoration: none;">Logare</a>
      </td>
    </tr>
  </table>

  <p>Descopera unica expozitie de masini de epoca din Transilvania.</p>

  <!-- Buton Vizite -->
  <a href="Vizite.html">
    <button style="background-color: #ffa726; color: white; border: none; padding: 10px 20px; font-size: 16px; border-radius: 6px; margin-top: 15px; cursor: pointer;">
      Vezi statistici vizitatori
    </button>
  </a>


  <div id="slider-wrapper" style="position: relative; height: 500px; max-width: 1800px; margin: auto;">
    <!-- Săgeți permanente, în afara #slider -->
    <button id="prev" class="slider-arrow">&#8592;</button>
    <button id="next" class="slider-arrow">&#8594;</button>

    <div id="slider" style="position: relative; height: 100%; overflow: hidden;">
      <!-- Aici jQuery va încărca dinamic imaginile sau videoclipul -->
    </div>
  </div>


  <div id="controls">
    <label for="numImages">Număr imagini afișate:</label>
    <input type="number" id="numImages" min="1" max="5" value="1">

    <label for="interval">Interval de schimbare (secunde):</label>
    <input type="number" id="interval" min="1" value="2">

    <br>

    <button id="startSlider">Pornește Sliderul</button>
  </div>


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
</center>

<footer align="center" style="background-color: #333333; color: white; border-top: 1px solid #000; padding: 20px 0; position: relative;">
  <p>&copy; 2025 ExpoAuto. Toate drepturile rezervate.</p>
  <p>Email: contact@expoauto.com | Telefon: +40 756 320 944</p>
</footer>
<script src="mainpage.js"></script>
<script src="jqueryinstructions.js"></script>
</body>
</html>
