<?
	session_start();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Жеке кабинет</title>
	<script type="text/javascript" src="../js/loader.js"></script>
	<link rel="shortcut icon" href="../img/125.jpg" type="image/jpg">
	<script src = "../js/jquery-1.12.1.min.js"></script>
	<script src = "../js/profile.js"></script>
    <link href="../css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../font-awesome-4.6.3/css/font-awesome.min.css">
	<script src="../Bootstrap3/js/bootstrap.js"></script>
	<link href="../Bootstrap3/css/bootstrap.css" rel="stylesheet">
</head>
<?
	include("functions.php");
	include("db.php");
	isLogin();
	profile3();
?>
<body>
<div class = "errors">
	<div class = "right1">
		<p id = "exit">&#215;</p>
	</div>
	<div class = "left1">
		<span class = "span1"></span>
	</div>
</div>
<div class="containerMainNav">
	<div class="container">
		<div class="rows">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-mine-nav">
				<img src="../img/125.jpg" height="auto" width="100" alt="" id = "logo">
				<p class="user-name"><?=$_SESSION["name"]?></p>
				<div class = "register1">
			<a href = "index.php" class = "a" id = "login">Бастысы</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="contaner">
	<style>
		
		.buttonSave{
			display: inline-block;
			margin: 0 0;
			margin-left: 0;
			height: 30px;
			line-height: 30px;
		}
		.input2{
			display: inline-block;
			margin: 0 0;
			margin-left: 30px;
		}
		.select{

			/*margin-left: 30px;*/
		}
		.DeleteTable{
			width: 260px;
		}
	</style>
<script>
$(document).ready(function(){
	// open More info And Edit Info
		$(".blockLeft").delegate(".More", "click", function(){
			$(this).prev().slideToggle(500);
		});
		$(".blockLeft").delegate(".EDIT", "click", function(){
			$(this).prev().slideToggle(500);
		});
});
</script>
	<div class = "middle">
		<div class = "blockRight">
				<p class = "p Open2 workWithCurator"><i class="fa fa-users" aria-hidden="true"></i> Топтар <span class = "open" id = "1">&#9658</span></p>
					<div class = "Hide">
					<!-- Тобы бар оқушылар -->
					<?
						$result = $mysqli->query("SELECT * FROM `curator` WHERE `status` = '1'");
						while(($row = $result->fetch_assoc()) != false){
							$group = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$row["id"]."' ORDER BY `name` ASC");
							$group2 = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$row["id"]."' ORDER BY `name` ASC")->fetch_assoc();
							if($group2 != false){
								echo '<p class = "p Open CURATOR curatorG" id = "'.$row['id'].'">'.$row["name"].'<span class = "open" id = "1">&#9658</span></p><div class = "Hide">';
								while(($g = $group->fetch_assoc()) != false){
									$r = $mysqli->query("SELECT `id`, `name`, `userId` FROM `users` WHERE `group` = '".$g['id']."' AND `status` = '0' AND `who` = '1'");
									$num = $r->num_rows;
									echo '<p class = "p p1 groupsG" id = "'.$g['id'].'">'.$g['name'] . " тобы - ".$num.' оқушы <span class = "open" id = "1">&#9658</span></p>';
									// if($num != 0){
										echo '<div class = "pupils">
												<table>
													<tr>
														<th class = "Number td">№</th>
														<th class = "Name td">Аты-жөні</th>
														<th class = "Id td">ID</th>
													</tr>';
										$i = 1;
										while(($row2 = $r->fetch_assoc()) != false){
											echo '<tr>
													<td class = "Number">'.$i.'</td>
													<td class = "Name"><a class = "userName" id = "id'.$row2['id'].'">'.$row2['name'].'</a></td>
													<td class = "Id">'.$row2['userId'].'</td>
													
												</tr>';
											$i++;
										}
										echo '</table>
									</div>';
								}
								echo "</div>";
							}
						}
					?>
				</div>

			<style>
				.fa-cog{
					/*font-size: 20px;*/
					color: #fff;
				}
				.fa-cog:hover{
					cursor: pointer;
					transition:1s;
				}
			</style>
			<p class = "p workWithCurator OpenListOfCuratorsP"><i class="fa fa-street-view" aria-hidden="true"></i> Кураторлар</p>
			<p class = "p workWithCurator OpenListOfAssistantsP"><i class="fa fa-street-view" aria-hidden="true"></i> Ассистенттер</p>
			<p class = "p workWithCurator Open2"><i class="fa fa-street-view" aria-hidden="true"></i> Мұғалімдер <span class = "open" id = "1">&#9658</span></p>
				<div class = 'Hide'>
					<p class = "p NAME OpenListOfTeachersP">Жұмыс жасап жатқан</p>
					<p class = "p NAME OpenListOfTeachersGoneP">Жұмыстан шыққан</p>
				</div>

			<p class = "p workWithCurator Open2"><i class="fa fa-street-view" aria-hidden="true"></i> Оқушылар <span class = "open" id = "1">&#9658</span></p>
				<div class = 'Hide'>
					<p class = "p OpenListOfPupilsP"><i class="fa fa-user" aria-hidden="true"></i> Оқушылар</p>
					<p class = "p OpenListOfPupilsP2"><i class="fa fa-user" aria-hidden="true"></i> Кеткен оқушылар</p>
				</div>
			<p class = "p workWithCurator Open2"><i class="fa fa-book" aria-hidden="true"></i> Тест нәтижиелері <span class = "open" id = "1">&#9658</span></p>
				<div class = "Hide">
					<?
						$result = $mysqli->query("SELECT * FROM `curator` WHERE `status` = '1'");
						while(($row = $result->fetch_assoc()) != false){
							$group = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$row["id"]."' ORDER BY `name` ASC");
							$group2 = $mysqli->query("SELECT * FROM `groups` WHERE `curatorId` = '".$row["id"]."' ORDER BY `name` ASC")->fetch_assoc();
							if($group2 != false){
								echo '<p class = "p Open CURATOR">'.$row["name"].'<span class = "open" id = "1">&#9658</span></p><div class = "Hide">';
								while(($g = $group->fetch_assoc()) != false){
									$r = $mysqli->query("SELECT `id`, `name`, `userId` FROM `users` WHERE `group` = '".$g['id']."' AND `status` = '0' AND `who` = '1'");
									$num = $r->num_rows;
									echo '<p class = "p toPageP getAllForN NAME" id = "'.$g['id'].'">'.$g['name'] .' тобы</p>';
									
								}
								echo "</div>";
							}
						}
					?>
				</div>
			<p class = "p workWithCurator wasLatePupilsP"><i class="fa fa-user" aria-hidden="true"></i> Келмеген оқушылар</p>
			<p class = "p workWithCurator SearchAllMoneyP"><i class="fa fa-money" aria-hidden="true"></i> Төлемдер жайлы мәлімет алу</p>
			<p class = "p workWithCurator changePasswordP"><i class="fa fa-exchange" aria-hidden="true"></i> Пороль өзгерту</p>
		</div>
		<!-- Profile ___________________________________________________________________________________________ -->
			<style>
				/*.minLeft{width: 30%;}*/
			</style>
			<div class = "blockLeft blockLeft2">
				<div class = "minLeft">
					<img src="" height="320" width="250" alt="" id = "UserAvatar">
				</div>
				<div class = "minRight">
					<p class = "p NAME USERNAME"></p>
					<table class="t2 t22 MainInfoAboutUser">
					</table>
					<div class = "moreInfo">
						<table class="t2 t22 ExtraInfoAboutUser">
						</table>
					</div>
					<p class = "More OpenEditAndMore">Толық мәлімет<span class = "open s1" id = "1">&#9658</span></p>

					<div class = "moreInfo men">
						<table class="t2 t22 EditInfoUser">
						</table>
						<form action = "" method = "post" enctype =  'multipart/form-data'>
							<label for="loadAvatar" id = "labelLoad">Сурет қою.</label>
							<input type="file" id = "loadAvatar" name = "avatar">
							<input type="submit" name = "sendAvatar" class = "button buttonLoadAvatar" value = "Сақтау.">
							<span class = "error"><?=$_SESSION["error"]?></span>
						</form>
					</div>
						<p class = "EDIT OpenEditAndMore">Редактировать<span class = "open s1" id = "1">&#9658</span></p>
						<div class = "chart_div" id="chart_div"></div>
				</div>
			</div>
		<!-- Барлық бағалар___________________________________________________________________________________________ -->
		<style>
			.Error{
				font-size: 14px;
				margin: 5px;
				display: none;
			}
		</style>
		<div class = "blockLeft">
		<div class="Hide Close changePasswordDiv">
			<form class="form-inline">
				<input type="password" class = "form-control form-changePass" placeholder = "Старый пароль" id = "oldPass">  <span class="text-danger info info1">Lorem ipsum dolor sit.</span> <br><br>
				<input type="password" class = "form-control form-changePass" placeholder = "Новый пароль" id = "newPass"><br><br>
				<input type="password" class = "form-control form-changePass" placeholder = "Повторите пароль" id = "repeatPass">  <span class="text-danger info info2"></span><br><br>
				<button type="button" class = "btn btn-primary form-changePass" id = "changePassword">Изменить</button>
			</form>
		</div>
			<!-- Төлемдер жайлы мәлімет алу -->
				<div class="Hide SearchAllMoneyDiv Close">
					<p class="p">Төлемдер жайлы мәлімет алу</p>
					<form class="form-inline">
						<select name="" class = "form-control" id="monthsSearchExtra">
							<?
								$result = $mysqli->query("SELECT * FROM `months` WHERE `status` = '1'");
								while(($row = $result->fetch_assoc()) != false){
									echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
								}
							?>
						</select>
						<select name="" class = "form-control" id="daySearchExtra">
							<?
								for($i = 1; $i < 32; $i++){
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
							?>
						</select>
						<button type="button" class="btn btn-primary" id = "buttonSearchExtra">Поиск</button>
					</form>
						<div class="Hide searchResult">
							<p class="p searchMoneyName"></p>
							<table class="t2 todeysMoney searchMoney"></table>
						</div>
				</div>

			<!-- Келмеген оқушылар -->
				<div class = "Hide Close wasLatePupilsDiv">
					<?
						$text = $_POST['text'];
						$day = (int)date("d");
						$month = (int)date("m");
						$year = (int)date("Y");
						$result = $mysqli->query("SELECT `id`, `name`,`causeText` FROM `users` WHERE `waslate` = '".$day."' AND `status` = '0' AND `who` = '1'");
						$c = 1;
						$num = $result->num_rows;
						echo '<p class="p">Келмеген оқушылар - '.$num.'</p>';
					?>
					<table class="t2">
						<?
						if($num > 0){
							echo ('<tr class="tr2"><th class="th2 th2f">№</th>
									<th class="th2 nameB">Аты-жөні</th>
									<th class="th2">Келмеу себебі</th>
									<th class="th2">Күні</th></tr>');
							while(($row1 = $result->fetch_assoc()) != false){
								$id = $row1['id'];
								$name = $row1['name'];
								$causeText = $row1['causeText'];
								$m = array($id ,$name ,$causeText);
								$id = $m[0];
								$name = $m[1];
								$text = explode(":", $m[2]);
								
								$td = "";
								$num2 = count($text);
								for($i = 0; $i < $num2; $i++){
									$row = explode(";", $text[$i]);
									$date =  explode("-", $row[0]);
									$day2 = (int)$date[0];
									$month2 = (int)$date[1];
									$year2 = (int)$date[2];
									if($day2 == $day && $month2 == $month && $year2 == $year){
										if($c == $num) $td = "td2l";
										echo ('<tr class="tr2"><td class="td2 td2f '.$td.'">'.$c.'</td>
											<td class="td2 tdName '.$td.'"><p class = "NameTeacher" id = "'.$id.'">'.$name.'</p></td>
											<td class="td2 '.$td.'"><p>'.$row[1].'</p></td><td class="td2 '.$td.'"><p>'.$row[0].'</p></td>
											</tr>');
									}
								}
								$c++;
							}
						}
						?>
					</table>
				</div>
			<!-- Тест нәтижиелері -->
				<div class = 'workWithCuratorDiv2'></div>
			<!--  Топ жайлы статистика -->
				<div class = "Hide Close" id = "groupsG">
					<p class = "p" id = "groupsGText"></p>
					<div class = "groupMinDivLeft">
						<div class = "chart_div" id="chart_div2"></div>
					</div>
					<div class = "groupMinDivRight">
							<table class="t2 t22 groupsGTable">
								
							</table>
					</div>
				</div>
			<!--  куратор жайлы статистика -->
				<div class = "Hide Close" id = "curatorG">
					<p class = "p" id = "curatorGText"></p>
					<div class = "curatorMinDivLeft">
						<div class = "chart_div" id="chart_div_curator"></div>
					</div>
					<div class = "curatorMinDivRight">
						<table class="t2 t22 curatorGTable">
							
						</table>
					</div>
				</div>
			<!-- Кураторлар тізімі -->
				<?
					$result = $mysqli->query("SELECT * FROM `curator` WHERE `status` = '1'");
					$num = $result->num_rows;
				?>
				
					<div class = "Hide Close OpenListOfCuratorsDiv">
						<p class = "p" >Кураторлар тізімі - <?=$num?></p>
						<table class="t2">
							<tr class="tr2">
								<th class="th2 th2f">№</th>
								<th class="th2 nameMF">Аты-жөні</th>
								<th class="th2">Топтары</th>
								<th class="th2">Ата-ана нөмері</th>
							</tr>
							
							<?
								$td = "";
								$i = 1;
								while(($row = $result->fetch_assoc()) != false){
									if($i== $num) $td = "td2l";
									$nameG = $mysqli->query("SELECT `name` FROM `groups`  WHERE `curatorId` = '".$row["id"]."'");
									$numG = $nameG->num_rows;
									$s = "";
									$c = ", ";
									$j = 1;
									while(($r = $nameG->fetch_assoc()) != false){
										if($j == $numG) $c = "";
										$s = $s . $r["name"] . $c;
										$j++;
									}
									$class = "";
									if($i % 2 == 1) $class = "second";
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td. " " .$class.'">
												'.$i.'
											</td>
											<td class="td2 '.$td. " " .$class.'">
												<p id = "nameCurator'.$row["id"].'">'.$row['name'].'</p>
											</td>
											<td class="td2 '.$td. " " .$class.'">
												'.$s.'
											</td>
											<td class="td2 tdNum '.$td. " " .$class.'" >
												<p class = "telCurator" id = "'.'telWritten'.$row["id"].'">
													'.$row["tel1"]."<br>".$row["tel2"].'
												</p>
											</td>
										</tr>';
									$i++;
								}
							?>
						</table>
					</div>	
			<!-- Ассистенттер тізімі -->
				<?
					$result = $mysqli->query("SELECT * FROM `assistants` WHERE `status` = '1'");
					$num = $result->num_rows;
				?>
			
					<div class = "Hide Close OpenListOfAssistantsDiv">
						<p class = "p">Ассистенттер тізімі - <?=$num?></p>
						<table class="t2">
							<tr class="tr2">
								<th class="th2 th2f">№</th>
								<th class="th2">Аты-жөні</th>
								<th class="th2">Кураторы</th>
							</tr>
							
							<?
								$td = "";
								$i = 1;
								while(($row = $result->fetch_assoc()) != false){
									if($i == $num) $td = "td2l";
									$class = "";
									if($i % 2 == 1) $class = "second";
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td. " " .$class.'">
												'.$i.'
											</td>
											<td class="td2 '.$td. " " .$class.'">
												<p id = "nameAssistant'.$row["id"].'">'.$row['name'].'</p>
											</td>
											<td class="td2 '.$td. " " .$class.'">
												<p class = "status" id = "assistantWritten'.$row["id"].'">'.$row['curator'].'</p>
											</td>
										</tr>';
									$i++;
								}
							?>
						</table>
					</div>
			<!-- Мұғалімдер тізімі -->
				<?
					$result = $mysqli->query("SELECT * FROM `teacher` WHERE `type` = '1' ORDER BY `subject` ASC");
					$num = $result->num_rows;
				?>
					<div class = "Hide Close OpenListOfTeachersDiv">
						<p class = "p">Жұмыс жасап жатқан мұғалімдер тізімі - <?=$num?></p>
						<table class="t2">
							<tr class="tr2">
								<th class="th2 td2f">№</th>
								<th class="th2">Аты-жөні</th>
								<th class="th2">Пәні</th>
								<th class="th2">Телефон</th>
								<th class="th2">Статусы</th>
							</tr>
							<?
								$td = "";
								$i = 1;
								//  
								while(($row = $result->fetch_assoc()) != false){
									if($i == $num) $td = "td2l";
									$class = "";
									if($i % 2 == 1) $class = "second";
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td. " " .$class.'">
												'.$i.'
											</td>
											<td class="td2 tdn '.$td. " " .$class.'" >
												<p class = "NameTeacher tdName" id = "'.'NameTeacher'.$row["id"].'">'.$row['name'].'</p>
											</td>
											<td class="td2 tds '.$td. " " .$class.'">
												<p>'.$row['subject'].'</p>
											</td>
											<td class="td2 tdt '.$td. " " .$class.'">
												<p class = "status" id = "telWrittenT'.$row["id"].'">'.$row['tel'].'</p>
											</td>
											<td class="td2 '.$td. " " .$class.'">
												<p class = "status" id = "statusWrittenT'.$row["id"].'">'.$row['status'].'</p>
											</td>
										</tr>';
										$i++;
								}
							?>
						</table>
					</div>
			<!-- Кеткен мұғалімдер -->
				<?
					$result = $mysqli->query("SELECT * FROM `teacher` WHERE `type` = '2' ORDER BY `subject` ASC");
					$num = $result->num_rows;
				?>
					<div class = "Hide Close OpenListOfTeachersGoneDiv">
						<p class = "p">Жұмыстан шыққан мұғалімдер тізімі - <?=$num?></p>
						<table class="t2">
							<tr class="tr2">
								<th class="th2 td2f">№</th>
								<th class="th2">Аты-жөні</th>
								<th class="th2">Пәні</th>
								<th class="th2">Телефон</th>
								<th class="th2">Келген күні</th>
								<th class="th2">Кеткен күні</th>
							</tr>
							<?
								$td = "";
								$i = 1;
								//  
								while(($row = $result->fetch_assoc()) != false){
									if($i == $num) $td = "td2l";
									$m = split(" ", $row['dateout']);
									$n = split(" ", $row['date']);
									$class = "";
									if($i % 2 == 1) $class = "second";
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td.'">
												'.$i.'
											</td>
											<td class="td2 tdn '.$td. " " .$class.'" >
												<p class = "NameTeacher tdName" id = "'.'NameTeacher'.$row["id"].'">'.$row['name'].'</p>
											</td>
											<td class="td2 tds '.$td. " " .$class.'">
												<p>'.$row['subject'].'</p>
											</td>
											<td class="td2 tdt '.$td. " " .$class.'">
												<p class = "status" id = "telWrittenT'.$row["id"].'">'.$row['tel'].'</p>
											</td>
											<td class="td2 '.$td. " " .$class.'">
												<p class = "status">'.$n[0].'</p>
											</td>
											<td class="td2 '.$td. " " .$class.'">
												<p class = "status">'.$m[0].'</p>
											</td>
										</tr>';
										$i++;
								}
							?>
						</table>
					</div>
			<!-- Оқушылар тізімі -->
				<?
					$result = $mysqli->query("SELECT * FROM `users` WHERE `who` = '1' AND `status` = '0' ORDER BY `name` ASC");
					$num = $result->num_rows;
				?>
					<div class = "Hide Close OpenListOfPupilsDiv">
					<p class = "p">Оқушылар тізімі - <?=$num?></p>
					<form  class="form-inline">
						<input type="search" id = "search" class = "form-control form-search" placeholder = "Поиск*">
					</form>
					<div class = "found">
						<span class = "error error2"></span>
						<table class="t2" id = "found">
							
						</table>
					</div>
						<table class="t2">
							<tr class="tr2">
								<th class="th2 th2f">№</th>
								<th class="th2 nameB">Аты-жөні</th>
								<th class="th2">Таңдау-пәні</th>
								<th class="th2">Телефон</th>
								<th class="th2">ID</th>
							</tr>
							
							<?
								$td = "";
								$i = 1;
								while(($row = $result->fetch_assoc()) != false){
									if($i == $num) $td = "td2l";
									$subjectName = $mysqli->query("SELECT `name` FROM `subjects` WHERE `id` = '".$row['subject']."'")->fetch_assoc();
									$class = "";
									if($i % 2 == 1) $class = "second";
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td. " " .$class.'">
												'.$i.'
											</td>
											<td class="td2 '.$td. " " .$class.' tdName">
												<p class = "userName3" id = "'.$row['id'].'">'.$row['name'].'</p>
											</td>
											<td class="td2 '.$td. " " .$class.'" id = "sub'.$row['id'].'">
												<p>'.$subjectName["name"].'</p>
											</td>
											<td class="td2 '.$td. " " .$class.'">
												<p>'.$row['tel'].'</p>
											</td>
											<td class="td2 '.$td. " " .$class.'">
												<p>'.$row['userId'].'</p>
											</td>
										</tr>';
									$i++;
								}
							?>
						</table>
					</div>
			<!-- Кеткен оқушылар тізімі -->
				<?
					$result = $mysqli->query("SELECT * FROM `users` WHERE `status` = '2' ORDER BY `name` ASC");
					$num = $result->num_rows;
				?>
				
					<div class = "Hide Close OpenListOfPupilsDiv2">
						<p class = "p">Кеткен оқушылар тізімі - <?=$num?></p>
						<table class="t2">
							<tr class="tr2">
								<th class="th2 th2f">№</th>
								<th class="th2 nameB">Аты-жөні</th>
								<th class="th2">Таңдау-пәні</th>
								<th class="th2">Телефон</th>
								<th class="th2">Кеткен күні</th>
							</tr>
							

							<?
								$td = "";
								$i = 1;
								while(($row = $result->fetch_assoc()) != false){
									if($i == $num) $td = "td2l";
									$m = split(" ", $row['dateout']);
									$subjectName = $mysqli->query("SELECT `name` FROM `subjects` WHERE `id` = '".$row['subject']."'")->fetch_assoc();
									$class = "";
									if($i % 2 == 1) $class = "second";
									echo '<tr class="tr2">
											<td class="td2 td2f '.$td. " " .$class.'">
												'.$i.'
											</td>
											<td class="td2 '.$td. " " .$class.'">
												<p class = "userName3" id = "'.$row['id'].'">'.$row['name'].'</p>
											</td>
											<td class="td2 '.$td. " " .$class.'">
												<p>'.$subjectName["name"].'</p>
											</td>
											<td class="td2 '.$td. " " .$class.'">
												<p>'.$row['tel'].'</p>
											</td>
											<td class="td2 '.$td. " " .$class.'">
												<p>'.$m[0].'</p>
											</td>
										</tr>';
									$i++;
								}
								$mysqli->close();
							?>
						</table>
					</div>
		</div>
	</div>
</div>
</body>
</html>
	   

