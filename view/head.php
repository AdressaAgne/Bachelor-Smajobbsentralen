<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>

    <nav class="container">
       <a href="/">home</a> |
        @foreach($menu as $item)
        
            <a href="/page/{{$item['permalink']}}">{{$item['header']}}</a> |
        
        @endforeach
    </nav>

<div class="container">