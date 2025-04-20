<?php include 'db.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginInput = $_POST['loginInput'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email=? OR mobile=? OR name=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $loginInput, $loginInput, $loginInput);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user['name'];
            header("Location: welcome.php");
            exit();
        } else {
            $msg = "Incorrect password.";
        }
    } else {
        $msg = "User not found with given Email, Name or Mobile.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="loginInput" placeholder="Email / Name / Mobile" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p class="message"><?= $msg ?></p>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>
</div>
</body>
</html>
