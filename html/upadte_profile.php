<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Placeholder for MongoDB integration (same as profile.php)
        $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
        $mongoDB = $mongoClient->your_database_name;
        $mongoCollection = $mongoDB->user_profiles;

        $age = $_POST["age"];
        $dob = $_POST["dob"];
        $contact = $_POST["contact"];

        $updateResult = $mongoCollection->updateOne(
            ['username' => $username],
            ['$set' => ['age' => $age, 'dob' => $dob, 'contact' => $contact]]
        );

        if ($updateResult->getModifiedCount() > 0) {
            echo "Profile updated successfully!";
        } else {
            echo "Error updating profile.";
        }
    }
} else {
    header("Location: login.html");
    exit();
}
?>
