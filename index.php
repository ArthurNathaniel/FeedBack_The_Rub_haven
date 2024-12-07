<?php
require 'db.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_name = htmlspecialchars($_POST['client_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $rating = intval($_POST['rating']);
    $recommendation = htmlspecialchars($_POST['recommendation']);

    $stmt = $conn->prepare("INSERT INTO spa_feedback (client_name, email, phone_number, rating, recommendation) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $client_name, $email, $phone_number, $rating, $recommendation);

    if ($stmt->execute()) {
        $success_message = "Thank you for your feedback!";
    } else {
        $error_message = "Something went wrong. Please try again.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spa Feedback</title>
 <link rel="stylesheet" href="./css/base.css">
</head>
<body>
    <div class="all">
        <div class="box">
        <div class="logo">
            <img src="./images/logo.png" alt="">
        </div>
        <h1>Rate Our Services</h1>
        <?php if (!empty($success_message)): ?>
            <p class="message"><?= $success_message; ?></p>
        <?php elseif (!empty($error_message)): ?>
            <p class="message error"><?= $error_message; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="forms">
                <label for="client_name">Full Name</label>
                <input type="text" id="client_name" name="client_name" placeholder="Enter your full name" required>
            </div>
            <div class="forms">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            </div>
            <div class="forms">
                <label for="phone_number">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" required pattern="[0-9]{10,15}" placeholder="Enter a valid phone number">
            </div>
            <div class="forms">
                <label for="rating">Rating (1-5)</label>
                <select id="rating" name="rating" required>
                    <option value="" selected hidden>Select Rating</option>
                    <option value="1">1 - Poor</option>
                    <option value="2">2 - Fair</option>
                    <option value="3">3 - Good</option>
                    <option value="4">4 - Very Good</option>
                    <option value="5">5 - Excellent</option>
                </select>
            </div>
            <div class="forms">
                <label for="recommendation">Recommendation / Report</label>
                <textarea id="recommendation" name="recommendation" placeholder="Write your recommendation / report" rows="4"></textarea>
            </div>
            <div class="forms">
            <button type="submit">Submit Feedback</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>
