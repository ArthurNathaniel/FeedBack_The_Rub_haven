<?php
require 'db.php'; // Include the database connection

// Fetch feedback from the database
$sql = "SELECT id, client_name, email, phone_number, rating, recommendation, created_at FROM spa_feedback ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 0 5%;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #5cb85c;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            font-size: 16px;
            color: #666;
        }
        .view-button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .view-button:hover {
            background-color: #0056b3;
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            width: 90%;
            text-align: center;
        }
        .close {
            float: right;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            color: #333;
        }
        .close:hover {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Feedback List</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Rating</th>
                        <th>Recommendation</th>
                        <th>Date Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['client_name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['phone_number']) ?></td>
                            <td><?= htmlspecialchars($row['rating']) ?></td>
                            <td>
                                <button class="view-button" onclick="openModal('modal-<?= $row['id'] ?>')">View</button>
                                <!-- Modal -->
                                <div id="modal-<?= $row['id'] ?>" class="modal">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal('modal-<?= $row['id'] ?>')">&times;</span>
                                        <h2>Recommendation</h2>
                                        <p><?= htmlspecialchars($row['recommendation']) ?></p>
                                    </div>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">No feedback available at the moment.</p>
        <?php endif; ?>
    </div>
    <script>
        // Open Modal
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        // Close Modal
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>
</body>
</html>
