<?php
$filename = "quizrecord.txt";  // file name for quiz record
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
