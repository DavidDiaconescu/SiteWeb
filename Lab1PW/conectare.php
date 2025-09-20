<?php
$mysqli = new mysqli("localhost", "root", "", "siteauto");

if ($mysqli->connect_error) {
  die("Conexiunea a eșuat: " . $mysqli->connect_error);
}

return $mysqli;
?>
