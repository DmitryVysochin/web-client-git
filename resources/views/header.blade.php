<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="/css/all.css" rel="stylesheet">
    <!-- Styles -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div style="background-color: black; width: 100%; height: 10%;">

    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-2"><h3 style="color: white">репозитории</h3></div>
            <div class="col-2"><h3 style="color: white">ветки</h3></div>
            <div class="col-2"><h3 style="color: white">пуш</h3></div>
            <div class="col-6 justify-content-end items-right">
                <img src="/logo.png" width="161" height="97">
            </div>
        </div>
    </div>
</div>
