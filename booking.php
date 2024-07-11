<?php
// Database credentials
$servername = "localhost";
$username = "newuser";
$password = "newpassword";
$database = "temple";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['mail'];
    $mobile = $_POST['mobile'];
    $service = $_POST['service']; // Get the service name
    $people = $_POST['people'];
    $total = $_POST['total'];
    $transactionid = uniqid(); // Generate a unique transaction ID

    $sql = "INSERT INTO seva_bookings (name, email, mobile, seva, people, total, transactionid) VALUES ('$name', '$email', '$mobile', '$service', '$people', '$total', '$transactionid')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Service Booking Form</h2>
        <form id="bookingForm" class="mt-3" action="booking.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="mail">Mail</label>
                <input type="email" class="form-control" id="mail" name="mail" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile" required>
            </div>
            <div class="form-group">
                <label for="service">Seva</label>
                <select class="form-control" id="service" name="service" placeholder="select seva"required>
                    <option value="Archana" data-cost="100">Archana - 100 Rs</option>
                    <option value="Service 2" data-cost="200">Service 2 - 200 Rs</option>
                    <option value="Service 3" data-cost="300">Service 3 - 300 Rs</option>
                </select>
            </div>
            <input type="hidden" id="service_cost" name="service_cost">
            <div class="form-group">
                <label for="people">Number of People</label>
                <select class="form-control" id="people" name="people" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>
            <div class="form-group">
                <label for="total">Total Cost</label>
                <input type="text" class="form-control" id="total" name="total" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#service, #people').change(function(){
                var serviceCost = parseInt($('#service option:selected').attr('data-cost'));
                var numberOfPeople = parseInt($('#people').val());
                var totalCost = serviceCost * numberOfPeople;
                $('#total').val(totalCost + ' Rs');
                $('#service_cost').val(serviceCost);
            });
        });
    </script>
</body>
</html>
