<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Email</title>
</head>

<body>
    <div class="container">
        <div class="col-sm-12">
            <h1>Welcome to Our Application, {{ $user->name }}!</h1>
            <p>Thank you for registering with us. We're excited to have you on board!</p>
            <p>If you have any questions or need assistance, feel free to reach out to our support team.</p>
            <p>Best regards,<br>The Team</p>
        </div>
    </div>
</body>

</html>
