<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two Factor Authentication</title>
</head>
<body>
    <h2>Two Factor Authentication</h2>

    <p>Hello {{ $user->name }},</p>

    <p>Two factor authentication has been {{ $status }} on your account.</p>

    <p>If you didn’t {{ $status }} this, contact support immediately.</p>

    <p>Thank you,</p>
    <p>FoodBox NG</p>
</body>
</html>