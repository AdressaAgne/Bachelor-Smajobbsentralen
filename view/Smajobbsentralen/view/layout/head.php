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
	<link rel="stylesheet" href="{{$assets}}/css/font-awesome.min.css">
</head>
<body>



<div class="menu">
	<div class="container">
		@layout('layout.menu')
	</div>
</div>

<div class="container">
