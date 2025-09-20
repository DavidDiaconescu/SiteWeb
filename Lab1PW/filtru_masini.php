<?php

$mysqli = include 'conectare.php';

$nume = isset($_GET['nume']) ? $mysqli->real_escape_string($_GET['nume']) : '';
$an = isset($_GET['an']) ? (int)$_GET['an'] : 0;
$capacitate = isset($_GET['capacitate']) ? (int)$_GET['capacitate'] : 0;

$query = "SELECT * FROM masini WHERE 1=1";
if (!empty($nume)) {
  $query .= " AND nume LIKE '%$nume%'";
}
if ($an > 0) {
  $query .= " AND an_fabricatie = $an";
}
if ($capacitate > 0) {
  $query .= " AND capacitate_cilindrica = $capacitate";
}

$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
  echo "<tr>
          <td>" . htmlspecialchars($row['nume']) . "</td>
          <td>" . htmlspecialchars($row['an_fabricatie']) . "</td>
          <td>" . htmlspecialchars($row['capacitate_cilindrica']) . " cmc</td>
        </tr>";
}

