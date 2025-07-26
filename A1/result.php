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

    // Optional: Detect if the quiz came from science or math
    if (isset($_POST['quiz_type'])) {
        $_SESSION['quiz_type'] = $_POST['quiz_type'];
    } else {
        $_SESSION['quiz_type'] = "Quiz"; // fallback
    }

    // Redirect to avoid resubmission if user refreshes
    header("Location: result.php");
    exit;
}

// Score from last quiz
$correct = $_SESSION['correct'] ?? 0;
$incorrect = $_SESSION['incorrect'] ?? 0;
$quiz_type = $_SESSION['quiz_type'] ?? 'Quiz';

$score = ($correct * 3) - ($incorrect * 2);
$_SESSION['count'] = ($_SESSION['count'] ?? 0) + $score;
$_SESSION['ovpt'] = $_SESSION['count']; // Needed for leaderboard


// Show result page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quiz Result</title>
</head>
<body>
  <h2>🧪 <?= htmlspecialchars($quiz_type) ?> Result</h2>
  <p>Hello, <strong><?= htmlspecialchars($_SESSION['name'] ?? 'Player') ?></strong>!</p>
  <p>Correct: <?= $correct ?> | Incorrect: <?= $incorrect ?></p>
  <p>Score from this quiz: <?= $score ?></p>
  <p>Overall score this session: <?= $_SESSION['count'] ?></p>

  <form action="science2.php" method="get" style="display:inline;">
    <button type="submit">Science Quiz</button>
  </form>

  <form action="math1.php" method="get" style="display:inline;">
    <button type="submit">Math Quiz</button>
  </form>

  <form action="leaderboard.php" method="get" style="display:inline;">
    <button type="submit">Leaderboard</button>
  </form>

  <form action="completed.php" method="post" style="display:inline;">
    <button type="submit">Exit Game</button>
  </form>
</body>
</html>
