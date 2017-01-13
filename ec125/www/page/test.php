<?php
	session_start();
	include("db.php");
    $result = $mysqli->query("SELECT * FROM `users`");

    // $result = $mysqli->query("SELECT `userId` FROM `users` ORDER BY `id` DESC")->fetch_assoc();
    // $userId = (int)$result["userId"] + 1;
    // $password = $userId;
    // $password2 = $password;

    // for($i = 0; $i < 10; $i++) $password = md5($password);

    // echo $userId;

    for($i = 0; $i < 25; $i++) {
        $row = $result->fetch_assoc();
        // print_r($row);
        echo $row["curator"]. " " . $row["type"] . " " .$row["who"] . " " . "<br>";
    }
	// e629605ff0cd0dbaeca376684de63488 | 74b23b5e7da08492407 c051f2af7d84b json_encode($_FILES['avatar'])
	// $c = "125125002";
	// for($i = 0; $i < 10; $i++){
	// 	$c = md5($c);
	// }
	// echo $c;
?>
<!-- <a href="files/download.php?file=../img2.jpg"  class = "loadTest">Скачать</a> -->
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src = "../js/jquery-1.12.1.min.js"></script>
    <link rel="stylesheet" href="../font-awesome-4.6.3/css/font-awesome.min.css">
    <script>
    $(document).ready(function(){
        console.log( null - false + true);
    	function work(obj){
    		$("#image").attr("src", obj)
    	}
    	$(".buttonLoadAvatarTest").click(function(){
    		console.log($("#avatar").val());
    		// $("#form_submit").submit({id:"sendAvatar"}, "test.php");
    		$.ajax({
    			url : "test.php",
    			type: "post",
    			data: {bool:3},
    			dataType: "html",
    			success: function(data){
    				console.log(data);
    			}
    		});
    	});
    });
    </script>
</head>
<body>
	
    <!-- <form action = "" method = "post" enctype =  'multipart/form-data'>
        <label for="selectFile"><a>Фото</a></label>
        <input type="file" id = "selectFile" name = "news-img">
    </form> -->
<!-- 	<img src="" alt="" id="image">
	<iframe src="imgframe" frameborder="0" id="imgframe" name=""></iframe> -->
</body>
</html>