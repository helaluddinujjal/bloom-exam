<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr><td>Dear {{ $name }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Your account has been successfully updated. <br> Your account information is as bellow:</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Email: {{ $email }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>New Password:{{ $password }}</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>Thanks & Regards,</td></tr>
        <tr><td>Semster.com</td></tr>

    </table>
</body>
</html>