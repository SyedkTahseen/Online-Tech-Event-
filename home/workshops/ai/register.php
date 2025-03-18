<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Default MySQL username in XAMPP
$password = ""; // Default MySQL password in XAMPP (empty)
$dbname = "workshop_registration"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect and process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $registration_number = trim($_POST['registration_number']);
    $name = htmlspecialchars(trim($_POST['name'])); // Prevent HTML injection
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL); // Sanitize email
    $contact = trim($_POST['contact']);
    $session = trim($_POST['session']);
    $message = htmlspecialchars(trim($_POST['message'])); // Prevent HTML injection
    $college_name = htmlspecialchars(trim($_POST['college_name'])); // Prevent HTML injection
    $department = htmlspecialchars(trim($_POST['department'])); // Prevent HTML injection
    $year = (int) $_POST['year']; // Ensure it's an integer

    // Validate inputs
    $errors = [];
    if (!preg_match('/^\d{10}$/', $registration_number)) {
        $errors[] = "Registration number must be exactly 10 digits.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }
    if (empty($name) || empty($email) || empty($contact) || empty($session) || empty($college_name) || empty($department)) {
        $errors[] = "All required fields must be filled.";
    }

    // If there are validation errors, display them
    if (!empty($errors)) {
        echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
        exit();
    }

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO workshop_registration (registration_number, full_name, email, contact_number, session, message, college_name, department, year) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssi", $registration_number, $name, $email, $contact, $session, $message, $college_name, $department, $year);

    if ($stmt->execute()) {
        // Send registration success email
        $subject = "Registration Successful - AI & Machine Learning Workshop";
        $body = "
        <html>
        <head>
            <title>Registration Confirmation</title>
        </head>
        <body>
            <p>Hello <strong>$name</strong>,</p>
            <p>Thank you for registering for the <strong>AI & Machine Learning Workshop</strong>. Here are your registration details:</p>
            <table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>
                <tr><td><strong>Registration Number:</strong></td><td>$registration_number</td></tr>
                <tr><td><strong>Name:</strong></td><td>$name</td></tr>
                <tr><td><strong>Email:</strong></td><td>$email</td></tr>
                <tr><td><strong>Session:</strong></td><td>$session</td></tr>
                <tr><td><strong>College Name:</strong></td><td>$college_name</td></tr>
                <tr><td><strong>Department:</strong></td><td>$department</td></tr>
                <tr><td><strong>Year:</strong></td><td>$year</td></tr>
            </table>
            <p>We look forward to seeing you at the event!</p>
        </body>
        </html>";

        // Set email headers for HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: tahseensyed685@gmail.com" . "\r\n";

        // Send email
        if (mail($email, $subject, $body, $headers)) {
            echo "<script>console.log('Email sent successfully');</script>";
        } else {
            echo "<script>console.log('Failed to send email');</script>";
        }

        // Redirect to the next page after successful registration
        echo "<script>
            alert('Registration Successful! Thank you for registering for the AI & Machine Learning Workshop. Stay tuned and be part of our workshop.');
            window.location.href = 'workshop_registration.html'; // Redirect to next page after pressing OK
        </script>";
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "<script>alert('Error: Registration failed. Please try again later.');</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>