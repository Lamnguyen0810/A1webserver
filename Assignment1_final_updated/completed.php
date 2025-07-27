<?php
session_start();
$name = $_SESSION['name'] ?? 'Player';
$finalScore = $_SESSION['count'] ?? 0;


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Game Completed</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      text-align: center;
      padding: 50px;
    }
    .result-box {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      display: inline-block;
    }
    a.button {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="result-box">
    <h2>🎉 Game Completed!</h2>
    <p>Thank you for playing, <strong><?= htmlspecialchars($name) ?></strong>!</p>
    <p>Your final score for this game was:</p>
    <h3><?= $finalScore ?></h3>

    <a href="restart.php" class="button">Restart</a>
  </div>
</body>
</html>
