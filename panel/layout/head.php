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
    <div class="container">
        @panel('layout.admin_menu')