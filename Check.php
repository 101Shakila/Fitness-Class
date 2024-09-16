<?php
//Just initializing the below variables to prevent "undefined variables"
$errors = [];
$firstName = $lastName = $dob = $gender = $email = $cellNumber = $batch = '';

//We will use function to remove any white space and make sure to convert SPECIAL characters to HTML entities
//Whenever a post is made on the server the below code ( validation ) will be executed.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = check_input($_POST['first_name']);
    $lastName = check_input($_POST['last_name']);
    $dob = check_input($_POST['dob']);
    $gender = check_input($_POST['gender']);
    $email = check_input($_POST['email']);
    $cellNumber = check_input($_POST['cell_number']);
    $batch = check_input($_POST['batch']);

    check_empty('first_name', $firstName);
    check_empty('last_name', $lastName);
    check_empty('dob', $dob);
    check_empty('gender', $gender);
    check_empty('email', $email);
    check_empty('cell_number', $cellNumber);
    check_empty('batch', $batch);
    
    checking_special_chars('first_name', $firstName);
    checking_special_chars('last_name', $lastName);
    
    validate_email($email);
    validate_cell_number($cellNumber);
    check_age($dob);
    
    if (empty($errors)) {
        header('Location: success.php');
        exit();
    }
}

function check_input($data) {
    return htmlspecialchars(trim($data));
}

//In PHP we use GLOBAL to access variable that's outside of the function
function check_empty($field, $value) {
    global $errors;
    if (empty($value)) {
        //$field will help identify which part the error is being generated from
        //we use str_replace so that for instance - instead of first_name is will display first name. Proper error displayed!
        $errors[$field] = (str_replace('_', ' ', $field)) . " is required.";
    }
}

//So here we will restrict the usage of special characters!
function checking_special_chars($field, $value) {
    global $errors;
    //preg_match is a PHP function - and we will check to see if the input is input is upper/lower case and has spaces and nothing else!
    if (!preg_match("/^[a-zA-Z ]*$/", $value)) {
        $errors[$field] = (str_replace('_', ' ', $field)) . " should not contain special characters.";
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

function check_age($dob) {
    global $errors;
    $birthDate = new DateTime($dob);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate)->y;

    if ($age < 18) {
        $errors['dob'] = "You must be 18+ to register.";
    }
}
?>
