<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Placeholder for MongoDB integration
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $mongoDB = $mongoClient->your_database_name;
    $mongoCollection = $mongoDB->user_profiles;

    $result = $mongoCollection->findOne(['username' => $username]);

    if ($result) {
        echo "<p>Username: " . $result['username'] . "</p>";
        echo "<p>Age: " . $result['age'] . "</p>";
        echo "<p>Date of Birth: " . $result['dob'] . "</p>";
        echo "<p>Contact: " . $result['contact'] . "</p>";
    } else {
        echo "User not found.";
    }
} else {
    header("Location: login.html");
    exit();
}
?>
