<?php
session_start();

// Clear score if needed (can delete)
unset($_SESSION['correct']);
unset($_SESSION['incorrect']);

// Initialize if not set (can delete)
if (!isset($_SESSION['correct'])) {
  $_SESSION['correct'] = 0;
}
if (!isset($_SESSION['incorrect'])) {
  $_SESSION['incorrect'] = 0;
}




// question pool can change to anythig
$qtspool = array(
  array('qts'=>'What is 1+1?', 'ans'=>'2'),
  array('qts'=>'What is 3+4?', 'ans'=>'7'),
  array('qts'=>'What is 10+3?', 'ans'=>'13'),
  array('qts'=>'What is 16+7', 'ans'=>'23'),
  array('qts'=>'What is 10/2', 'ans'=>'5'),
  array('qts'=>'What is 9+10', 'ans'=>'19'),
  array('qts'=>'What is 18x2', 'ans'=>'36')
);

$qtspick_key = array_rand($qtspool, 3);

$pickqts = array();
foreach ($qtspick_key as $k) {
  $pickqts[] = $qtspool[$k];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {   
        $_SESSION['nickname'] = trim($_POST['nickname']);}
 

?>

<!DOCTYPE html>
<html>
<head>
  <title>Number Quiz</title>
</head>
<body>

  <form method="post"action="result.php">
    <?php foreach ($pickqts as $v): ?>
      <p>Question: <?php echo $v['qts']; ?></p>
      <input type="text" name="answer[]">
      <input type="hidden" name="correct_ans[]" value="<?php echo $v['ans']; ?>
">
    <?php endforeach; ?>
    <button type="submit">Submit</button>
  </form>

</body>
</html>
