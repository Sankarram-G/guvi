<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registerDB";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "Welcome to the login form!";
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($db_username, $db_password);

    if ($stmt->fetch() && password_verify($password, $db_password)) {
        $session_token = bin2hex(random_bytes(32));

        // Placeholder for Redis integration
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->setex($session_token, 3600, $username);

        echo json_encode(["session_token" => $session_token]);
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
}
$conn->close();
?>
