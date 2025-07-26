<?php
session_start();

$filename = "quizrecord.txt";

// Save once per session
if (!isset($_SESSION['saved']) || $_SESSION['saved'] === false) {
    $name = $_SESSION['name'] ?? "Unknown";
    $ovpt = $_SESSION['ovpt'] ?? 0;

    $file = fopen($filename, "a");
    fwrite($file, $name . "," . $ovpt . "\n");
    fclose($file);

    $_SESSION['saved'] = true;
}

$leaderboard = [];

// Read the file
if (($handle = fopen($filename, "r")) !== false) {
    while (($data = fgetcsv($handle)) !== false) {
        if (count($data) < 2) continue;
        $leaderboard[] = [
            'name' => $data[0],
            'score' => (int)$data[1]
        ];
    }
    fclose($handle);
}

// Sort mode from URL
$sortMode = $_GET['sort'] ?? 'score';

if ($sortMode === 'name') {
    usort($leaderboard, fn($a, $b) => strcmp($a['name'], $b['name']));
} else {
    usort($leaderboard, fn($a, $b) => $b['score'] - $a['score']); // default: by score
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background: #f4f4f4;
            text-align: center;
        }
        .leaderboard-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        ol {
            text-align: left;
            margin-top: 20px;
            padding-left: 20px;
        }
        .button {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="leaderboard-box">
        <h2>🏆 Leaderboard</h2>
        <div>
            <a href="?sort=score" class="button">Sort by Score</a>
            <a href="?sort=name" class="button">Sort by Name</a>
        </div>
        <ol>
            <?php foreach ($leaderboard as $entry): ?>
                <li><?= htmlspecialchars($entry['name']) ?>: <?= $entry['score'] ?></li>
            <?php endforeach; ?>
        </ol>
        <div>
            <a href="result.php" class="button">Back to Result</a>
        </div>
    </div>
</body>
</html>
