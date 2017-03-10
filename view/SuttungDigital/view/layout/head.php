<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="{{$settings['meta-author']}}"> 
    <meta name="description" content="{{$settings['meta-description']}}">
    <meta name="application-name" content="{{$settings['meta-application-name']}}">
    <title>{{ $title }}</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="{{$assets}}/css/main.css">
</head>
<body>


<div class="hero">
    <div class="logoContainer">
        @layout('layout.logo')
    </div>
    <div class="container">    
        <div class="menu">
            @layout('layout.menu')
        </div>
    </div>
    
</div>

<div class="container">