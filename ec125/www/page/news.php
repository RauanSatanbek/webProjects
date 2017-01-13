<?
	session_start();
	echo $_SESSION["key"];
	unset($_SESSION["key"]);
	// session_destroy();
	echo $_SESSION["key"];
	include("functions.php");
	include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Жаңалықтар</title>
	<link rel="shortcut icon" href="../img/125.jpg" type="image/jpg">
	<script src = "../js/jquery-1.12.1.min.js"></script>
	<script src="../js/imageupload.js"></script>
	<script src="../js/main.js"></script>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="http://textangular.com/dist/textAngular.css" type="text/css">
    <link href="../css/test2.css" rel="stylesheet">
	<script src="../Bootstrap3/js/bootstrap.js"></script>
    <link href="../css/main2.css" rel="stylesheet">
    <link href="../css/profile.css" rel="stylesheet">
    <link href="../css/news.css" rel="stylesheet">

	<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.min.js'></script>

	<script src='../js/textAngular-rangy.min.js'></script>

	<script src='../js/textAngular-sanitize.min.js'></script>

	<script src='../js/textAngular.min.js'></script>
    
</head>
<body ng-app="textAngularTest">

	<div class="modal-show">
		<p class="modal-show-close"><i class="fa fa-times" aria-hidden="true"></i></p>
		<div class="modal-show-body">
		 	<p id = "text"></p>
	    </div>
	</div>
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" ng-controller="wysiwygeditor" >
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>
			<h3 class="modal-title" id="gridSystemModalLabel">Жаңалық қосу</h3>
			</div>

			<script type="text/javascript">
		        var app = angular.module("textAngularTest", ['textAngular']);
		        app.controller('wysiwygeditor', ['$scope', "$http", 'textAngularManager', function wysiwygeditor($scope, $http, textAngularManager) {
		        	$scope.theme = '';
		        	$scope.error = '';
		            $scope.print = function() {
		                if($scope.htmlcontent && $scope.theme){
		        			$scope.error = '';
			                $http.post("./queries.php", {bool: 44, text: $scope.htmlcontent, topic: $scope.theme})
			                	.success(function(result) {
						        	$scope.theme = '';
						        	$scope.error = '';
						        	$scope.htmlcontent = '';
			                	})
			                	.error(function(result) {console.log(result);});
		                } else {
		        			$scope.error = 'Заполните все поля';
		                }
		            }
		        }]);
		    </script>
			<style>
				#news-saves{margin-left: 10px;float: right;}
				.modal-body{min-height: 500px;}
				#file-field{width: 0;height: 0;opacity: 0;}
				.for-img img{width: 80px;height: auto;margin-left: 20px;}
				#img-container ul li{list-style-type: none; display: inline-block;}
			</style>
			<div class="modal-body">
				<form class="form-horizantal">
					<input type="text" class="form-control" placeholder = "Тақырабы" ng-model="theme"><p></p>
					
   					<div text-angular="text-angular" name="htmlcontent" ng-model="htmlcontent" ta-disabled='disabled'></div><p></p>
					<button type = "button" class="btn btn-default" ng-click="print()">Сохранить</button>
					<p class="text-danger">{{ error }}</p>
				
				</form>
			</div>
	    </div>
	  </div>
	</div>

	<div class="containerMainNav">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 col-mine-nav">
					<img src="../img/125.jpg" height="auto" width="100" alt="" id = "logo">
					<p class="user-name"><?=$_SESSION["name"]?></p>
					<div class = "register1">
						<?
							if(7 == intval($_SESSION["type"]))
								echo '<a class = "a" id = "news-add" data-toggle="modal" data-target=".bs-example-modal-lg">Қосу</a> | ';
						?>
						<a href = "index.php" class = "a" id = "login">Бастысы</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 block-news">
				<?php
					$result = $mysqli->query("SELECT * FROM `news` ORDER BY `id` DESC");
					while(($row = $result->fetch_assoc()) != false){
						echo '<div>
							<h2 style="color:#444; text-align: left;">'.$row["topic"].'</h2>
							<p class = "news-text">'.$row["text"].'</p>
							<p class = "news-date">'.$row["date"].'</p>
							<!--<p class = "news-like"><i class="fa fa-heart" aria-hidden="true" id = "like"></i> 0</p>-->
						</div>
						<hr>';
					}
				?>
			</div>
		</div>
	</div>


	 
</body>
</html>