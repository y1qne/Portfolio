<!DOCTYPE html>
<html>
<head>
    <title>Email Confirmation</title>
</head>
<body>
    <p>Thank you for registering with our website.</p>
    <p>Please click the following link to confirm your email:</p>
    <a href="{{ url('/confirmation?token='.$confirmation_token) }}">{{ url('/confirmation?token='.$confirmation_token) }}</a>
</body>
</html>