<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="description" content="">
  <meta name="author" content="">
  <title>
    <?=$fullname?>Web Wallet
  </title>
<meta property="og:site_name" content="GreenCoin GRN Web Wallet"/>
<meta property="og:title" content="GreenCoin GRN Web Wallet"/>
<meta property="og:url" content="https://wallet.greencoin.life/"/>
<meta property="og:type" content="website"/>
<meta property="og:image" content="https://preview.ibb.co/igPEry/Planet_1000px.png"/>
<meta property="og:image:width" content="128"/>
<meta property="og:image:height" content="128"/>
<meta itemprop="name" content="GreenCoin GRN Web Wallet"/>
<meta itemprop="url" content="https://wallet.greencoin.life/"/>
<meta itemprop="thumbnailUrl" content="https://preview.ibb.co/igPEry/Planet_1000px.png"/>
<link rel="image_src" href="https://preview.ibb.co/igPEry/Planet_1000px.png" />
<meta itemprop="image" content="https://preview.ibb.co/igPEry/Planet_1000px.png"/>
<meta name="twitter:title" content="GreenCoin GRN Exchange"/>
<meta name="twitter:image" content="https://preview.ibb.co/igPEry/Planet_1000px.png"/>
<meta name="twitter:url" content="https://twitter.com/GreenCoinGRN/"/>
<meta name="twitter:card" content="summary"/>
<meta name="description" content="GreenCoin GRN web wallet" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <!-- <link href="assets/css/wallet.css" rel="stylesheet"> -->
  <link href="assets/css/languages.min.css" rel="stylesheet">
</head>    
<body class="profile-page sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="30">
    <div class="container">
      <div class="dropdown button-dropdown">
        <a href="#pablo" class="dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
          <span class="button-bar"></span>
          <span class="button-bar"></span>
          <span class="button-bar"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
		<a class="dropdown-item" href="#"><span></span></a>
        </div>
      </div>
      <div class="navbar-translate">
        <a class="navbar-brand" href="/" rel="tooltip" title="<?=$fullname?> Web Wallet" data-placement="bottom">
          <?=$fullname?> Wallet
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar top-bar"></span>
          <span class="navbar-toggler-bar middle-bar"></span>
          <span class="navbar-toggler-bar bottom-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="../assets/img/blurred-image-1.jpg">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="http://greencoin.life">Main Site</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://greencoin.online/support/?ref=1">Have an issue?</a>
          </li>
	  <li class="nav-item">
                        <a class="nav-link" href="https://greencoin.online/?ref=1">
                            <i class="now-ui-icons loader_refresh spin"></i>
                            <p>GRN Exchange</p>
                        </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" rel="tooltip" data-placement="left" title="Change Language"><i class="fa fa-language"></i><p>Language</p></a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		<a class="dropdown-item" href="index.php?lang=en"><span class="lang-sm lang-lbl" lang="en"></span></a>
		<a class="dropdown-item" href="index.php?lang=grc"><span class="lang-sm lang-lbl" lang="el"></span></a>
		<a class="dropdown-item" href="index.php?lang=zho"><span class="lang-sm lang-lbl" lang="zh"></span></a>
		<a class="dropdown-item" href="index.php?lang=ita"><span class="lang-sm lang-lbl" lang="it"></span></a>
		<a class="dropdown-item" href="index.php?lang=por"><span class="lang-sm lang-lbl" lang="pt"></span></a>
		<a class="dropdown-item" href="index.php?lang=hin"><span class="lang-sm lang-lbl" lang="hi"></span></a>
		<a class="dropdown-item" href="index.php?lang=spa"><span class="lang-sm lang-lbl" lang="es"></span></a>
		<a class="dropdown-item" href="index.php?lang=tgl"><span class="lang-sm"></span>Tagalog</a>
		<a class="dropdown-item" href="index.php?lang=rus"><span class="lang-sm lang-lbl" lang="ru"></span></a>
		<a class="dropdown-item" href="index.php?lang=nld"><span class="lang-sm lang-lbl" lang="nl"></span></a>
		<a class="dropdown-item" href="index.php?lang=fra"><span class="lang-sm lang-lbl" lang="fr"></span></a>
		<a class="dropdown-item" href="index.php?lang=deu"><span class="lang-sm lang-lbl" lang="de"></span></a>
		<a class="dropdown-item" href="index.php?lang=tur"><span class="lang-sm lang-lbl" lang="tr"></span></a>
		<a class="dropdown-item" href="index.php?lang=vie"><span class="lang-sm lang-lbl" lang="vi"></span></a>
		<a class="dropdown-item" href="index.php?lang=jpn"><span class="lang-sm lang-lbl" lang="ja"></span></a>
		<a class="dropdown-item" href="index.php?lang=kor"><span class="lang-sm lang-lbl" lang="ko"></span></a>
		<a class="dropdown-item" href="index.php?lang=ara"><span class="lang-sm lang-lbl" lang="ar"></span></a>
</div>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/GreenCoinGRN" target="_blank">
              <i class="fab fa-twitter"></i>
              <p class="d-lg-none d-xl-none">Twitter</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://fb.me/GreenCoinGRN" target="_blank">
              <i class="fab fa-facebook-square"></i>
              <p class="d-lg-none d-xl-none">Facebook</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper">
