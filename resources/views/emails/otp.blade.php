<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>
<body>
    <h2>OTP Verification</h2>

    <p>Hello {{ $user->name }},</p>

    <p>Your OTP is: {{ $otp }}</p>

    <p>If you didn’t login to this account, ignore this email.</p>

    <p>Thank you,</p>
    <p>FoodBox NG</p>
</body>
</html>