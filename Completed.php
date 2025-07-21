<!DOCTYPE html>
<html lang="en">
<head>
  <title>Completed</title>
  <meta charset="utf-8" />
</head>
<body>

<?php
session_start(); // ✅ Must do this too!
  //   change to session in order to make it read the correct data
echo "Name " . $_SESSION['nickname'] . "!<br>";
echo "Overall: " . $_SESSION['count'] . "<br>";

echo '<p><a href="main.php">Restart</a></p>';
?>

</body>
</html>
