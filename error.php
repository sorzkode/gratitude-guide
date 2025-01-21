<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get error message from URL parameter
$errorMessage = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'An unexpected error occurred.';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Error - Gratitude Letter</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        .error-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .error-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #ef4444;
        }

        .error-title {
            color: #ef4444;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .error-message {
            color: #4b5563;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .back-button {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #6528f7;
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
            transition: background-color 0.2s;
        }

        .back-button:hover {
            background-color: #4218a5;
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-icon">⚠️</div>
        <h1 class="error-title">Oops! Something went wrong</h1>
        <p class="error-message"><?php echo $errorMessage; ?></p>
        <a href="https://gratitude.thoughtcultivation.com" class="back-button">← Back to Letter Generator</a>
    </div>
</body>

</html>