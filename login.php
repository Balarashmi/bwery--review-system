<?php
    require_once "db.php";

    // Check if the form is submitted
    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email . "' AND password = '" . md5($password) . "'");

        if ($row = mysqli_fetch_assoc($result)) {
            // Authentication successful, redirect to a secure page
            header("Location: welcome.php");
            exit();
        } else {
            $login_error = "Invalid email or password";
        }

        mysqli_free_result($result);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fce4ec; /* Light Pink */
        }

        .container {
            margin-top: 50px;
        }

        .page-header {
            background-color: #e91e63; /* Pink */
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #e91e63; /* Pink */
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #e91e63; /* Pink */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ad1457; /* Darker Pink */
        }

        .btn-default {
            background-color: #fff;
            color: #e91e63; /* Pink */
            border: 1px solid #e91e63; /* Pink */
        }

        .btn-default:hover {
            background-color: #e91e63; /* Pink */
            color: #fff;
        }

        .text-danger {
            color: #e91e63; /* Pink */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-offset-2">
                <div class="page-header">
                    <h2>Login Form</h2>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="" maxlength="30" required="">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="" maxlength="8" required="">
                    </div>

                    <input type="submit" class="btn btn-primary" name="login" value="Login">
                    Don't have an account? <a href="registration.php" class="btn btn-default">Register</a>

                    <span class="text-danger"><?php if (isset($login_error)) echo $login_error; ?></span>
                </form>
            </div>
        </div>    
    </div>
</body>
</html>
