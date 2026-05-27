<?php
include "database.php";
session_start();
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $stmt = $conn->prepare("SELECT username FROM userInfo WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();

        $stmt = $conn->prepare("SELECT password FROM userInfo WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result_password = $stmt->get_result()->fetch_assoc();

        if (password_verify($password, $result_password["password"])) {
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            $stmt->close();
            exit(); // after exit beacuse of the redirection done here
        } else {
            $message = "<span style='color: red;'>Password is incorrect</span>";
            $stmt->close();
        }
    } else {
        $message = "<span style='color: red;'>Username Not Found</span>";
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /* Modern reset and centering */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f4f6f9;
        }

        /* Form Container */
        form {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 400px;
            /* Prevents it from getting too wide on desktop */
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            /* Soft modern shadow */
            padding: 40px;
        }

        /* Typography */
        h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #333333;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            color: #555555;
            margin-bottom: 8px;
        }

        /* Inputs */
        input {
            padding: 12px 16px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.2s ease;
            outline: none;
        }

        input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
            /* Soft blue glow */
        }

        /* Button */
        button {
            margin-top: 10px;
            padding: 14px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        button:hover {
            background-color: #357abd;
        }
    </style>
</head>

<body>
    <form method="post">
        <h2>Welcome Back</h2>

        <div class="form-group">
            <label for="user">Username</label>
            <input type="text" id="user" name="user" placeholder="Enter your username" required>
        </div>

        <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" id="pass" name="pass" placeholder="Enter your password" required>
        </div>

        <button type="submit" name="login">Sign In</button>
        <?php echo "<h5>$message</h5>"; ?>
    </form>
</body>

</html>

<?php

?>