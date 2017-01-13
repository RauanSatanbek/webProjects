<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.2.30/angular.min.js"></script>
	<style>
		*{
			font-family: Arial;
			font-size: 14px;
			outline: none;
			color:#444;
		}
		input{
			height: 25px;
			border:1px solid #ccc;
			border-radius: 5px;
			padding-left:5px;
		}
	</style>
</head>
<body ng-app>
	<input type="text" ng-model = "name">
	<span>{{name}}</span>
</body>
</html>