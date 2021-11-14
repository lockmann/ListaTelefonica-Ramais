<?php
session_start();
unset(
		$_SESSION['userId'],
		$_SESSION['userName'],
		$_SESSION['userLogin'],
	);
header("Location: ../../login");
?>