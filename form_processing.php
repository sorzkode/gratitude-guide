<?php

require_once 'vendor/autoload.php';
require_once '.private/db_config.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Style\Section;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        try {
            // Collect and sanitize form data
            $formData = [
                'letter_title' => sanitizeInput($_POST['letterTitle']),
                'theme_color' => sanitizeInput($_POST['letterTheme']),
                'greeting' => sanitizeInput($_POST['letterGreeting']),
                'recipient_name' => sanitizeInput($_POST['recipientName']),
                'relationship_to' => sanitizeInput($_POST['relationshipTo']),
                'history_together' => sanitizeInput($_POST['historyTogether']),
                'shared_memories' => sanitizeInput($_POST['sharedMemories']),
                'impact_statement' => sanitizeInput($_POST['impactStatement']),
                'admired_qualities' => sanitizeInput($_POST['admiredQualities']),
                'thanks_for' => sanitizeInput($_POST['thanksFor']),
                'formal_closing' => sanitizeInput($_POST['formalClosing']),
                'signature' => sanitizeInput($_POST['yourSignature'])
            ];

            // If user choose to make public, save to db
            if (isset($_POST['makePublic']) && $_POST['makePublic'] === '1') {
                $pdo = getDbConnection();
                if (!$pdo) {
                    throw new Exception("Database connection failed");
                }            

            // Prepare SQL statement
            $sql = "INSERT INTO gratitude_letters (
                letter_title, theme_color, greeting, recipient_name, 
                relationship_to, history_together, shared_memories, 
                impact_statement, admired_qualities, thanks_for, 
                formal_closing, signature
            ) VALUES (
                :letter_title, :theme_color, :greeting, :recipient_name,
                :relationship_to, :history_together, :shared_memories,
                :impact_statement, :admired_qualities, :thanks_for,
                :formal_closing, :signature
            )";

            // Execute the database insert
            $stmt = $pdo->prepare($sql);
            $stmt->execute($formData);
            }

            // Create PHPWord document as before
            $phpWord = new PhpWord();

            $sectionStyle = [
                'borderTopSize' => 24,
                'borderTopColor' => ltrim($formData['theme_color'], '#'),
                'borderBottomSize' => 24,
                'borderBottomColor' => ltrim($formData['theme_color'], '#'),
            ];

            $section = $phpWord->addSection($sectionStyle);

            // Add content to document
            $section->addText(
                $formData['letter_title'],
                ['size' => 16, 'bold' => true, 'color' => $formData['theme_color']],
                ['align' => 'center']
            );

            $today = date('m/d/Y');
            $section->addText(
                "🗓️ $today",
                ['italic' => true, 'size' => 10, 'color' => $formData['theme_color']],
                ['align' => 'right']
            );

            $section->addText(
                "🙏🏻 My {$formData['relationship_to']}",
                ['size' => 10, 'color' => $formData['theme_color']],
                ['align' => 'right']
            );

            // Rest of the document content
            $section->addTextBreak(1);
            $section->addText("{$formData['greeting']} {$formData['recipient_name']},", ['size' => 12]);
            $section->addText("I am writing this letter to express my gratitude towards you. Although, the words may fall short in truly capturing my intention, I will do my best to explain how much you mean to me. Also, please don't feel the need to reciprocate any of these sentiments towards me. This letter is my gift to you, and in turn, it is a gift for me to write it.", ['size' => 11]);

            $section->addTextBreak(1);
            $section->addText('History', ['bold' => true, 'size' => 12, 'color' => $formData['theme_color']]);
            $section->addText($formData['history_together'], ['size' => 11]);

            $section->addTextBreak(1);
            $section->addText('Memories', ['bold' => true, 'size' => 12, 'color' => $formData['theme_color']]);
            $section->addText($formData['shared_memories'], ['size' => 11]);

            $section->addTextBreak(1);
            $section->addText('Impact', ['bold' => true, 'size' => 12, 'color' => $formData['theme_color']]);
            $section->addText($formData['impact_statement'], ['size' => 11]);

            $section->addTextBreak(1);
            $section->addText('Admiration', ['bold' => true, 'size' => 12, 'color' => $formData['theme_color']]);
            $section->addText($formData['admired_qualities'], ['size' => 11]);

            $section->addTextBreak(1);
            $section->addText('Gratitude', ['bold' => true, 'size' => 12, 'color' => $formData['theme_color']]);
            $section->addText($formData['thanks_for'], ['size' => 11]);

            $section->addTextBreak(2);
            $section->addText("{$formData['formal_closing']},", ['size' => 12]);
            $section->addText($formData['signature'], ['italic' => true, 'size' => 12]);

            // Start output buffering
            ob_start();

            // Save document
            $phpWordWriter = IOFactory::createWriter($phpWord, 'Word2007');
            $phpWordWriter->save('php://output');

            // Set headers for download
            header("Content-Description: File Transfer");
            header('Content-Disposition: attachment; filename=Gratitude_Letter_for_' .
                preg_replace("/[^a-zA-Z0-9]/", "_", $formData['recipient_name']) . '.docx');
            header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            header('Cache-Control: must-revalidate');
            header('Expires: 0');
            header('Pragma: public');
            header('Content-Length: ' . ob_get_length());

            // Flush output buffer
            ob_end_flush();

            // Regenerate CSRF token
            unset($_SESSION['csrf_token']);
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

            exit;
            
        } catch (Exception $e) {
            error_log("Error processing form: " . $e->getMessage());
            header('Location: error.php?message=' . urlencode('An error occurred while processing your letter.'));
            exit;
        }
    } else {
        error_log('CSRF token verification failed');
        header('Location: error.php?message=' . urlencode('CSRF token verification failed'));
        exit;
    }
}

header('Location: error.php?message=' . urlencode('Invalid request'));
exit;