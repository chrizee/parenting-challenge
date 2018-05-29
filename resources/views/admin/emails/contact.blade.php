<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        p {
            text-align: left;
            margin: 5px;
        }
        div.container {
            display: block;
            margin: 20px auto;
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <p>You recieved a message from a user of Improveparenting</p>
    <p>Below is the content of the message</p>
    <p><strong>Name:</strong> {{ $request['name'] }}</p>
    <p><strong>E-mail:</strong> {{ $request['email'] }}</p>
    <p><strong>Message:</strong> {{ $request['message'] }}</p>

</div>
</body>
</html>
