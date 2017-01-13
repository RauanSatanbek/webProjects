<?php

/** Данные для подключения к Базе Данных */

/** Подключаемся в Базе Данных */
$pdo = new mysqli("localhost", "root", "", "users");
$pdo->query("SET NAMES 'utf8'");

/** Получаем наш ID статьи из запроса */
$id =$_POST['id'];
$count = 0;
$message = '';
$error = true;

/** Если нам передали ID то обновляем */
if($id){
	/** Обновляем количество лайков в статье */
	
	$query = $pdo->query("UPDATE `article` SET `count_like` = `count_like`+1  WHERE `id` = $id");
	// $query->execute(array(':id'=>$id));
	
	/** Выбираем количество лайков в статье */
	$query = $pdo->query("SELECT `count_like` FROM `article` WHERE `id` = $id");
	// $query->execute(array(':id'=>$id));
	$result = $query->fetch_assoc();
	$count = isset($result['count_like']) ? $result['count_like']  : 0;
	
	$error = false;
}else{
	/** Если ID пуст - возвращаем ошибку */
	
	$error = true;
	$message = 'Статья не найдена';
}


/** Возвращаем ответ скрипту */

// Формируем масив данных для отправки
$out = array(
	'error1' => $error,
	'message' => $message,
	'count' => $count,
);

// Устанавливаем заголовот ответа в формате json
header('Content-Type: text/json; charset=utf-8');

// Кодируем данные в формат json и отправляем
echo json_encode($out);

$pdo->close();
?>

