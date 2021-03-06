<!doctype html>
<html lang="pt_BR">
<head>
	<meta charset="utf-8">
	<title>{{ isset($title) ? $title . ' - ' : null }} Laravel - O Framework PHP para os Artesãos da Web</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="author" content="Taylor Otwell">
	<meta name="author" content="Vagner do Carmo">
	<meta name="description" content="Laravel - O Framework PHP para os Artesãos da Web">
	<meta name="keywords" content="laravel, php, framework, web, artisans, artesãos, Laravel Brasil">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if lte IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700,200italic,400italic,700italic"/>
	<link rel="stylesheet" href="{{elixir_wihout_scheme('assets/css/laravel.css')}}">
</head>
<body class="@yield('body-class', 'docs') language-php">
<!--email_off-->
	<span class="overlay"></span>

	<nav class="main">
		<div class="container">
			<a href="/" class="brand">
				<img src="/assets/img/laravel-logo.png" height="30" alt="Laravel logo">
				Laravel
			</a>

			<div class="responsive-sidebar-nav">
				<a href="#" class="toggle-slide menu-link btn">&#9776;</a>
			</div>

			@if (request()->is('docs*') && isset($currentVersion))
				@include('partials.switcher')
			@endif

			<ul class="main-nav">
				@include('partials.main-nav')
			</ul>
		</div>
	</nav>

	@yield('content')

	<footer class="main">
		<ul>
			@include('partials.main-nav')
		</ul>
		<p>Laravel é uma marca registrada de Taylor Otwell. Copyright &copy; Taylor Otwell.</p>
		<p class="less-significant"><a href="http://jackmcdade.com">Design by Jack McDade</a></p>
	</footer>
	<script src="{{elixir_wihout_scheme('assets/js/laravel.js')}}"></script>
<!--/email_off-->
</body>
</html>
