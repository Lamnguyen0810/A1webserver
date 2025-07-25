<?php
session_start();

$_SESSION["ovpt"] =0;
$_SESSION["saved"] = false;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tutorial 1 - Task 1</title>
    <meta charset="utf-8" />
  </head>

<body>
  <h1> my first php task </h1>


<form action="Test.php" method="post">
<p>Nickname:<input type="text" name="nickname"
value="<?php echo htmlspecialchars($_SESSION['nickname'] ?? ''); ?>">
  <input type="submit" value="Submit"></p>
</form>

</body>
</html>
