<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Mail</title>
    <style>
        /* Inline styles for simplicity, consider using CSS classes for larger templates */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .message {
            font-size: 16px;
            padding: 15px;
        }

        .message p {
            margin-bottom: 10px;
        }
        .fromText{
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="">  
            <img src="{{asset('images/mylogo1.png')}}" alt="My Logo" width="200">
        </div>
        <div class="message">
            <p>姓名 : <span class="fromText">{{$data->name}}</span></p>
            <p>電郵 : <span class="fromText">{{$data->email}}</span></p>
            <p>內容: <br/> <span class="">{!! nl2br($data->message) !!} </span> </p>
        </div>
    </div>
</body>
</html>


