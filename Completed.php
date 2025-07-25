<?php
session_start(); 
if ($_SESSION['saved'] == false) {   
  $nickname = $_SESSION['nickname'] ;
  $ovpt = $_SESSION['ovpt'] ;


  $file = fopen($filename, "a");
  fwrite($file, $nickname . "," . $ovpt . "\n");
  fclose($file);
$_SESSION['saved'] = true;
}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Completed</title>
  <meta charset="utf-8" />
</head>
<body>

<?php

echo "Name " . $_SESSION['nickname'] . "<br>";
echo "Overall: " . $_SESSION['ovpt'] . "<br>";

echo '<p><a href="main.php">Restart</a></p>';
?>

</body>
</html>
