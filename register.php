<?php include 'db.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $mobile   = $_POST['mobile'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if ($password !== $confirm) {
        $msg = "Passwords do not match.";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, mobile, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $mobile, $hashed);

        if ($stmt->execute()) {
            header("Location: index.php?registered=true");
            exit();
        } else {
            $msg = "Email already exists or error occurred.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
<div class="form-container">
    <h2>Register</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="mobile" placeholder="Mobile Number" required>
        <input type="password" name="password" placeholder="Password" required minlength="6">
        <input type="password" name="confirm" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
        <p class="message"><?= $msg ?></p>
        <p>Already registered? <a href="index.php">Login here</a></p>
    </form>
</div>
</body>
</html>
