<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['name'] = $_POST['name'] ?? 'Guest';
}

// Clear score
unset($_SESSION['correct']);
unset($_SESSION['incorrect']);

// Initialize score
if (!isset($_SESSION['correct'])) {
    $_SESSION['correct'] = 0;
}
if (!isset($_SESSION['incorrect'])) {
    $_SESSION['incorrect'] = 0;
}




// Questions
$qtspool = array(
    array('qts'=>'What is 1+1?', 'ans'=>'2'),
    array('qts'=>'What is 3+4?', 'ans'=>'7'),
    array('qts'=>'What is 10+3?', 'ans'=>'13'),
    array('qts'=>'What is 16+7?', 'ans'=>'23'),
    array('qts'=>'What is 10/2?', 'ans'=>'5'),
    array('qts'=>'What is 9+10?', 'ans'=>'19'),
    array('qts'=>'What is 18x2?', 'ans'=>'36')
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
    <title>Math Quiz</title>
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
        h2, h3 {
            color: #333;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Welcome to Math Quiz, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
    <h3>Your Questions :</h3>
  <form method="post" action="result.php">
        <?php foreach ($pickqts as $v): ?>
            <p><strong><?php echo $v['qts']; ?></strong></p>
            <input type="text" name="answer[]" required>
            <input type="hidden" name="correct_ans[]" value="<?php echo $v['ans']; ?>">
        <?php endforeach; ?>
        <br>
        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>
