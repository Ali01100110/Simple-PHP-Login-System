<?php
include "database.php";
$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["username"])) {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $username = $_POST["username"];
    $password = $_POST["pass"];
    $confirm = $_POST["confirm_pass"];


    $stmt = $conn->prepare("SELECT * FROM userInfo where username = ? ");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $stmt->store_result();

    if ($password != $confirm) {
        $message = "<span style='color: red;'>Passwords do not match</span>";
        $stmt->close();
    } else if ($stmt->num_rows > 0) {
        $message = "<span style='color: red;'>Username : " . htmlspecialchars($username) . ", Already in Use</span>";
        $stmt->close();
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->close();


        $stmt = $conn->prepare("INSERT INTO userInfo (first_name,last_name,username,password) VALUES 
            (?,?,?,?);");
        $stmt->bind_param("ssss", $first_name, $last_name, $username, $password);

        if ($stmt->execute()) {
            $message = "<span style='color: green;'>Account Created Successfully, Redirecting To Login Page.</span>";
            echo '<meta http-equiv="refresh" content="2;url=login.php">';

        } else {
            $message = "<span style='color: red;'>Error Occurred: " . $stmt->error . "</span>";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp Page</title>
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
            max-width: 450px;
            /* Slightly widened to fit side-by-side inputs comfortably */
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            padding: 40px;
        }

        /* Typography */
        h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #333333;
        }

        /* Side-by-side row layout */
        .form-row {
            display: flex;
            gap: 16px;
            /* Spacing between the two inputs */
            width: 100%;
        }

        /* Ensures the group elements take equal space in a row or full space normally */
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            flex: 1;
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
            width: 100%;
        }

        input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.2);
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

        /* Responsive tweak for small mobile screens */
        @media (max-width: 480px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>

<body>
    <form method="POST">
        <h2>Create An Account</h2>

        <div class="form-row">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" placeholder="John" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" placeholder="Doe" required>
            </div>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>

        <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" id="pass" name="pass" placeholder="Enter your password" required>
        </div>

        <div class="form-group">
            <label for="confirm_pass">Confirm Password</label>
            <input type="password" id="confirm_pass" name="confirm_pass" placeholder="Confirm your password" required>
        </div>

        <button type="submit" name="signup">Sign Up</button>
        <?php echo "<h5>$message</h5>"; ?>
    </form>
</body>

</html>