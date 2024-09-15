<?php
//Just initializing the below variables to prevent "undefined variables"
$errors = [];
$firstName = $lastName = $dob = $gender = $email = $cellNumber = $batch = '';

//We will use function to remove any white space and make sure to convert SPECIAL characters to HTML entities 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = check_input($_POST['first_name']);
    $lastName = check_input($_POST['last_name']);
    $dob = check_input($_POST['dob']);
    $gender = check_input($_POST['gender']);
    $email = check_input($_POST['email']);
    $cellNumber = check_input($_POST['cell_number']);
    $batch = check_input($_POST['batch']);

    validate_empty('first_name', $firstName);
    validate_empty('last_name', $lastName);
    validate_empty('dob', $dob);
    validate_empty('gender', $gender);
    validate_empty('email', $email);
    validate_empty('cell_number', $cellNumber);
    validate_empty('batch', $batch);
    
    validate_no_special_chars('first_name', $firstName);
    validate_no_special_chars('last_name', $lastName);
    
    validate_email($email);
    validate_cell_number($cellNumber);
    validate_age($dob);
    
    if (empty($errors)) {
        header('Location: success.php');
        exit();
    }
}

function check_input($data) {
    return htmlspecialchars(trim($data));
}

function validate_empty($field, $value) {
    global $errors;
    if (empty($value)) {
        $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
    }
}

function validate_no_special_chars($field, $value) {
    global $errors;
    if (!preg_match("/^[a-zA-Z ]*$/", $value)) {
        $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " should not contain special characters.";
    }
}

function validate_email($email) {
    global $errors;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
}

function validate_cell_number($cellNumber) {
    global $errors;
    if (!preg_match("/^[0-9]{10}$/", $cellNumber)) {
        $errors['cell_number'] = "Invalid cell number. Must be 10 digits.";
    }
}

function validate_age($dob) {
    global $errors;
    $birthDate = new DateTime($dob);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate)->y;

    if ($age < 18) {
        $errors['dob'] = "You must be 18+ to register.";
    }
}
?>
