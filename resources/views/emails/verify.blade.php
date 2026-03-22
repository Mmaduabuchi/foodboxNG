<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <h2>Email Verification</h2>

    <p>Hello {{ $user->name }},</p>

    <p>Click the link below to verify your account:</p>

    <a href="{{ url('/verify-email/'.$user->token) }}">
        Verify Email
    </a>

    <p>If you didn’t create this account, ignore this email.</p>
</body>
</html>