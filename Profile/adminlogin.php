<?php
session_start();

// 1. Check if the user is already logged in
if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true){
    header("Location: admin.php");
    exit();
}

// 2. Handle the Form Submission
$error_msg = "";

if(isset($_POST['login_btn'])){
    
    $username = $_POST['login_name'];
    $password = $_POST['password'];

    // 3. HARDCODED CREDENTIALS
    $valid_user = "123456";
    $valid_pass = "123456";

    if($username === $valid_user && $password === $valid_pass){
        // Success: Set session and redirect
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error_msg = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            /* Matches your profile page background */
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('1.jpg.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            width: 400px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            text-align: center;
        }

        h2 {
            color: #1a66ff; /* Your Blue Theme Color */
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"], 
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            outline: none;
            transition: 0.3s;
        }

        input[type="text"]:focus, 
        input[type="password"]:focus {
            border-color: #1a66ff;
            box-shadow: 0 0 5px rgba(26, 102, 255, 0.3);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #1a66ff;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #0044cc;
        }

        .error-text {
            color: red;
            background-color: #ffe6e6;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            display: <?php echo ($error_msg == "") ? "none" : "block"; ?>;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
    </style>

    <script>
        // Simple Client-Side Validation
        function validate_form() {
            var user = document.forms["login_form"]["login_name"].value;
            var pass = document.forms["login_form"]["password"].value;
            
            if (user == "") {
                alert("Please fill out Username.");
                return false;
            }
            if (pass == "") {
                alert("Please fill out Password.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

    <div class="login-card">
        <h2>Admin Portal</h2>

        <div class="error-text">
            <?php echo $error_msg; ?>
        </div>

        <form name="login_form" method="POST" action="" onsubmit="return validate_form();">
            
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="login_name" placeholder="Enter Username">
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password">
            </div>

            <button type="submit" name="login_btn" class="btn-login">LOGIN</button>
            
            <a href="Untitled-1.php" class="back-link">← Back to Website</a>
        </form>
    </div>

</body>
</html>