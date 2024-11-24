<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    // Collect form data
    $title = htmlspecialchars($_POST['letterTitle']);
    $themeColor = htmlspecialchars($_POST['letterTheme']);
    $greeting = htmlspecialchars($_POST['letterGreeting']);
    $recipient = htmlspecialchars($_POST['recipientName']);
    $relationship = htmlspecialchars($_POST['relationshipTo']);
    $history = htmlspecialchars($_POST['historyTogether']);
    $memories = htmlspecialchars($_POST['sharedMemories']);
    $impact = htmlspecialchars($_POST['impactStatement']);
    $admiration = htmlspecialchars($_POST['admiredQualities']);
    $thanks = htmlspecialchars($_POST['thanksFor']);
    $closing = htmlspecialchars($_POST['formalClosing']);
    $signature = htmlspecialchars($_POST['yourSignature']);
    $today = date('m/d/Y');

    // Prepare letter content
    $letterContent = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    border-top: 10px solid {$themeColor};
                    border-bottom: 10px solid {$themeColor};
                    font-size: 12px; 
                }
                h1 {
                    text-align: center;
                    color: {$themeColor};
                    margin-bottom: 20px;
                }
                h4 {
                    text-align: left;
                    color: {$themeColor};
                    margin-bottom: 10px;
                    font-family: Arial, sans-serif;
                    font-weight: bold;
                }
                h5 {
                    text-align: right;
                    margin-bottom: 0px;
                    font-family: Arial, sans-serif;
                    font-weight: bold;
                }
            </style>
        </head>
        <body>
            <h1>{$title}</h1>
            
            <h5><span style='color: {$themeColor};'>🗓️</span> {$today}</h5>
            <h5><span style='color: {$themeColor};'>🙏🏻</span> My {$relationship}</h5>
            
            <p>{$greeting} {$recipient},</p>

            <p>I am writing this letter to express my gratitude towards you. Although, the words may fall short in truly capturing my intention, I will do my best to explain how much you mean to me. Also, please don't feel the need to reciprocate any of these sentiments towards me. This letter is my gift to you, and in turn, it is a gift for me to write it.</p>

            <h4>History</h4> 
            <p>{$history}</p>
            
            <h4>Memories</h4>
            <p>{$memories}</p>
            
            <h4>Impact</h4>
            <p>{$impact}</p>
            
            <h4>Admiration</h4>
            <p>{$admiration}</p>
            
            <h4>Gratitude</h4>
            <p>{$thanks}</p>
            
            <p>{$closing},<br> 
            <i>{$signature}</i></p><br></br>

        </body>
        </html>
        ";

    // Set headers for file download
    header('Content-Type: application/vnd.ms-word');
    header("Content-Disposition: attachment; filename=Gratitude_Letter_for_" . preg_replace("/[^a-zA-Z0-9]/", "_", $recipient) . ".doc");
    header('Connection: close');

    // Output the file content
    echo $letterContent;
    unset($_SESSION['csrf_token']);
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    exit;
    }
    else {
        error_log('CSRF token verification failed');
        header('Location: error.php?message=CSRF token verification failed');
        exit;
    }
}

header('Location: error.php?message=Invalid request');
exit;
?>