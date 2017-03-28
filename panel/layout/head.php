<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="author" content="{{$settings['meta-author']}}">
	<meta name="description" content="{{$settings['meta-description']}}">
	<meta name="application-name" content="{{$settings['meta-application-name']}}">
	<title>{{ $title }}</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link rel="stylesheet" href="{{$panel}}/css/main.css">
</head>
<body>
    <div class="container--fluid">
        @panel('layout.admin_menu')
        <div class="scrollable">
			<div class="container--fluid">