<?php
session_start();
$filename = "quizrecord.txt";  // file name for quiz record
if ($_SESSION['saved'] == false) {   
  $nickname = $_SESSION['nickname'] ;
  $ovpt = $_SESSION['ovpt'] ;


  $file = fopen($filename, "a");
  fwrite($file, $nickname . "," . $ovpt . "\n");
  fclose($file);
   $_SESSION['saved'] = true;
}

$leaderboard = [];


if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
        if ($data[0] == "nickname") continue; 

        $leaderboard[] = [
            'nickname' => $data[0],
            'score' => (int)$data[1]
        ];
    }
    fclose($handle);
}

//Sorting
usort($leaderboard, function ($a, $b) {
    return $b['score'] - $a['score'];
});


echo "<h3>Leaderboard</h3>";
echo "<ol>";
foreach ($leaderboard as $entry) {
    echo "<li>{$entry['nickname']}: {$entry['score']}</li>";
}
echo "</ol>";
?>

<!DOCTYPE html>
<html>
<body>
<button type="button" onclick="window.location.href='Completed.php'">Exit</button>
<button type="button" onclick="window.location.href='Test.php'">Number</button>


</body>
</html>