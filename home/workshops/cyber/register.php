<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "workshop_registration"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$college_name = $_POST['college_name'];
$reg_number = $_POST['reg_number'];
$department = $_POST['department'];
$student_name = $_POST['student_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Insert data into the database
$sql = "INSERT INTO cyber (college_name, reg_number, department, student_name, email, phone)
        VALUES ('$college_name', '$reg_number', '$department', '$student_name', '$email', '$phone')";

if ($conn->query($sql) === TRUE) {
    // Send confirmation email
    $to = $email;
    $subject = "Cybersecurity Workshop Registration Confirmation";
    $message = "Dear $student_name,\n\nThank you for registering for the Cybersecurity Workshop.\n\n" .
               "Here are your registration details:\n" .
               "College Name: $college_name\n" .
               "Registration Number: $reg_number\n" .
               "Department: $department\n" .
               "Phone: $phone\n\n" .
               "We look forward to seeing you at the workshop!\n\nBest regards,\nWorkshop Team";
    $headers = "From: tahseensyed685@gmail.com";

    if (mail($to, $subject, $message, $headers)) {
        // JavaScript for alert and redirection
        echo "<script>
                alert('Registration successful! A confirmation email has been sent to $email.');
                window.location.href = 'registration.html'; // Redirect to success page
              </script>";
    } else {
        echo "<script>
                alert('Registration successful, but the confirmation email could not be sent.');
                window.location.href = 'registration.html'; // Redirect to success page
              </script>";
    }
} else {
    echo "<script>
            alert('Error: " . addslashes($sql) . "\\n" . addslashes($conn->error) . "');
            window.location.href = 'registration.html'; // Redirect back to registration page
          </script>";
}

$conn->close();
?>