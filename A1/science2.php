<?php
session_start();

$name = $_SESSION['name'] ?? 'Guest';

// If form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answers = $_POST['answer'] ?? [];
    $correct_answers = $_POST['correct_ans'] ?? [];

    $correctCount = 0;
    $incorrectCount = 0;

    for ($i = 0; $i < count($correct_answers); $i++) {
        if (strcasecmp(trim($answers[$i]), trim($correct_answers[$i])) == 0) {
            $correctCount++;
        } else {
            $incorrectCount++;
        }
    }

    $_SESSION['correct'] = $correctCount;
    $_SESSION['incorrect'] = $incorrectCount;
    $_SESSION['quiz_type'] = "Science";
    header("Location: result.php");
    exit;
}

// Otherwise show quiz questions
$science_qts = array(
  array('qts' => 'What planet is known as the Red Planet?', 'ans' => 'Mars'),
  array('qts' => 'What is the boiling point of water?', 'ans' => '100°C'),
  array('qts' => 'What is the chemical symbol for water?', 'ans' => 'H2O'),
  array('qts' => 'How many legs does a spider have?', 'ans' => '8'),
  array('qts' => 'How many bones are in the human body?', 'ans' => '206'),
  array('qts' => 'How many teeth does an adult human have?', 'ans' => '32'),
  array('qts' => 'What is the hardest natural substance on Earth?', 'ans' => 'Diamond')
);

$keys = array_rand($science_qts, 3);
$questions = [];
foreach ($keys as $k) {
    $questions[] = $science_qts[$k];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Science Quiz</title>
  <style>
    body {
        font-family: Arial, sans-serif;
        background: #f2f2f2;
        padding: 20px;
    }
    .container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        max-width: 600px;
        margin: auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input[type=text] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }
    button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
  </style>
</head>
<body>
<div class="container">
  <h2>Welcome, <?= htmlspecialchars($name) ?></h2>
  <h3>Science Questions</h3>
  <form method="post">
    <?php foreach ($questions as $q): ?>
      <p><strong><?= htmlspecialchars($q['qts']) ?></strong></p>
      <input type="text" name="answer[]" required>
      <input type="hidden" name="correct_ans[]" value="<?= htmlspecialchars($q['ans']) ?>">
    <?php endforeach; ?>
    <br>
    <button type="submit">Submit Answers</button>
  </form>
</div>
</body>
</html>
