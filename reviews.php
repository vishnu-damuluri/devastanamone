<?php
// PHP MySQL connection
$servername = "localhost";
$username = "newuser";
$password = "newpassword";
$database = "temple";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $user_location = $_POST['user_location'];
    $user_review = $_POST['user_review'];

    // Server-side validation for review length
    if (strlen($user_review) > 100) {
        $error_message = "Review must be 100 characters or less.";
    } else {
        // Insert review into the database
        $stmt = $conn->prepare("INSERT INTO temple_reviews (user_name, user_location, user_review) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user_name, $user_location, $user_review);

        if ($stmt->execute()) {
            $success_message = "Review submitted successfully!";
        } else {
            $error_message = "Error submitting review: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Fetch all reviews from the database
$reviewsSql = "SELECT user_name, user_location, user_review FROM temple_reviews ORDER BY id DESC";
$reviewsResult = $conn->query($reviewsSql);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temple Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function validateReview() {
            var review = document.getElementById("user_review").value;
            if (review.length > 100) {
                alert("Review must be 100 characters or less.");
                return false;
            }
            return true;
        }

        function updateCharacterCount() {
            var review = document.getElementById("user_review").value;
            var charCount = review.length;
            document.getElementById("charCount").textContent = charCount;
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Submit Your Review</h2>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success" role="alert"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateReview();">
            <div class="mb-3">
                <label for="user_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name" required>
            </div>
            <div class="mb-3">
                <label for="user_location" class="form-label">From</label>
                <input type="text" class="form-control" id="user_location" name="user_location" required>
            </div>
            <div class="mb-3">
                <label for="user_review" class="form-label">Review</label>
                <textarea class="form-control" id="user_review" name="user_review" rows="3" maxlength="100" onkeyup="updateCharacterCount()" required></textarea>
                <small id="reviewHelp" class="form-text text-muted">Maximum 100 characters. You have used <span id="charCount">0</span> characters.</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <h2 class="mt-5">All Reviews</h2>
        <div class="row">
            <?php if ($reviewsResult->num_rows > 0): ?>
                <?php while($review = $reviewsResult->fetch_assoc()): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($review['user_name']); ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($review['user_location']); ?></h6>
                                <p class="card-text"><?php echo htmlspecialchars($review['user_review']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No reviews yet. Be the first to submit a review!</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
