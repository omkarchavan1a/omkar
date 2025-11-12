<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
   exit();
}

require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('CSRF token validation failed');
    }
}
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Registration</h2>
        <?php
        if (isset($_POST["submit"])) {
            try {
                $fullName = trim(htmlspecialchars($_POST["fullname"]));
                $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
                $password = $_POST["password"];
                $passwordRepeat = $_POST["repeat_password"];
                
                $errors = array();
                
                // Validate input
                if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
                    array_push($errors, "All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }
                if (strlen($password) < 8) {
                    array_push($errors, "Password must be at least 8 characters long");
                }
                if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
                    array_push($errors, "Password must contain at least one uppercase letter, one lowercase letter, one number and one special character");
                }
                if ($password !== $passwordRepeat) {
                    array_push($errors, "Password does not match");
                }
                
                // Check if email already exists
                $check_sql = "SELECT * FROM users WHERE email = ?";
                $check_stmt = mysqli_prepare($conn, $check_sql);
                if (!$check_stmt) {
                    throw new Exception("Database error: " . mysqli_error($conn));
                }
                
                mysqli_stmt_bind_param($check_stmt, "s", $email);
                mysqli_stmt_execute($check_stmt);
                $result = mysqli_stmt_get_result($check_stmt);
                
                if (mysqli_num_rows($result) > 0) {
                    array_push($errors, "Email already exists!");
                }
                
                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                } else {
                    // Hash password
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Insert new user
                    $insert_sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
                    $insert_stmt = mysqli_prepare($conn, $insert_sql);
                    if (!$insert_stmt) {
                        throw new Exception("Database error: " . mysqli_error($conn));
                    }
                    
                    mysqli_stmt_bind_param($insert_stmt, "sss", $fullName, $email, $passwordHash);
                    
                    if (mysqli_stmt_execute($insert_stmt)) {
                        echo "<div class='alert alert-success'>Registration successful! You can now <a href='login.php'>login</a>.</div>";
                    } else {
                        throw new Exception("Error creating user: " . mysqli_error($conn));
                    }
                }
            } catch (Exception $e) {
                echo "<div class='alert alert-danger'>An error occurred: " . htmlspecialchars($e->getMessage()) . "</div>";
            }
        }
        ?>
        <form action="registration.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <small class="form-text text-muted">Password must be at least 8 characters long and contain uppercase, lowercase, number and special character.</small>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password" required>
            </div>
            <div class="form-btn mt-2">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div class="mt-3">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>