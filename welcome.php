<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Welcome The Websters Candidate, <?= $_SESSION['user']; ?>!</h2>
    <p>You have successfully logged in</p>
    <a href="index.php" class="btn">Logout</a>
</div>
</body>
</html>
