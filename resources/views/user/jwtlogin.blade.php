@extends("layouts.base")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body{
        margin:0%;
        padding: 0%;
    }
    .container{
        border: solid black thin;
        margin: 20%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 300px;
        width: 100px;
    }
    form{
        height: 100%;
        width: 100%;
    }
    .form-group{
        width: 500px;
    }
</style>
<body>
    <div class="container">
        <form id="cform">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
             <div class="form-group">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="password">
            </div>

            <input type="submit" class="btn btn-primary">
        </form>
    </div>
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('js/jwt_token.js')}}"></script>
</body>
</html>