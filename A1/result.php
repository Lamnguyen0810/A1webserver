<?php
session_start();

// Check answers (if form was submitted)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answers = $_POST['answer'] ?? [];
    $correct_answers = $_POST['correct_ans'] ?? [];

    $correctCount = 0;
    $incorrectCount = 0;

    for ($i = 0; $i < count($correct_answers); $i++) {
        $answer = trim($answers[$i]);
        $correct = trim($correct_answers[$i]);
        if ($answer === $correct) {
            $correctCount++;
        } else {
            $incorrectCount++;
        }
    }

    $_SESSION['correct'] = $correctCount;
    $_SESSION['incorrect'] = $incorrectCount;

    if (isset($_POST['quiz_type'])) {
        $_SESSION['quiz_type'] = $_POST['quiz_type'];
    } else {
        $_SESSION['quiz_type'] = "Quiz";
    }

    header("Location: result.php");
    exit;
}

// Get result details
$name = $_SESSION['name'] ?? 'Player';
$correct = $_SESSION['correct'] ?? 0;
$incorrect = $_SESSION['incorrect'] ?? 0;
$quiz_type = $_SESSION['quiz_type'] ?? 'Quiz';

$score = ($correct * 3) - ($incorrect * 2);
$_SESSION['count'] = ($_SESSION['count'] ?? 0) + $score;
$_SESSION['ovpt'] = $_SESSION['count']; // Leaderboard

$overallScore = $_SESSION['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quiz Result</title>
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
.button {
  display: inline-block;
  margin: 10px 10px;
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  border: none;
  cursor: pointer;
}
.blue-button {
  background-color: #2196F3; /* Blue */
}

  </style>
</head>
<body>
  <div class="result-box">
    <h2><?= htmlspecialchars($quiz_type) ?> Result</h2>
    <p>Hello, <strong><?= htmlspecialchars($name) ?></strong>!</p>
    <p>✅ Correct: <strong><?= $correct ?></strong> | ❌ Incorrect: <strong><?= $incorrect ?></strong></p>
    <p>📊 Score this quiz: <strong><?= $score ?></strong></p>
    <p>⭐ Overall score: <strong><?= $overallScore ?></strong></p>

    <form action="science2.php" method="get" style="display:inline;">
      <button type="submit" class="button">Another Science Quiz?</button>
    </form>

    <form action="math1.php" method="get" style="display:inline;">
      <button type="submit" class="button blue-button">Another Math Quiz?</button>
    </form>

    <form action="leaderboard.php" method="get" style="display:inline;">
      <button type="submit" class="button">Leaderboard</button>
    </form>

    <form action="completed.php" method="post" style="display:inline;">
      <button type="submit" class="button">Exit Game</button>
    </form>
  </div>
</body>
</html>
