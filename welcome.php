<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$login_user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        /* Modern Reset and Centering */
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

        /* Centered Welcome Card */
        .welcome-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 100%;
            max-width: 450px;
            /* Limits width on desktop */
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            padding: 50px 40px;
            margin: 20px;
        }

        /* Typography */
        h1 {
            font-size: 32px;
            color: #222222;
            margin-bottom: 12px;
            font-weight: 700;
        }

        p {
            font-size: 16px;
            color: #666666;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        /* Button Container */
        .button-group {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 12px;
            /* Adds space between buttons */
        }

        /* Shared Button Styles */
        .btn {
            display: inline-block;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.2s ease, color 0.2s ease;
            text-align: center;
        }

        /* Call to Action Button */
        .btn-continue {
            background-color: #4a90e2;
            color: white;
        }

        .btn-continue:hover {
            background-color: #357abd;
        }

        /* Logout Button (Secondary Outline Style) */
        .btn-logout {
            background-color: transparent;
            color: #e04f5f;
            border: 2px solid #e04f5f;
        }

        .btn-logout:hover {
            background-color: #e04f5f;
            color: white;
        }
    </style>
</head>

<body>

    <div class="welcome-card">
        <h1>Welcome Back!</h1>
        <?php
        echo "<p>You have successfully logged in as '" . htmlspecialchars($login_user) . "'. Glad to have you here today.</p> "
        ?>

        <div class="button-group">
            <button class="btn btn-continue">Go to Dashboard</button>
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </div>
    </div>

</body>

</html>