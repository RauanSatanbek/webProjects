<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bootstrap 101 Template</title>
		<script src="../js/jquery-1.12.1.min.js"></script>
		<script src="../Bootstrap3/js/bootstrap.js"></script>
		<link href="../Bootstrap3/css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" href="../font-awesome-4.6.3/css/font-awesome.min.css">
		<style>
			@font-face {
				font-family: Rauan; /* Гарнитура шрифта */
			    src: url(../шрифты/SFUIText-Light.otf); /* Путь к файлу со шрифтом */
			}
			*{
				margin: 0 0;
				padding: 0 0;
				font-family:'Rauan';
				text-decoration: none;
				outline: none;
				font-size: 14px;
				color:#fff;
			}
			.container{margin-top: 20px;}
			.row .leftDiv{
				background: #47A76A;
				height: 250px;
			}
			.row .rightDiv{
				background: #62639B;
				height: 250px;
			}
			h1{color: #444;}
			.navbar{border-radius: 0px;}
			.item img{height: 400px;}
		</style>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class = "navbar-toggle" data-toggle = "collapse" data-target = "#responsiver-menu">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse" id="responsiver-menu">
					<ul class="nav navbar-nav">
						<li><a href="" >Пункт 1</a></li>
						<li class = "dropdown">
							<a href="" class = "dropdown-toggle" data-toggle = "dropdown">Пункт 2 <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="" >Пункт 1</a></li>
								<li><a href="" >Пункт 2</a></li>
								<li><a href="" >Пункт 3</a></li>
								<li><a href="" >Пункт 4</a></li>
							</ul>
						</li>
						<li><a href="" >Пункт 3</a></li>
						<li><a href="" >Пункт 4</a></li>
					</ul>
				</div>
			</div>
		</div>

		<!--<div id="carousel" class="carousel slide">
		Индикаторы слайда
			<ol class="carousel-indicators">
				<li class = "active" data-target = "#carousel" data-slide-to = "0"></li>
				<li data-target = "#carousel" data-slide-to = "1"></li>
				<li data-target = "#carousel" data-slide-to = "2"></li>
			</ol>
		 Слайды
			<div class="carousel-inner">
				<div class="item active">
					<img src="../img/bootstrap-grid.jpg" width="100%" alt="">
					<div class="carousel-caption">
						<h3>Первый слайд</h3>
						<p>Описание первого слайда</p>
					</div>
				</div>
				<div class="item">
					<img src="../img/bootstrap-grid.jpg" width="100%" alt="">
					 <div class="carousel-caption">
						<h3>Второй слайд</h3>
						<p>Описание второго слайда</p>
					</div>
				</div>
				<div class="item">
					<div class="carousel-caption">
						<h3>Третий слайд</h3>
						<p>Описание третьего слайда</p>
					</div>
				</div>
			</div>
			<a href="#carousel" class="left carousel-control" data-slide = "prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>	
			<a href="#carousel" class="right carousel-control" data-slide = "next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>					
		</div>-->
		<div class="container">
			<div class="row">
				<h1>Название сайта</h1>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leftDiv">
					<h2 class="text">Hello world</h2>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightDiv">
					<h2 class="text">Привет мир</h2>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="btn-group">
					<button class="btn btn-primary"><i class="fa fa-scissors" aria-hidden="true"></i></button>
					<button class="btn btn-primary"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>
					<button class="btn btn-primary"><i class="fa fa-motorcycle" aria-hidden="true"></i></button>
				</div>
			</div>
		</div>
	</body>
</html>