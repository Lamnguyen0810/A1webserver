<?php
session_start();

$filename = "quizrecord.txt";

// Save only once
if (!isset($_SESSION['saved']) || $_SESSION['saved'] === false) {
    $name = $_SESSION['name'] ?? "Unknown";
    $ovpt = $_SESSION['ovpt'] ?? 0;

    $file = fopen($filename, "a");
    fwrite($file, $name . "," . $ovpt . "\n");
    fclose($file);

    $_SESSION['saved'] = true;
}

$leaderboard = [];

// Read scores
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

// Sort
usort($leaderboard, fn($a, $b) => $b['score'] - $a['score']);
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
        ol {
            text-align: left;
            display: inline-block;
            margin-top: 20px;
        }
        button {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            background-color: #333;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>🏆 Leaderboard</h2>
    <ol>
        <?php foreach ($leaderboard as $entry): ?>
            <li><?= htmlspecialchars($entry['name']) ?>: <?= $entry['score'] ?></li>
        <?php endforeach; ?>
    </ol>

    <div>
        <button onclick="window.location.href='Result.php'">Back to Result</button>
        <!-- <button onclick="window.location.href='test.php'">Try Again</button>-->
    </div>
</body>
</html>
