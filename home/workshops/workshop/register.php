<?php
// Database connection details
$host = 'localhost';
$dbname = 'workshop_registration';
$username = 'root'; // Default username for local MySQL
$password = ''; // Default password for local MySQL

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<script>alert('Database connection failed!'); window.history.back();</script>");
}

// Get form data & trim spaces
$full_name = trim($_POST['full_name']);
$email = trim($_POST['email']);
$contact_number = trim($_POST['contact_number']);
$gender = trim($_POST['gender']);
$organization = trim($_POST['organization']);
$designation = trim($_POST['designation']);
$department = isset($_POST['department']) ? trim($_POST['department']) : null;
$workshop_name = trim($_POST['workshop_name']);
$workshop_mode = trim($_POST['workshop_mode']);
$registration_number = trim($_POST['registration_number']); // Get registration number from the form

// ✅ 1. Check if any field is empty
if (empty($full_name) || empty($email) || empty($contact_number) || empty($gender) || empty($organization) || empty($designation) || empty($workshop_name) || empty($workshop_mode)) {
    echo "<script>alert('All fields are required!'); window.history.back();</script>";
    exit();
}

// ✅ 2. Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format! Please enter a valid email.'); window.history.back();</script>";
    exit();
}

// ✅ 3. Validate phone number (10 digits, only numbers)
if (!preg_match('/^[0-9]{10}$/', $contact_number)) {
    echo "<script>alert('Invalid phone number! It must be exactly 10 digits.'); window.history.back();</script>";
    exit();
}

// ✅ 4. Handle registration number
if (empty($registration_number)) {
    // If registration number is not provided, generate one
    $registration_number = 'REG' . date('Ymd') . '-' . mt_rand(1000, 9999); // Example: REG20231025-1234
} else {
    // If registration number is provided, validate it
    if (!preg_match('/^[A-Za-z0-9-]+$/', $registration_number)) {
        echo "<script>alert('Invalid registration number! It can only contain letters, numbers, and hyphens.'); window.history.back();</script>";
        exit();
    }
}

// ✅ 5. Check if registration number already exists
$check_sql = "SELECT id FROM registrations WHERE registration_number = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $registration_number);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    echo "<script>alert('Error: Registration number already exists. Please use a different one.'); window.history.back();</script>";
    exit();
}

// ✅ 6. Insert data into the database
$sql = "INSERT INTO registrations (full_name, email, contact_number, gender, organization, designation, department, workshop_name, workshop_mode, registration_number) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssss", $full_name, $email, $contact_number, $gender, $organization, $designation, $department, $workshop_name, $workshop_mode, $registration_number);

if ($stmt->execute()) {
    // Send confirmation email
    $subject = "Workshop Registration Confirmation - AI & Machine Learning Workshop";
    $message = "Hello $full_name,\n\nThank you for registering for the AI & Machine Learning Workshop. Your registration number is: $registration_number\n\nWorkshop Details:\n- Workshop Name: $workshop_name\n- Session: $workshop_mode\n\nWe look forward to seeing you at the event!";
    $headers = "tahseensyed685@gmail.com";  // You can use your own email here

    // Send email
    if (mail($email, $subject, $message, $headers)) {
        echo "<script>alert('Registration successful! Your registration number is: $registration_number. A confirmation email has been sent.'); window.location.href='regestersuccess.html';</script>";
    } else {
        echo "<script>alert('Registration successful! Your registration number is: $registration_number, but failed to send confirmation email.'); window.location.href='regestersuccess.html';</script>";
    }
} else {
    echo "<script>alert('Error: " . addslashes($conn->error) . "'); window.history.back();</script>";
}

// Close connections
$check_stmt->close();
$stmt->close();
$conn->close();
?>
