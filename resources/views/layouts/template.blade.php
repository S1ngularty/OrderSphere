@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
@push('style')
<style>
    .content{
        margin:50px;
    }
</style>
<body>
    
    @yield('content')
    <div class="content"></div>
    
</body>
</html>