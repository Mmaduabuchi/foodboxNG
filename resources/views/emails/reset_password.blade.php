<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>

    <p>Click the link below to reset your password:</p>

    <a href="{{ url('/resetpassword?token='.$token.'&email='.$email) }}">
        Reset Password
    </a>

    <p>If you didn’t create this account, ignore this email.</p>

    <p>Thank you,</p>
    <p>FoodBox NG</p>
</body>
</html>