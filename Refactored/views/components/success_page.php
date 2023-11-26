<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .success-container {
            text-align: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success-icon {
            font-size: 50px;
            color: #28a745;
        }

        .success-message {
            font-size: 24px;
            color: #28a745;
            margin-top: 10px;
        }

        .home-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s;
        }

        .home-link:hover {
            color: #0056b3;
        }
    </style>
</head>


<body>
    <div class="success-container">
        <div class="success-icon">&#10004;</div>
        <div class="success-message">Success! Your action was completed.</div>
        <a href="../views/auth/indexlogin.php" class="home-link">Go to Login Page</a>
    </div>
</body>

</html>
