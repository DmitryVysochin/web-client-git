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
<div style="background-color: #1b1e21; min-width: max-content; min-height: 4rem; border: solid black;">
    <div class="container-fluid text-center" style="min-height: 100%; padding: 0;">
        <div class="row" style="margin: 0;">
            <div class="col-2" style="min-height: max-content;border-right: solid black;"><h3 style="color: white">
                    репозитории</h3></div>
            <div class="col-2" style="min-height: max-content;border-right: solid black;"><h3 style="color: white">
                    ветки</h3></div>
            <div class="col-2" style="min-height: max-content;border-right: solid black;"><h3 style="color: white">
                    пуш</h3></div>
            <div class="col-6 justify-content-end items-right">
                <img src="/logo.png" width="106" height="64">
            </div>
        </div>
    </div>
</div>
