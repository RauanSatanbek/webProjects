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
	profile6();
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
				<p class="user-name"><?=$_SESSION["name"]?> | <a href = "http://info.srba.ru/page/profile6.php" class = "a" id = "login" target = "_blank">Қолдану жайында мәлімет алу</a></p>
					<div class = "register1">
			<a href = "index.php" class = "a" id = "login">Бастысы</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="contaner">
	<div class = "middle middle2">
	<style>
		.s1{color: #fff;}
		.middle2{
			width: 100%;
			margin: 0;
		}
		.blockLeft{
			width: 76.1%;
			float: right;
		}
		.blockRight4{width: 22%;}
		.error4, .error5, .setMoneyGetId{display: none;}
		.discount{color:green;}
		.discount:hover{cursor: pointer;}
		.Number{
			border-left:1px solid silver;
		}
	</style>
	<script>
		$(document).ready(function(){
			
		});
	</script>
		<div class = "blockRight blockRight4">
			<?
				$result = $mysqli->query("SELECT `id`, `name`, `userId` FROM `users` WHERE `status` = '0' AND `joinToGroup` = '1'");
				if($result->num_rows != 0){
					echo '<p class = "p Open2 workWithCurator"><i class="fa fa-user" aria-hidden="true"></i> Топқа кірген - '.$result->num_rows.' оқушы <span class = "open" id = "1">&#9658</span></p>';
					$i = 1;
					echo '<div class = "pupils">
								<table>
									<tr>
										<th class = "Number td">№</th>
										<th class = "Name td">Аты-жөні</th>
										<!--<th class = "Id td">ID</th>-->
										<th class = "Id td Checkbox"></th>
									</tr>';
					while(($row2 = $result->fetch_assoc()) != false){
							$class = "";
							if($i % 2 == 1) $class = "second";
							echo '<tr>
									<td class = "Number '. $class.'">'.$i.'</td>
									<td class = "Name '. $class.'"><a class = "userName2" id = "id'.$row2['id'].'">'.$row2['name'].'</a></td>
									<!--<td class = "Id '. $class.'">'.$row2['userId'].'</td>-->
									<td class = "Id Checkbox '. $class.'"><p class = "discount" id = "'.$row2['id'].'"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></p></td>
								</tr>';
						$i++;
					}
						echo '</table>
							</div>';
				}
			?>
			<p class = "p workWithCurator AciveMonthP"><i class="fa fa-plug" aria-hidden="true"></i> Келесі айды іске қосу</p>
			<p class = "p workWithCurator getInfoAboutUserP2"><i class="fa fa-clock-o" aria-hidden="true"></i> Келмеген оқушылар</p>
			<p class = "p workWithCurator getInfoAboutUserP3"><i class="fa fa-money" aria-hidden="true"></i> Төлем жасау</p>
			<p class = "p workWithCurator SearchAllMoneyP"><i class="fa fa-money" aria-hidden="true"></i> Төлемдер жайлы мәлімет алу</p>
			<p class = "p workWithCurator extraGainP"><i class="fa fa-plus-square" aria-hidden="true"></i> Доп. доход</p>
			<p class = "p workWithCurator consumptionP"><i class="fa fa-minus-square" aria-hidden="true"></i> Расход</p>
			<p class = "p Open2 workWithCurator"><i class="fa fa-eye" aria-hidden="true"></i> Айлар тізімі<span class = "open" id = "1">&#9658</span></p>
			<div class = "Hide">
				<?
					$months = $mysqli->query("SELECT * FROM `months` WHERE `status` = '1'");
					while(($row = $months->fetch_assoc()) != false){
						echo '<p class = "p monthP" id = "'.$row["id"].'">'.$row["name"].'</p>';
					}
				?>
			</div>
			<p class = "p workWithCurator changePasswordP"><i class="fa fa-exchange" aria-hidden="true"></i> Пороль өзгерту</p>
		</div>
		
		<div class = "blockLeft blockLeft4">
		<div class="Hide Close changePasswordDiv">
			<form class="form-inline">
				<input type="password" class = "form-control form-changePass" placeholder = "Старый пароль" id = "oldPass">  <span class="text-danger info info1">Lorem ipsum dolor sit.</span> <br><br>
				<input type="password" class = "form-control form-changePass" placeholder = "Новый пароль" id = "newPass"><br><br>
				<input type="password" class = "form-control form-changePass" placeholder = "Повторите пароль" id = "repeatPass">  <span class="text-danger info info2"></span><br><br>
				<button type="button" class = "btn btn-primary form-changePass" id = "changePassword">Изменить</button>
			</form>
		</div>
			<!-- Төлейтін ақшаны қою -->
				<div class = "Hide setMoneyDiv Close">
					<p class = "p Open">1 айға төленетін ақшаны енгізу</p>
					<table class="t2 tOb setMoneyTable"></table>
					<form class = "form-inline" >
						<p class = "setMoneyGetId"></p>
						<input type="text" id = "setMoneyInput" class = "form-control" placeholder = "негізгі сумма">
						<input type="text" id = "setMoneyInput2" class = "form-control" placeholder = "төлеу керек">
						<input type="button" value = "Енгізу" class ="btn btn-primary"  id = "setMoneyButton">
					</form>
				</div>
			<!-- Доп доход -->
				<div class = "Hide extraGainDiv Close">
					<p class = "p Open">Дополнительный доход</p>
					<form class = "form-inline" >
						<input type="text" id = "extragainInput" class = "form-control" placeholder = "Сумма">
						<input type="text" id = "extragainText" class = "form-control" placeholder = "Себебі">
						<input type="button" value = "Оплатить" class ="btn btn-primary"  id = "extragainButton">
					</form>
					<p class="p">Бүгінгі доход</p>
					<table class="t2 todeysMoney">
						<?
							$months = $mysqli->query("SELECT * FROM `months` WHERE `active` = '1'");
							$i = 1;
							while(($row = $months->fetch_assoc()) != false){
								$day = (int)date("d");
								$month = (int)date("m");
								$year = (int)date("Y");
								$extraMoney = explode(":", $row["extraMoney"]);
								$plus = $extraMoney[0];
								$minus = $extraMoney[1];
								$plus = explode(")", $plus);
								$td = "";
								for($i = 0; $i < count($plus); $i++){
									$massive = explode("(", $plus[$i]);
									$date = explode(".", $massive[1]);
									$day2 = (int)$date[0];
									$month2 = (int)$date[1];
									$year2 = (int)$date[2];
									if($day2 == $day && $month2 == $month && $year2 == $year){
										echo '<tr class="tr2"><th class="th2 th2f">№</th>
												<th class="th2 tdSumma">Сума</th>
											<th class="th2 thCouse">Себеп</th></tr>';
										$money = 0;
										$money1 = explode(";", $massive[0]);
										for($j = 0; $j < count($money1); $j++){
											$money2 = explode("|", $money1[$j]);
											if(count($money1) == $j + 1) $td = "td2l";
											echo ('<tr class="tr2"><td class="td2 td2f '.$td.'">'.($j + 1).'</td>
											<td class="td2 '.$td.'"><p class = "NameTeacher" id = "'.$id.'">'.$money2[0].' тг</p></td>
											<td class="td2 '.$td.'"><p>'.$money2[1].'</p></td>
											</tr>');
										}
										break;
									} else if ($i + 1 == count($plus)) echo '<span class="error">Тікелмеген</span>';
								}
							}
						?>
					</table>

					<script>
						$(document).ready(function(){
							
						});
					</script>
					
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
			<!-- расход -->
				<div class = "Hide consumptionDiv Close">
					<p class = "p Open">Расход</p>
					<form class = "form-inline">
						<input type="text" id = "consumptionInput" class = "form-control" placeholder = "Сумма">
						<input type="text" id = "consumptionText" class = "form-control" placeholder = "Себебі">
						<input type="button" value = "Оплатить" class ="btn btn-primary"  id = "consumptionButton">
					</form>
					<p class="p">Бүгінгі расход</p>
					<table class="t2 todeysMoney">
						<?
							$months = $mysqli->query("SELECT * FROM `months` WHERE `active` = '1'");
							$i = 1;
							while(($row = $months->fetch_assoc()) != false){
								$day = (int)date("d");
								$month = (int)date("m");
								$year = (int)date("Y");
								$extraMoney = explode(":", $row["extraMoney"]);
								$minus = $extraMoney[1];
								$minus = explode(")", $minus);
								$td = "";
								for($i = 0; $i < count($minus); $i++){
									$massive = explode("(", $minus[$i]);
									$date = explode(".", $massive[1]);
									$day2 = (int)$date[0];
									$month2 = (int)$date[1];
									$year2 = (int)$date[2];
									if($day2 == $day && $month2 == $month && $year2 == $year){
									echo '<tr class="tr2"><th class="th2 th2f">№</th>
											<th class="th2 tdSumma">Сума</th>
											<th class="th2 thCouse">Себеп</th></tr>';
										$money = 0;
										$money1 = explode(";", $massive[0]);
										for($j = 0; $j < count($money1); $j++){
											$money2 = explode("|", $money1[$j]);
											if(count($money1) == $j + 1) $td = "td2l";
											echo ('<tr class="tr2"><td class="td2 td2f '.$td.'">'.($j + 1).'</td>
											<td class="td2 '.$td.'"><p class = "NameTeacher" id = "'.$id.'">'.$money2[0].' тг</p></td>
											<td class="td2 '.$td.'"><p>'.$money2[1].'</p></td>
											</tr>');
										}
										break;
									} else if($i + 1 == count($minus)) echo '<span class="error">Тікелмеген</span>';
								}
							}
						?>
					</table>
				</div>
			<!-- Оқушының кешіккен күндері жайлы ақпарат алу -->
				<div class = "Hide getInfoAboutUserDiv2 Close">
					<p class = "p"> Оқушының келмеген күндері жайлы ақпарат алу</p>
					<form class="inline">
						<input type="text" id = "search3" class = "form-control form-search" placeholder = "Поиск*">
						<i class="fa fa-search fa-search2" aria-hidden="true" title = "Найти"></i>
					</form>
					<div class = "found3">
						<span class = "error error4"></span>
						<p class="p blueP userNotCome"></p>
						<table class="t2" id = "found3"></table>
					</div>
				</div>
			<!-- Оқушылар жайлы мәлімет алу -->
				<div class="Hide getInfoAboutUserDiv3 Close">
					<p class = "p">Төлем жасау</p>
					<form class="inline">
						<input type="search" id = "search5" class = "form-control form-search" placeholder = "Поиск*">
					</form>
					<div class = "found5">
						<span class = "error error5"></span>
						<table class="t2" id = "found5"></table>
					</div>
					<div class = "Why  hide1">
						<p class="p PayUserName blueP"></p>
						<table class="t2 tOb tWhy"></table>
					</div>

				</div>
				<div class ="Hide makePay Close">
					<p class = "p Open">Оплата жасау</p>
					<form class = "form-inline">
						<input type="text" id = "moneyInput" class = "form-control" placeholder = "Ақша">
						<select name="" class = "form-control MonthsForPay" id="Month">
							<?
								$result = $mysqli->query("SELECT * FROM `months` WHERE `status` = '1'");
								while(($row = $result->fetch_assoc()) != false){
									echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
								}
							?>
						</select>
						<p class="getId"></p>
						<input type="button" value = "Төлеу" class ="btn btn-primary"  id = "willPayButton">
					</form>

					<p class = "p Open">30%</p>
					<form class = "form-inline">
						<input type="text" id = "moneyInput30" class = "form-control" placeholder = "Ақша">
						<select name="" class = "form-control" id="Month30">
							<?
								$result = $mysqli->query("SELECT * FROM `months`");
								while(($row = $result->fetch_assoc()) != false){
									echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
								}
							?>
						</select>
						<p class="getId30"></p>
						<input type="button" value = "Төлеу" class ="btn btn-primary"  id = "willPayButton30">
					</form>
					<p class = "setDiscountGetId"></p>
					<!-- <p class = "p Open">Скидка жасау</p>
					<table class="t2 tOb setDiscountTable"></table>
					<form class = "form-inline" >
						<input type="text" id = "setDiscountInput" class = "form-control" placeholder = "Сумма">
						<input type="button" value = "Сохранить" class ="btn btn-primary"  id = "setDiscountButton">
					</form> -->
				</div>
			<div class = "Hide AciveMonthDiv CloseAllDivs6 Close">
				<p class = "p">Келесі айды іске қосу.</p>
				<form class = "form-inline">
					<select name="" class = "form-control Months" id="Month">
						<?
							$result = $mysqli->query("SELECT * FROM `months` WHERE `status` = '0'");
							while(($row = $result->fetch_assoc()) != false){
								echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
							}
						?>
					</select>
					<input type="button" value = "Активировать" class ="btn btn-primary"  id = "ActiveMonth">
				</form>
			</div>
		</div>
		<!-- Барлық ай жайында мәлімет -->
		<div class = "blockLeft ChangeColorTd">
			<?
				$months = $mysqli->query("SELECT * FROM `months` WHERE `status` = '1'");
				$i = 1;
				while(($row = $months->fetch_assoc()) != false){
					echo '<div class = "Hide MonthDiv" id = "MonthDiv'.$row["id"].'">
							<div class = "hide1 MonthDivInner" id = "MonthDivInner">
						<div class = "p topicAndSearch" id = "topicAndSearch"><p class = "P1">'.$row["name"].' айы </p>
						<div id = "SEARCH"><input type="search" id = "search6" class = "input search" placeholder = "Поиск">
						<i class="fa fa-search search6I" aria-hidden="true"></i></div></div>
							<table class="t2 excel">';
					$day = $row["days"];
					$month = (int)$row["id"];
					$extraMoney = explode(":", $row["extraMoney"]);
					$plus = $extraMoney[0];
					$minus = $extraMoney[1];
					$totalGain = array();
					$Plus = array();
					$Minus = array();
					for($i = 0; $i < 0 + $day; $i++){
						$totalGain[$i] = 0;
						$Plus[$i] = 0;
						$Minus[$i] = 0;
					}
					if($plus != false){
						$plus = explode(")", $plus);
						for($i = 0; $i < count($plus); $i++){
							$massive = explode("(", $plus[$i]);
							$date = explode(".", $massive[1]);
							if($month == (int)$date[1]){
								$money = 0;
								$money1 = explode(";", $massive[0]);
								for($j = 0; $j < count($money1); $j++){
									$money2 = explode("|", $money1[$j]);
									$money += (int)$money2[0];
								}
								$Plus[(int)$date[0] - 1] = $money;
							}
						}
					}
					if($minus != false){
						$minus = explode(")", $minus);
						for($i = 0; $i < count($minus); $i++){
							$massive = explode("(", $minus[$i]);
							$date = explode(".", $massive[1]);
							if($month == (int)$date[1]){
								$money = 0;
								$money1 = explode(";", $massive[0]);
								for($j = 0; $j < count($money1); $j++){
									$money2 = explode("|", $money1[$j]);
									$money += (int)$money2[0];
								}
								$Minus[(int)$date[0] - 1] = $money;
							}
						}
					}
					echo '<tr class="tr2 tOb thAbc">
						<th class="th2 th2f nB">№</th>
						<th class="th2 nameB2" >Аты-жөні</th>
						<th class="th2 tDate" >Келген күні</th>
						<th class="th2 tDate" >Төлейтін к.</th>
						<th class="th2 tDate" >30%</th>
						<th class="th2 tDate" >Өткен ай</th>';
					$tdl = '';
					for($i = 0; $i < $day; $i++){
						echo '<th class="th2 Money">'.($i + 1).'</th>';
					}
					echo '<th class="th2 extraT">Негізгі с.</th>
						<th class="th2 extraT">Төлеу к.</th>
						<th class="th2 extraT">Төленді</th>
						<th class="th2 extraT">Қарызы</th></tr>';
					$g = "group";
					// $g = "style = 'background:red'";
						$result = $mysqli->query("SELECT * FROM `groups` ORDER BY `name` ASC");
						$j = 0;

						while(($row = $result->fetch_assoc()) != false){
							$c = $mysqli->query("SELECT `name` FROM `curator` WHERE `id` = '".$row["curatorId"]."'")->fetch_assoc();
							$r = $mysqli->query("SELECT * FROM `users` WHERE `group` = '".$row['id']."' AND `status` = '0' AND `joinToGroup` = '0' AND `who` = '1'");
							$u = $mysqli->query("SELECT `id`, `name`, `userId` FROM `users` WHERE `joinToGroup` = '0' AND `status` = '0' AND `who` = '1' AND `group` != '0'");
							$num = $u->num_rows;
							$i = 1;
							$datesP = array();
							$massive = array();
							echo '<tr class="tr2 '.$g.'">
									<td class="td2 groupNameTd"></td>
									<td class="td2 tdName groupNameTd">
										<p class = "money">'.$row["name"].' тобы</p>
									</td>';
							for($i = 0; $i < $day + 8; $i++){
								echo '<td class="td2 groupNameTd"></td>';
							}
							echo '</tr>';
							while(($row2 = $r->fetch_assoc()) != false){
								$pastMonth = 0;
								$paidMoney30 = 0;
								$money30 = array();
								$paid = $mysqli->query("SELECT `datesPaid` FROM `users` WHERE `id` = '".$row2["id"]."'")->fetch_assoc();
								if($paid['datesPaid'] != false) {
									$datesP = explode(")", $paid['datesPaid']);
									for($i = 0; $i < count($datesP); $i++){
										$data = explode("(", $datesP[$i]);
										$pastData = explode("(", $datesP[$i - 1]);
										if($pastData[1] != false){
											$pastData = explode(":",$pastData[1]);
											$pay = (int)$pastData[2];
											$paid = (int)$pastData[3];
											$pastMonth = $pay - $paid;
										}
										$Mday = explode(":", $data[1]);
										if($month == (int)$Mday[0]) {
											$datesPaid = explode("(",$datesP[$i]);
											$massive = $datesPaid[0];
											break;
										}
										else{
											$datesPaid[1] = "0:0:0:0";
										}
									}
								}
								else $datesP = array();
								$massive = explode(";",$massive);
								$p30 = explode(")",$row2["30"]);
								for($i = 0; $i < count($p30); $i++){
									$paidMonth =  explode("(",$p30[$i]);;
									$paidDate =explode(":",$paidMonth[1]);
									if($month == (int)$paidDate[0]){
										$index2 = $i;
										$money30[0] = $paidDate[2];
										$money30[1] = $paidDate[1];
										$money30[2] = $paidMonth[0];
									}
									// 
									if((int)$paidMonth[0] == (int)$month) $paidMoney30 = (int)$paidDate[2];

								}
								// print_r($money30);
								// echo  $paidMoney30 . "<br>";
								$toMonth = "";
								if($money30[0] != false) $toMonth = ' тг <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '. $money30[2];
								echo '<tr class="tr2 ChangeColor">
									<td class="td2 td2f '.$tdl.'" ><p class = "number'.($j + 1).' number2'.$row2["id"].' number12" id = "'.($j + 1).'">'.($j + 1).'</p></td>
									<td class="td2 '.$tdl.' tdName">
										<p class = "money NameTeacher">'.$row2["name"].'</p>
									</td>
									<td class="td2 '.$tdl.' money30PTd"><p>'.$row2["date"].'</p></td>
									<td class="td2 dayPay '.$tdl.'">
										<p class = "status '.$row2["id"].'" id = "'.'dayPayP'.$month.$row2["id"].'">'.$row2["dayPay"].'</p>
										<input type="text" class="write" id = "'.'dayPayInput'.$month.$row2["id"].'" >
									</td>
									<td class="td2 '.$tdl.' money30PTd"><p>'.$money30[0]. $toMonth .'</p></td>
									<td class="td2 '.$tdl.'"><p>'.$pastMonth.'</p></td>';
								for($i = 0; $i < $day; $i++){
									$money = "";
									$Day = 0;
									$data = "";
									if(count($datesP) > 0){
										$m = explode(":", $massive[0]);
										$Month = (int)$m[0];
										$Day = (int)$m[1];
										$money = (int)$m[2];
										if($i + 1 == $Day) {$data = $money;$n = array_shift($massive); $totalGain[$i] = $totalGain[$i] + $money;}
									}
									echo '<td class="ver ver'.($i + 1).' td2 Money '.$tdl.' "><p>'.$data.'</p></td>';
								}
								// 30% дық төлем
									$totalGain[(int)$money30[1] - 1] = $totalGain[(int)$money30[1] - 1] + (int)$money30[0];
									$n = explode(":",$datesPaid[1]);
									$MainMoney = (int)$n[1];
									$Pay =(int)$n[2];
									$Paid = (int)$n[3];
									echo '<td class="td2 '.$tdl.'"><p>'.$MainMoney.'</p></td>
									<td class="td2 '.$tdl.'"><p>'.$Pay.'</p></td>
									<td class="td2 '.$tdl.'"><p>'.($Paid + $paidMoney30).'</p></td>
									<td class="td2 '.$tdl.'"><p>'.($Pay - $Paid + $pastMonth - $paidMoney30).'</p></td></tr>';
									$j++;
							}
						}
						// ------------------------
							$c = $mysqli->query("SELECT `name` FROM `curator` WHERE `id` = '".$row["curatorId"]."'")->fetch_assoc();
							$r = $mysqli->query("SELECT * FROM `users` WHERE  `joinToGroup` != '1' AND `status` = '2' AND `who` = '1'");
							$u = $mysqli->query("SELECT `id`, `name`, `userId` FROM `users` WHERE `status` = '2' AND `who` = '1'");
							$num = $u->num_rows;
							$i = 1;
							$datesP = array();
							$massive = array();
							echo '<tr class="tr2 userOut">
									<td class="td2 groupNameTd"></td>
									<td class="td2 tdName groupNameTd">
										<p class = "money">Оқудан шықан оқушылар</p>
									</td>';
							for($i = 0; $i < $day + 8; $i++){
								echo '<td class="td2 groupNameTd"></td>';
							}
							echo '</tr>';
							while(($row2 = $r->fetch_assoc()) != false){
								$pastMonth = 0;
								$paidMoney30  = 0;
								$money30 = array();
								$toMonth = "";
								$paid = $mysqli->query("SELECT `datesPaid` FROM `users` WHERE `id` = '".$row2["id"]."'")->fetch_assoc();
								if($paid['datesPaid'] != false) {
									$datesP = explode(")", $paid['datesPaid']);
									for($i = 0; $i < count($datesP); $i++){
										$data = explode("(", $datesP[$i]);
										$pastData = explode("(", $datesP[$i - 1]);
										if($pastData[1] != false){
											$pastData = explode(":",$pastData[1]);
											$pay = (int)$pastData[2];
											$paid = (int)$pastData[3];
											$pastMonth = $pay - $paid;
										}
										$Mday = explode(":", $data[1]);
										if($month == (int)$Mday[0]){
											$datesPaid = explode("(",$datesP[$i]);
											$massive = $datesPaid[0];
											break;
										}else{
											$datesPaid[1] = "0:0:0:0";
										}
									}
								}
								else $datesP = array();
								$massive = explode(";",$massive);
								$p30 = explode(")",$row2["30"]);

								// print_r();
								for($i = 0; $i < count($p30); $i++){
									$paidMonth =  explode("(",$p30[$i]);;
									$paidDate =explode(":",$paidMonth[1]);
									if($month == (int)$paidDate[0]){
										$index2 = $i;
										$money30[0] = $paidDate[2];
										$money30[1] = $paidDate[1];
										$money30[2] = $paidMonth[0];
									}
									if((int)$paidMonth[0] == $month) $paidMoney30 = (int)$money30[0];
								}
								if($money30[0] != false) $toMonth = ' тг <i class="fa fa-long-arrow-right" aria-hidden="true"></i> '. $money30[2];
								echo '<tr class="tr2 ChangeColor">
									<td class="td2 td2f '.$tdl.'" ><p class = "number'.($j + 1).' number2'.$row2["id"].' number12" id = "'.($j + 1).'">'.($j + 1).'</p></td>
									<td class="td2 '.$tdl.' tdName">
										<p class = "money NameTeacher">'.$row2["name"].'</p>
									</td>
									<td class="td2 '.$tdl.'"><p>'.$row2["date"].'</p></td>
									<td class="td2 dayPay '.$tdl.'">
										<p class = "status '.$row2["id"].'" id = "'.'dayPayP'.$month.$row2["id"].'">'.$row2["dayPay"].'</p>
										<input type="text" class="write" id = "'.'dayPayInput'.$month.$row2["id"].'" >
									</td>
									<td class="td2 '.$tdl.'"><p>'.$money30[0]. $toMonth .'</p></td>
									<td class="td2 '.$tdl.'"><p>'.$pastMonth.'</p></td>';
								for($i = 0; $i < $day; $i++){
									$money = "";
									$Day = 0;
									$data = "";
									if(count($datesP) > 0){
										$m = explode(":", $massive[0]);
										$Month = (int)$m[0];
										$Day = (int)$m[1];
										$money = (int)$m[2];
										if($i + 1 == $Day) {$data = $money;$n = array_shift($massive); $totalGain[$i] = $totalGain[$i] + $money;}
									}
									echo '<td class="ver ver'.($i + 1).' td2 Money '.$tdl.' "><p>'.$data.'</p></td>';
								}
								// 30% дық төлем
								// echo $money30[1] . " " . $money30[0]. "<br>";
									$totalGain[(int)$money30[1] - 1] = $totalGain[(int)$money30[1] - 1] + (int)$money30[0];
									$n = explode(":",$datesPaid[1]);

								// $month = (int)$n[0];
								$MainMoney = (int)$n[1];
								$Pay =(int)$n[2];
								$Paid = (int)$n[3];
								// $MainMoney = $row2["money"];
								// $Pay = $row2["pay"];
								// $Paid = $row2["paid"];
								echo '<td class="td2 '.$tdl.'"><p>'.$MainMoney.'</p></td>
								<td class="td2 '.$tdl.'"><p>'.$Pay.'</p></td>
								<td class="td2 '.$tdl.'"><p>'.($Paid + $paidMoney30 ).'</p></td>
								<td class="td2 '.$tdl.'"><p>'.($Pay - $Paid + $pastMonth - $paidMoney30).'</p></td></tr>';
								$j++;
							}
						// Сумма
							echo '<tr class="tr2 ChangeColor">
								<td class="td2 td2f '.$tdl.'" ></td>
									<td class="td2 '.$tdl.' tdName"><p class = "money NameTeacher number12"><b>Сумма</b></p></td>
									<td class="td2 '.$tdl.'"></td>
									<td class="td2 '.$tdl.'"></td>
									<td class="td2 '.$tdl.'"></td>
									<td class="td2 '.$tdl.'"><p></p></td>';
								for($i = 0; $i < $day; $i++){
									echo '<td class="ver ver'.($i + 1).' td2 Money '.$tdl.' "><p>'.$totalGain[$i].'</p></td>';
								}
							echo '<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td></tr>';
						//  доп дохды
							echo '<tr class="tr2 ChangeColor">
								<td class="td2 td2f '.$tdl.'" ></td>
								<td class="td2 '.$tdl.' tdName"><p class = "money NameTeacher number12"><b>Доп. доходы</b></p></td>
									<td class="td2 '.$tdl.'"></td>
									<td class="td2 '.$tdl.'"></td>
									<td class="td2 '.$tdl.'"></td>
									<td class="td2 '.$tdl.'"><p></p></td>';
							for($i = 0; $i < $day; $i++){
								echo '<td class="ver ver'.($i + 1).' td2 Money '.$tdl.' "><p>'.$Plus[$i].'</p></td>';
							}
							echo '<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td></tr>';
						// Расходы
							echo '<tr class="tr2 ChangeColor">
								<td class="td2 td2f '.$tdl.'" ></td>
								<td class="td2 '.$tdl.' tdName"><p class = "money NameTeacher number12"><b>Расходы</b></p></td>
									<td class="td2 '.$tdl.'"></td>
									<td class="td2 '.$tdl.'"></td>
									<td class="td2 '.$tdl.'"></td>
									<td class="td2 '.$tdl.'"><p></p></td>';
							for($i = 0; $i < $day; $i++){
								echo '<td class="ver ver'.($i + 1).' td2 Money '.$tdl.' "><p>'.$Minus[$i].'</p></td>';
							}
							echo '<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td></tr>';
						// Общая сумма
							$tdl = 'td2l';
							echo '<tr class="tr2 ChangeColor">
								<td class="td2 td2f '.$tdl.'" ></td>
								<td class="td2 '.$tdl.' tdName"><p class = "money NameTeacher number12"><b>Общая сумма</b></p></td>
									<td class="td2 '.$tdl.'"></td>
									<td class="td2 '.$tdl.'"></td>
									<td class="td2 '.$tdl.'"></td>
									<td class="td2 '.$tdl.'"><p></p></td>';
							for($i = 0; $i < $day; $i++){
								echo '<td class="ver ver'.($i + 1).' td2 Money '.$tdl.' "><p><b>'.((int)$totalGain[$i] + (int)$Plus[$i] - (int)$Minus[$i]).'</b></p></td>';
							}
							echo '<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td>
								<td class="td2 '.$tdl.'"></td></tr>';
							echo '</table>
								</div>
								</div>';
						// print_r($Plus);
						// print_r($Minus);
						$i++;
						// );
					}
				?>
		</div>
	</div>
</div>
</body>
</html>
	   

