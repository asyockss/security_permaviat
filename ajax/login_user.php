<?php
	session_start();
	include("../settings/connect_datebase.php");
	
	$login = $_POST['login'];
	$password = $_POST['password'];
	
	// ищем пользователя
	$query_user = $mysqli->query("SELECT * FROM `users` WHERE `login`='".$login."' AND `password`= '".$password."';");
	
	$id = -1;
	while($user_read = $query_user->fetch_row()) {
		$id = $user_read[0];
	}
	
	if($id != -1) {
		$_SESSION['user'] = $id;

		$ip = $_SERVER["REMOTE_ADDR"];
		$dateStart = date("Y-m-d H:i:s");

		$Sql = "INSERT INTO `session`(`idUser`, `ip`, `dateStart`, `dateNow`) VALUES ({$id}, '{$ip}', '{$dateStart}', '{$dateStart}')";
		$mysqli->query($Sql);
	}
	echo md5(md5($id));
?>