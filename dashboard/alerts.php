<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['email'])) {
    header('Location: ../login.php');
    exit();
}

// PHP MySQL connection
$servername = "localhost";
$username = "root";
$password = "2626#26Vsl";
$database = "temple";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addAlert'])) {
        $alertText = $_POST['alertText'];
        $sql = "INSERT INTO temple_alerts (alert) VALUES ('$alertText')";

        if ($conn->query($sql) === TRUE) {
            echo "New alert added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['deleteAlert'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM temple_alerts WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Alert deleted successfully";
        } else {
            echo "Error deleting alert: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temple Alerts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Welcome to Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
        <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="">Alerts</a>
                </li>
            </ul>
                <li class="nav-item">
                    <a class="nav-link" href="./users.php">Users</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container mt-4">
        <h1 class="my-4">Temple Alerts</h1>
        
        <!-- Alert Form -->
        <form id="alertForm" method="post">
            <div class="mb-3">
                <label for="alertText" class="form-label">Alert Text</label>
                <input type="text" class="form-control" id="alertText" name="alertText" required>
            </div>
            <button type="submit" class="btn btn-primary" name="addAlert">Add Alert</button>
        </form>

        <hr>

        <!-- List of Alerts -->
        <div id="alertList">
            <!-- Alerts will be dynamically added here -->
            <?php
            // Fetch alerts from database
            $sql = "SELECT id, alert FROM temple_alerts ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo $row['alert'];
                    echo '<button type="button" class="btn-close" aria-label="Close" data-id="' . $row['id'] . '"></button>';
                    echo '</div>';
                }
            } else {
                echo "0 alerts found";
            }

            // Close database connection
            $conn->close();
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alertList = document.getElementById('alertList');

            // Add event listener for delete buttons
            alertList.addEventListener('click', async (event) => {
                if (event.target.classList.contains('btn-close')) {
                    const id = event.target.getAttribute('data-id');
                    try {
                        const formData = new FormData();
                        formData.append('id', id);
                        formData.append('deleteAlert', true);

                        const response = await fetch('', {
                            method: 'POST',
                            body: formData
                        });

                        const data = await response.text();
                        console.log(data); // Log response from server

                        // Refresh page after deletion (or update alert list dynamically)
                        location.reload();
                    } catch (error) {
                        console.error('Error deleting alert:', error);
                    }
                }
            });
        });
    </script>
</body>
</html>
