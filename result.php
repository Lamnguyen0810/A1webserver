<?php
session_start();

// Check answers function can put to the result page
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

$crpt=0;
$crpt=$crpt+$_SESSION['correct']*3-$_SESSION['incorrect']*2;
$_SESSION['ovpt']=$_SESSION['ovpt']+$crpt;

?>

<!DOCTYPE html>
<html>
<head>
  <title>Quiz result</title>
</head>
<body>

  <hr>
  <p>Correct answers: <?php echo $_SESSION['correct']; ?></p>
  <p>Incorrect answers: <?php echo $_SESSION['incorrect']; ?></p>
  <p>Current point:<?php echo $crpt;?></p>
  <p>Overall point:<?php echo $_SESSION['ovpt']; ?></p>
<button type="button" onclick="window.location.href='Leaderboard.php'">Leaderboard</button>
<button type="button" onclick="window.location.href='Completed.php'">Exit</button>
<button type="button" onclick="window.location.href='Test.php'">Number</button>


</body>
</html>