<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="../js/jquery-1.12.1.min.js"></script>
	<script src="../Bootstrap3/js/bootstrap.js"></script>
	<link href="../Bootstrap3/css/bootstrap.css" rel="stylesheet">
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
			.row .leftCol{
				background: #47A76A;
				height: 1000px;
			}
			.row .rightCol{
				background: #62639B;
				height: 1000px;
			}
			h1{color: #444;}
			.navbar{border-radius: 0px;}
			.item img{height: 400px;}
	</style>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class = "navbar-toggle" data-toggle = "collapse" data-target = "#collapse-menu">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id = "collapse-menu">
				<ul class="nav navbar-nav">
					<li><a href="" >Пункт 1</a></li>
					<li><a href="" >Пункт 2</a></li>
					<li class = "dropdown">
						<a href="" class = "dropdown-toggle" data-toggle = "dropdown">Пункт 3 <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="">Пункт 1</a></li>
							<li><a href="">Пункт 2</a></li>
							<li><a href="">Пункт 3</a></li>
							<li><a href="">Пункт 4</a></li>
						</ul>
					</li>
					<li><a href="" >Пункт 4</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leftCol">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum eaque possimus illo cumque blanditiis officia repellat iusto eligendi dolor, illum?
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightCol">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor nostrum blanditiis dignissimos quaerat veritatis harum quasi ad quo eius, accusamus ipsum, sunt, sit veniam labore quae. Harum nostrum et, ratione iste distinctio id sequi non ex quo libero perspiciatis assumenda fugiat laboriosam. Nihil voluptatum amet in incidunt tempora tempore perspiciatis quisquam ex deleniti quae voluptate, sit, vel doloremque illo. Inventore cupiditate tempora commodi distinctio maiores quae nulla, cum minus esse quam sed, accusamus laboriosam eaque quasi architecto! Modi cum rem dolorum error sapiente pariatur atque porro ipsa iste officiis neque nesciunt repellat maxime delectus voluptas aut, veritatis ullam excepturi culpa, dicta perspiciatis itaque nulla, dignissimos a assumenda? Distinctio quis fugit similique. Architecto ipsum veniam perferendis sequi, praesentium excepturi minima a doloribus. A hic omnis ratione sunt cum mollitia, atque rem voluptate eos accusantium voluptatibus eveniet, eaque, cupiditate perspiciatis deserunt sit at dignissimos qui. Sequi, quibusdam, unde. Dolorum adipisci nulla modi deserunt, enim laudantium tenetur quos earum alias minima. Et, consequuntur, laudantium. Maxime possimus praesentium quisquam quam sapiente provident, reiciendis omnis! Possimus, molestias neque enim reiciendis nostrum dicta, aspernatur quibusdam voluptas. Accusantium repellat laborum adipisci enim quod quae, rem omnis dolore impedit architecto optio qui corporis iure similique modi et repudiandae.
			</div>
		</div>
	</div>
</body>
</html>