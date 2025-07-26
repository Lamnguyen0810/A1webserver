<!DOCTYPE html>
<html>
<head>
<title>Learning Game</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
input[type=text] {
    width: 100%;
    padding: 8px;
    margin: 5px 0 15px;
    box-sizing: border-box;
}
button {
    padding: 10px 20px;
    margin: 5px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
}
button.science { background-color: #4CAF50; color: white; }
button.number { background-color: #2196F3; color: white; }
</style>
</head>
<body>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION["name"] = htmlspecialchars($_POST["name"]);
    $quiz = $_POST["quiz"];

    if ($quiz === "Science") {
        header("Location: science2.php"); // your part
        exit;
    } elseif ($quiz === "Number") {
        header("Location: math1.php"); // your friend's part
        exit;
    }
}
?>


<div class="container">
<h2>Welcome to Learning Game</h2>
<form method="POST">
    <label>Your Name:</label><br>
    <input type="text" name="name" required><br>

    <label>Pick Your Quiz:</label><br>
    <button type="submit" name="quiz" value="Science" class="science">Science Quiz</button>
    <button type="submit" name="quiz" value="Number" class="number">Number Quiz</button>
</form>
</div>
</body>
</html>
