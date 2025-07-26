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
        if ($answers[$i] === $correct_answers[$i]) {
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

// Prepare quiz questions with True/False answers
$science_qts = array(
  array('qts' => 'Mars is known as the Red Planet.', 'ans' => 'True'),
  array('qts' => 'The boiling point of water is 50°C.', 'ans' => 'False'),
  array('qts' => 'H2O is the chemical symbol for water.', 'ans' => 'True'),
  array('qts' => 'A spider has six legs.', 'ans' => 'False'),
  array('qts' => 'The human body has 206 bones.', 'ans' => 'True'),
  array('qts' => 'An adult human has 40 teeth.', 'ans' => 'False'),
  array('qts' => 'Diamond is the hardest natural substance on Earth.', 'ans' => 'True')
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
    .question {
        margin-bottom: 20px;
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
  <h2>Welcome to Science Quiz, <?= htmlspecialchars($name) ?></h2>
  <h3>Your Questions :</h3>
  <form method="post">
    <?php foreach ($questions as $index => $q): ?>
      <div class="question">
        <p><strong><?= htmlspecialchars($q['qts']) ?></strong></p>
        <label>
          <input type="radio" name="answer[<?= $index ?>]" value="True" required> True
        </label>
        <label>
          <input type="radio" name="answer[<?= $index ?>]" value="False" required> False
        </label>
        <input type="hidden" name="correct_ans[<?= $index ?>]" value="<?= htmlspecialchars($q['ans']) ?>">
      </div>
    <?php endforeach; ?>
    <button type="submit">Submit</button>
  </form>
</div>
</body>
</html>
