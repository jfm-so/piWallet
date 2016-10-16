<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<!DOCTYPE HTML>

<html>
    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        
        <!-- Bootstrap include stuff -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/wallet.css" rel="stylesheet">
		<link href="assets/css/languages.min.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.6.0/moment.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- End Bootstrap include stuff-->
        <title><?=$fullname?> Wallet</title>
        <link rel="shortcut icon" href="favicon.ico">
    </head>
    
    
    <body>

        <nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php"><?=$fullname?> Wallet</a>
				</div>
				<div class="nav navbar-nav navbar-right">
					<div class="dropdown">
						<button class="btn btn-default navbar-btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							Language
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li>
								<a href="index.php?lang=en">
									<span class="lang-sm lang-lbl" lang="en"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=grc">
									<span class="lang-sm lang-lbl" lang="el"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=zho">
									<span class="lang-sm lang-lbl" lang="zh"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=ita">
									<span class="lang-sm lang-lbl" lang="it"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=por">
									<span class="lang-sm lang-lbl" lang="pt"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=hin">
									<span class="lang-sm lang-lbl" lang="hi"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=spa">
									<span class="lang-sm lang-lbl" lang="es"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=tgl">
									<span class="lang-sm"></span>Tagalog
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div><!-- /.container-fluid -->
        </nav>
        
        <div class="jumbotron" style="background-color:#ffe6ad">
            <div class="container">
