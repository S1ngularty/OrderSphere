@extends('layouts.base')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     
</head>
<body>

<div class="container" id="chart">
    <canvas id="categoryChart"></canvas>
</div>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="{{asset('js/categoryChart.js')}}"></script>
</body>
</html>