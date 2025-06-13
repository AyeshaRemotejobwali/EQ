<?php
session_start();
require_once 'db.php';

// Sample questions (in a real scenario, these would be fetched from the database)
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

// Store answers in session and redirect
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['question_id'], $_POST['answer'])) {
        $question_id = (int)$_POST['question_id'];
        $answer = (int)$_POST['answer'];
        $_SESSION['answers'][$question_id] = $answer;
        $next_question = $question_id + 1;
        if ($next_question > count($questions)) {
            header('Location: result.php');
            exit;
        } else {
            header("Location: quiz.php?q=$next_question");
            exit;
        }
    }
}

// Get current question
$current_question = isset($_GET['q']) ? (int)$_GET['q'] : 1;
if ($current_question < 1 || $current_question > count($questions)) {
    $current_question = 1;
}
$question = $questions[$current_question - 1];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQ Test - Quiz</title>
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
        .quiz-container {
            max-width: 700px;
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #4a4a4a;
        }
        .options {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 30px;
        }
        .option {
            padding: 15px;
            background: #f4f4f4;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .option:hover {
            background: #e0e0e0;
        }
        .option input {
            display: none;
        }
        .option label {
            cursor: pointer;
            font-size: 1.1em;
        }
        .option input:checked + label {
            font-weight: bold;
            color: #6e8efb;
        }
        .progress {
            margin-bottom: 20px;
            font-size: 1em;
            color: #666;
        }
        .next-btn {
            background: #6e8efb;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background 0.3s;
        }
        .next-btn:hover {
            background: #a777e3;
        }
        .next-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        @media (max-width: 600px) {
            .quiz-container {
                padding: 20px;
            }
            h2 {
                font-size: 1.5em;
            }
            .option {
                padding: 10px;
            }
            .next-btn {
                padding: 8px 16px;
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <div class="progress">Question <?php echo $current_question; ?> of <?php echo count($questions); ?></div>
        <h2><?php echo $question['question']; ?></h2>
        <form method="POST" id="quiz-form">
            <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
            <div class="options">
                <?php foreach ($question['options'] as $index => $option): ?>
                    <div class="option">
                        <input type="radio" name="answer" id="option<?php echo $index; ?>" value="<?php echo $question['scores'][$index]; ?>" required>
                        <label for="option<?php echo $index; ?>"><?php echo $option; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="next-btn" id="next-btn" disabled>Next</button>
        </form>
    </div>
    <script>
        const form = document.getElementById('quiz-form');
        const nextBtn = document.getElementById('next-btn');
        const options = document.querySelectorAll('.option input');

        options.forEach(option => {
            option.addEventListener('change', () => {
                nextBtn.disabled = false; // Enable Next button when an option is selected
            });
        });

        document.querySelectorAll('.option').forEach(option => {
            option.addEventListener('click', () => {
                const input = option.querySelector('input');
                input.checked = true;
                options.forEach(opt => opt.checked = opt === input); // Uncheck other options
                nextBtn.disabled = false; // Enable Next button
            });
        });
    </script>
</body>
</html>
