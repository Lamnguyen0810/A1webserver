<?php
$filename = "quizrecord.txt";  // <-- it's a .txt file now
$leaderboard = [];

// 1. Open the file
if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
        if ($data[0] == "nickname") continue; // skip header if any

        $leaderboard[] = [
            'nickname' => $data[0],
            'score' => (int)$data[1]
        ];
    }
    fclose($handle);
}

// 2. Sort DESC by score
usort($leaderboard, function ($a, $b) {
    return $b['score'] - $a['score'];
});

// 3. Display
echo "<h3>Leaderboard</h3>";
echo "<ol>";
foreach ($leaderboard as $entry) {
    echo "<li>{$entry['nickname']}: {$entry['score']}</li>";
}
echo "</ol>";
?>
