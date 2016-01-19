<?php
//konstrukce
//header("location: ./construction/");
	if($_GET["id"]=="logout"){
		session_destroy();
		header("location: ./");
	}elseif($_SESSION['logged-fast']!=1){
			header("location: ../login/");
			
		};

	php?>


	