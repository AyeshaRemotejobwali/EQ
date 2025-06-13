<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emotional Intelligence Test</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: #fff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: #333;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #4a4a4a;
        }
        p {
            font-size: 1.2em;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .start-btn {
            background: #6e8efb;
            color: #fff;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }
        .start-btn:hover {
            background: #a777e3;
            transform: scale(1.05);
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            h1 {
                font-size: 2em;
            }
            p {
                font-size: 1em;
            }
            .start-btn {
                padding: 10px 20px;
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Discover Your Emotional Intelligence</h1>
        <p>
            Emotional Intelligence (EQ) is the ability to understand and manage your emotions, as well as empathize with others. 
            Take our scientifically designed test to assess your self-awareness, empathy, and emotional regulation skills. 
            Get personalized feedback to unlock your emotional potential!
        </p>
        <button class="start-btn" onclick="window.location.href='quiz.php'">Start Test</button>
    </div>
</body>
</html>
