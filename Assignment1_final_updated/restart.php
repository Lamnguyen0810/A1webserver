<?php
session_start();
session_unset();    // Clear all session variables
session_destroy();  // End session

header("Location: index.php"); // 
exit;
