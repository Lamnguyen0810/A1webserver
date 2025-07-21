<?php
session_start();

// Clear score if needed
unset($_SESSION['correct']);
unset($_SESSION['incorrect']);

// Initialize if not set
if (!isset($_SESSION['correct'])) {
  $_SESSION['correct'] = 0;
}
if (!isset($_SESSION['incorrect'])) {
  $_SESSION['incorrect'] = 0;
}

// Check answers first if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['answer']) && isset($_POST['correct_ans'])) {
    foreach ($_POST['answer'] as $i => $answer) {
      $answer = trim($answer);
      $correct = trim($_POST['correct_ans'][$i]);
      if ($answer === $correct) {
        $_SESSION['correct']++;
      } else {
        $_SESSION['incorrect']++;
      }
    }
  }
}

// Make questions
$qtspool = array(
  array('qts'=>'What is 1+1?', 'ans'=>'2'),
  array('qts'=>'What is 3+4?', 'ans'=>'7'),
  array('qts'=>'What is 10+3?', 'ans'=>'13'),
  array('qts'=>'What is 16+7', 'ans'=>'23'),
  array('qts'=>'What is 10/2', 'ans'=>'5')
);

$qtspick_key = array_rand($qtspool, 3);

$pickqts = array();
foreach ($qtspick_key as $k) {
  $pickqts[] = $qtspool[$k];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Number Quiz</title>
</head>
<body>

  <form method="post">
    <?php foreach ($pickqts as $v): ?>
      <p>Question: <?php echo $v['qts']; ?></p>
      <input type="text" name="answer[]">
      <input type="hidden" name="correct_ans[]" value="<?php echo $v['ans']; ?>
">
    <?php endforeach; ?>
    <button type="submit">Submit</button>
  </form>

  <hr>
  <p>Correct answers: <?php echo $_SESSION['correct']; ?></p>
  <p>Incorrect answers: <?php echo $_SESSION['incorrect']; ?></p>

</body>
</html>
