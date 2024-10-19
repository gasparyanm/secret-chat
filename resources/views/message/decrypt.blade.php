<!DOCTYPE html>
<html>
<head>
    <title>Secret Message</title>
</head>
<body>
    <h1>You have a new secret message</h1>
    <p>Click the button below to read your message or copy and past this code - <span style="color: #28a745;">{{$code}}</span></p>
    <a href="{{ $url }}" style="padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none;">Read Message</a>
    <p>If the button doesn't work, copy and paste the following link into your browser:</p>
    <p><a href="{{ $url }}">{{ $url }}</a></p>
    <p>Thank you for using our service!</p>
</body>
</html>
