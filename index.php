<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fitness Class Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Register for a Fitness Class</h2>
        <?php
        include 'Check.php';
        ?>
        <form action="" method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?= htmlspecialchars($firstName) ?>" required>
            <span class="error"><?= $errors['first_name'] ?? '' ?></span>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="<?= htmlspecialchars($lastName) ?>" required>
            <span class="error"><?= $errors['last_name'] ?? '' ?></span>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" value="<?= htmlspecialchars($dob) ?>" required>
            <span class="error"><?= $errors['dob'] ?? '' ?></span>

            <label for="gender">Gender:</label>
            <select name="gender" required>
                <option value="">Select</option>
                <option value="Male" <?= $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Other" <?= $gender == 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
            <span class="error"><?= $errors['gender'] ?? '' ?></span>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
            <span class="error"><?= $errors['email'] ?? '' ?></span>

            <label for="cell_number">Cell Number:</label>
            <input type="text" name="cell_number" value="<?= htmlspecialchars($cellNumber) ?>" required>
            <span class="error"><?= $errors['cell_number'] ?? '' ?></span>

            <label for="batch">Batch:</label>
            <select name="batch" required>
                <option value="">Select</option>
                <option value="Morning" <?= $batch == 'Morning' ? 'selected' : '' ?>>Morning</option>
                <option value="Afternoon" <?= $batch == 'Afternoon' ? 'selected' : '' ?>>Afternoon</option>
                <option value="Evening" <?= $batch == 'Evening' ? 'selected' : '' ?>>Evening</option>
            </select>
            <span class="error"><?= $errors['batch'] ?? '' ?></span>

            <input type="submit" name="submit" value="Register">
        </form>
    </div>
</body>
</html>
