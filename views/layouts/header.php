<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="/template/img/favicon.png" type="image/png">
        <title>Occupy Business</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/template/css/bootstrap.css">
        <link rel="stylesheet" href="/template/vendors/linericon/style.css">
        <link rel="stylesheet" href="/template/css/font-awesome.min.css">
        <link rel="stylesheet" href="/template/vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="/template/vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="/template/vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="/template/vendors/animate-css/animate.css">
        <link rel="stylesheet" href="/template/vendors/swiper/css/swiper.min.css">
        <!-- main css -->
        <link rel="stylesheet" href="/template/css/style.css">
        <link rel="stylesheet" href="/template/css/responsive.css">
    </head>
    <body>
        
        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="main_menu">
            	<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container box_1620">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="/"><img src="/template/img/logo.png" alt="home_link"></a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
							<ul class="nav navbar-nav menu_nav justify-content-center">
								<li class="nav-item active"><a class="nav-link" href="/">Home</a></li> 
								<li class="nav-item"><a class="nav-link" href="/about/">About</a></li> 
								<li class="nav-item"><a class="nav-link" href="/service/">Services</a>
								<li class="nav-item"><a class="nav-link" href="/portfoliopost/">Portfolio</a>
                                <li class="nav-item"><a class="nav-link" href="/blogpost/">blog</a>	
                                <?php if (Auth::isGuest()): ?>
                                    <li class="nav-item entrance"><a class="nav-link" href="/login/">Войти</a>
                                    <li class="nav-item"><a class="nav-link" href="/registration/">Регистрация</a>
                                <?php else: ?>	
                                    <li class="nav-item entrance"><a class="nav-link" href="/logout/">Выйти (<?= $_SESSION['first_name']?>)</a>
                                <?php endif; ?>
							</ul>
						</div> 
					</div>
            	</nav>
            </div>
        </header>
        <!--================Header Menu Area =================-->