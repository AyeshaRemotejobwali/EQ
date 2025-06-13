<?php
session_start();
require_once 'db.php';

// Sample questions for score calculation (same as quiz.php)
$questions = [
    [
        'id' => 1,
        'question' => 'How often do you recognize your emotions as they occur?',
        'options' => ['Rarely', 'Sometimes', 'Often', 'Always'],
        'scores' => [1, 2, 3, 4]
    ],
    [
        'id' => 2,
        'question' => 'How well do you understand the emotions of others?',
        'options' => ['Not well', 'Somewhat', 'Well', 'Very well'],
        'scores' => [1, 2, 3, 4]
    ],
    [
        'id' => 3,
        'question' => 'How effectively do you manage stress in challenging situations?',
        'options' => ['Poorly', 'Adequately', 'Well', 'Exceptionally'],
        'scores' => [1, 2, 3, 4]
    ]
];

// Calculate score
$score = 0;
$max_score = count($questions) * 4; // Maximum score per question is 4
if (isset($_SESSION['answers'])) {
    foreach ($_SESSION['answers'] as $answer) {
        $score += (int)$answer;
    }
}

// Determine feedback based on score
$feedback = '';
if ($score <= $max_score * 0.4) {
    $feedback = "Your emotional intelligence could benefit from further development. Focus on practicing self-awareness and empathy in daily interactions.";
} elseif ($score <= $max_score * 0.7) {
    $feedback = "You have a good foundation in emotional intelligence. Continue to refine your skills in emotional regulation and understanding others.";
} else {
    $feedback = "Excellent! You demonstrate strong emotional intelligence. Keep nurturing your ability to connect with others and manage emotions effectively.";
}

// Clear session answers
unset($_SESSION['answers']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQ Test - Results</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .result-container {
            max-width: 700px;
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #4a4a4a;
        }
        .score {
            font-size: 3em;
            color: #6e8efb;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .btn {
            background: #6e8efb;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 1.1em;
            cursor: pointer;
            margin: 10px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #a777e3;
        }
        @media (max-width: 600px) {
            .result-container {
                padding: 20px;
            }
            h2 {
                font-size: 1.5em;
            }
            .score {
                font-size: 2.5em;
            }
            p {
                font-size: 1em;
            }
            .btn {
                padding: 8px 16px;
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h2>Your Emotional Intelligence Score</h2>
        <div class="score"><?php echo $score; ?> / <?php echo $max_score; ?></div>
        <p><?php echo $feedback; ?></p>
        <button class="btn" onclick="window.location.href='index.php'">Retake Test</button>
        <button class="btn" onclick="alert('Share functionality coming soon!')">Share Results</button>
    </div>
</body>
</html>
