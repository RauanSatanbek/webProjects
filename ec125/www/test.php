<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="shortcut icon" href="../img/el2.jpg" type="image/jpg">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../font-awesome-4.6.3/css/font-awesome.min.css">
	<script src = "../js/jquery-1.12.1.min.js"></script>
	<script src = "../js/scripts.js"></script>
	<style>
		.allInfoAboutIt{
			height: 350px;
		}
		/* .headerText{font-family: 'RauanO';font-size: 60px;color: #fff;margin: 15px;display: inline-block;margin-top: 0;letter-spacing: -3px;}*/
		.headerText{font-size: 35px;color: #fff;margin: 15px;display: inline-block;}
		.FontT{font-family: 'RauanT';color:#fff;font-size: 50px;letter-spacing: -3px;}
		.article{text-align: center;font-size: 23px;color:rgb(13,103, 165);font-weight: bold;background-position: -20px 0;}
		.logotip{background:#444;background: url(../img/el.jpg); background-repeat: no-repeat;width: 560px; height:134px;margin: 0 auto;}
		.innerText{width: 560px;height: 125px;margin: 0 auto;background: #fff;padding-top: 20px;}
		.allInfoAboutIt{border-top: none;}
	</style>
</head>
<body>
	<!-- ELITE LANGUAGE &<br>TRAINING CENTER -->
	<div class="container">
		<div class = 'middle'>
			<header class = "header grayDivs">
				<div class = "logotip"></div>
				<!-- <img src="../img/el.jpg"  class = "logo"> -->
				<!-- <p class="headerText">eli<span class = "FontT">t</span>e</p> -->
				<!-- <p class="headerText">ELITE LANGUAGE &<br>TRAINING CENTER</p> -->
				<div class = "innerText">
					<article class = "article">
						Обучение английскому и китайскому языку<br>
						Режим работы учебного центра<br>Понедельник - Суббота<br>10.00 - 21.00
					</article>
				</div>
			</header>
			<div class="body">
			<div class="whiteDivs allInfoAboutIt">
				<script>
					$(document).ready(function(){
						var c = 1;
						$(".AboutUs").click(function(){
							if (c % 2 == 0) {
								$("#aboutUs").html('О компании <i class="fa fa-circle faBlue faBlue1" aria-hidden="true"></i>');
								$("#workStyle").html('Наши услуги <i class="fa fa-circle-o faBlue" aria-hidden="true">');
								$(".AboutUsDiv").slideDown(1000);
								$(".workStyleDiv").slideUp(1000);
								c++;
							}

							else {
								$("#workStyle").html('Наши услуги <i class="fa fa-circle faBlue" aria-hidden="true"></i>');
								$("#aboutUs").html('О компании <i class="fa fa-circle-o faBlue faBlue1" aria-hidden="true">');
								$(".AboutUsDiv").slideUp(1000);
								$(".workStyleDiv").slideDown(1000);
								c++;
							}
						});
						$(".openAllRecalls").click(function(){
							$(".hideRecalls").slideToggle(1000);
						});
						var id = "method";
							var left = 0;
							var down = 0;
							m = [],
							speed = 1,
							jump = 200,
							time = 2000;
						$(window).on("keydown",function(){
							var keyDown = event.keyCode;
							if(!m.includes(keyDown))
								m.push(keyDown);
							if(m.includes(68))
								left+=speed;
							if(m.includes(83))
								down+=speed;
							if(m.includes(87))
								down-=speed;
							if(m.includes(65))
								left-=speed;
							console.log(left + "px "+(down + "px"));
							$("#" + id).css('backgroundPosition', left + "px "+(down + "px"));
							
							$(window).bind("keyup",function(){
								var keyUp = event.keyCode;
								if(m.includes(keyUp)){
									var index = m.indexOf(keyUp);
									delete m[index];
								}
							});
						
						});
					});
				</script>
				<style type="text/css">
				.puncts{
					margin-top: 10px;
					list-style:none;
				}
				.workStyleDiv .message p{
					margin-top: 5px;
				}
				</style>
				<table class = "tWsAu table2">
					<tr>
						<td class = "tdPhoto">
							<div class="photo" id = "photo"></div>
						</td>
						<td>
							<div class="text">
								<div class ="AboutUsDiv">
									<p class = "aboutMeP">О компании</p>
									<article class="message">

										<b>Компания «ELITE LANGUAGE AND TRAINING CENTER» в Астане</b><br>
										Учебно-языковой центр " ELITE LANGUAGE AND TRAINING CENTER" - это эффективная и современная методика обучения.
										<br><b>Преимущества компании « ELITE LANGUAGE AND TRAINING CENTER »</b>
										<ul class = "puncts">
											<li>&#10004; Новейшая методика</li>
											<li>&#10004; Наши преподаватели</li>
											<li>&#10004; Удобное расписание</li>
											<li>&#10004; Выгодные цены</li>
											<li>&#10004; Индивидуальные программы</li>
										</ul>		
									</article>					
								</div>
								<style>
									.faBlue{
										font-size: 10px;
									}		
									.faBlue1{margin-left: 15px;}					
								</style>
								<div class ="Hide workStyleDiv">
									<p class = "aboutMeP">Наши услуги</p>
									<article class="message">
										<p><b><i class="fa fa-check-square-o" aria-hidden="true"></i> Английский язык.</b> Изучение английского языка как и местными преподавателями так и с носителями языка! По окончании курсов выдается сертификат.</p>
										<p><b><i class="fa fa-check-square-o" aria-hidden="true"></i> Образование за рубежом.</b></p>
										<p><b><i class="fa fa-check-square-o" aria-hidden="true"></i> Подготовка к международным экзаменам IELTS и TOEFL.</b> Удобная форма обучения в малых группах и индивидуально в удобное для Вас время.</p>
										<p><b><i class="fa fa-check-square-o" aria-hidden="true"></i> Китайский язык.Изучение китайского языка.</b> У Вас есть шанс идти в ногу со временем. Не упусти свой шанс приходи к нам.</p>
										<p><b><i class="fa fa-check-square-o" aria-hidden="true"></i> Работает группа продленного дня.</b> Обучение проводится в группах и индивидуально.</p>
										 

									</article>
								</div>
							</div>
						</td>
						<td class = "tdworkMetods">
							<div class="workMetods">
								<ul class = "ul">
									<li class = "AboutUs li" id = "aboutUs">О компании    <i class="fa fa-circle faBlue faBlue1" aria-hidden="true"></i></li>
									<li class = "AboutUs li" id = "workStyle">Наши услуги <i class="fa fa-circle-o faBlue" aria-hidden="true"></i></li>
								</ul>
							</div>
						</td>
					</tr>
				</table>
			</div>
				<div class = "vk grayDivs">
					<table class= "table tSocialNetworks">
						<tr>
							<td><a href="http://vk.com/eliteltc" class = "socialNetworkA" title = "http://vk.com/eliteltc"><div class="socialN" id = "Vk2"></div></a></td>
							<td><a href="https://www.instagram.com/eliteltc/" class = "socialNetworkA" title = "https://www.instagram.com/eliteltc/"><div class="socialN" id = "Tv2"></div></a></td>
							<!-- <td><a href="" class = "socialNetworkA" title = ""><div class="socialN" id = "gmail2"></div></a></td> -->
						</tr>
					</table>
				</div>
				<div class = "needToWork whiteDivs">
					<p class = "aboutMeP">Что нужно для начала занятий</p>
					<p class = "needThing"><i>Для начала занятий вам понадобится следующий минимальный набор</i></p>
					<table class= "table">
						<tr>
							<td><div class="tex" id = "me"></div></td>
							<td><div class="tex" id = "method"></div></td>
							<td><div class="tex" id = "copybook"></div></td>
							<td><div class="tex" id = "time"></div></td>
							<td><div class="tex" id = "wish"></div></td>
						</tr>
						<tr>
							<td><p class = "p"><i>мы</i></p></td>
							<td><p class = "p"><i><br>эффективная<br>методика</i></p></td>
							<td><p class = "p"><i><br>тетрадь<br>с ручкой</i></p></td>
							<td><p class = "p"><i>время</i></p></td>
							<td><p class = "p"><i>желание</i></p></td>
						</tr>
					</table>
				</div>
				<!-- <div class="grayDivs">
					<p class = "aboutMeP">Стоймость занятий</p>
					<table class="tPrice">
						<tr>
							<td class = "tdFirst"><p class="head">15 минут</p></td>
							<td class = "tdFirst"><p class="head">30 минут</p></td>
							<td class = "tdFirst"><p class="head">45 минут</p></td>
							<td class = "tdFirst"><p class="head">60 минут</p></td>
							<td class = "tdFirst"><p class="head">90 минут</p></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</table>
				</div> -->
			
				<div class="reviews grayDivs">
					<p class = "aboutMeP">Отзывы наших учеников</p>
					<div class = 'recalls'>
						<div class = 'showRecalls'>
							<div class = "recall recallRight">
								<article class="message recallText">
									Хотела подучить английский, порекомендовали школу английского языка <b>ELITE LANGUAGE AND TRAINING CENTER</b>. Прошла тест, что бы узнать свой уровень. Потом записалась на обучение. Программа хорошо составлена, очень все понятно. Буду всем рекомендовать
								</article>
								<p class="nameRecall nameRecallRight">~Мария~</p>
							</div>
							<div class = "recall recallLeft">
								<article class="message recallText">
									Хочу оставить свой отзыв о курсах Английского языка в г. Астане. Понравилось ,что упор идет в основном на практику ; понимание и говорение , т.к со школы именно с этим проблемы остались .Рекомендую <b>ELITE LANGUAGE AND TRAINING CENTER</b> и отдельное спасибо преподавателю ))!!!
								</article>
								<p class="nameRecall nameRecallLeft">~Мирас~</p>
							</div>
						</div>
						<div class="hideRecalls">
							<div class = "recall recallRight">
								<article class="message recallText">
									Довольна тем что попала на <b>ELITE LANGUAGE AND TRAINING CENTER.</b> Центр очень помогает людям изучить то,что они не успели или не смогли ,курсы не дорогие все могут себе позволить.
								</article>
								<p class="nameRecall nameRecallRight">~Балжан~</p>
							</div>
							<div class = "recall recallLeft">
								<article class="message recallText">
									Изучаю для себя английский язык в <b>ELITE LANGUAGE AND TRAINING CENTER</b> хочу еще дальше его изучать очень хорошо объясняют рассказывают. приятно посещать такие занятия
								</article>
								<p class="nameRecall nameRecallLeft">~Думан~</p>
							</div>
							<div class = "recall recallRight">
								<article class="message recallText">
									Это был мой первый опыт обучения в школе китайского языка <b>ELITE LANGUAGE AND TRAINING CENTER</b>, и он, безусловно, оказался удачным. За время курса я получила большое количество знаний. Преподаватель всё объясняла доходчиво и отвечала на любые, даже самые глупые вопросы. Все занятия проходили в приятной обстановке. Лично я ничего плохого не могу сказать об этих курсах. Мне все понравилось, могу порекомендовать
								</article>
								<p class="nameRecall nameRecallRight">~Алиден~</p>
							</div>
						</div>
					</div>
					<p class="openAllRecalls">Посмотреть все отзывы</p>
				</div>
			</div>
				<div class="whiteDivs Contacts">
					<p class = "aboutMeP">Контакты</p>
					<ul>
						<table class="tPrice tIcons">
							<tr>
								<td rowspan="2" class = "tdIcons">
									<center><p class = 'mobilePhone'><i class="fa fa-mobile" aria-hidden="true"></i><p></center>
								</td>
								<td class = "tdInfoTel">+7 (7172) 25 22 03</td>
								<td rowspan="2" class = "tdIcons">
									<center><p class = 'mobilePhone'><i class="fa fa-map" aria-hidden="true"></i><p></center>
								</td>
								<td class = "tdInfoAddress">г. Астана, ул. Кенесары, д. 52, Эдем Палас 2</td>
								<td rowspan="2" class = "tdIcons">
									<center><p class = 'mobilePhone'><i class="fa fa-envelope" aria-hidden="true"></i><p></center>
								</td>
								<td class = "tdInfo" rowspan="2">elitecenterastana@gmail.com</td>
							</tr>

							<tr>
								<td class = "tdInfoTel">+7 (708) 425 22 03</td>
								<td class = "tdInfoAddress">(вход со стороны Валиханова), ВП 10 (2 этаж)</td>
							</tr>
						</table>

					</ul>
					<div class="map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3538.1009623663554!2d71.44129752396597!3d51.167196590738065!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc020fd9c855b0729!2z0K3QtNC10Lwg0L_QsNC70LDRgSAy!5e0!3m2!1sru!2skz!4v1470755134551" width="80%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
				<style>
				</style>
				

			<footer>
					<p class = "aboutMeP white footerP">Советы преподавателя</p>
			</footer>
		</div>
	</div>
</body>
</html>