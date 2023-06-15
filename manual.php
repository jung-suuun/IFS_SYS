<!DOCTYPE HTML>
<html>
	<head>
		<title>매뉴얼 확인</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="shortcut icon" href="images/favicon.ico">
		<?php
			ini_set("session.cache_expire", 43200);  
			ini_set("session.cookie_lifetime", 43200);  
			session_start();
			if(!isset($_SESSION['user_id'])) 
			{
				echo "<meta http-equiv='refresh' content='0;url=index.php'>";
				exit;
			}
		?>
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Main -->
				<div id="main">
					<div class="inner">
						<!-- Header -->
							<header id="header">
								<h1>매뉴얼자료</h1>
								<div style="text-align:right">
									<a href="index.php">
										<span class="fa fa-times fa-3x"></span>
									</a>
								</div>
							</header>
							
					<!-- Banner -->
						<section id="banner">
							<div class="content">
								<h2 style="color:black">■ TEST</h2>
								<ul class="actions">
									<li><a href='pdf-run/search2.php' class="button fit">TEST</a></li>
								</ul>
							</div>
						</section>
					</div>
				</div>
			</div>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	</body>
</html>
