<?php include("./fn.php"); ?>
<?php
	
	//include("../include.vars.pg.php");
	
	if ((isset($_POST["user-name"])) && (isset($_POST["user-password"]))) {
		
		$user_name = trim($_POST["user-name"]);
		
		$user_password = trim($_POST["user-password"]);
		
		/*$string_conn = "host=" . pgserver . " user=" . pguser . " port=" . pgport . " password=" . pgpassword . " dbname=" . pgdbname;
		
		$conn = pg_connect($string_conn);
		
		$query_string = "SELECT * FROM users.vw_users WHERE user_name = '$user_name' AND user_password = md5('$user_password')";
		
		$query = pg_query($conn,$query_string);
		
		$result = pg_fetch_assoc($query);*/
		
		$result = false;
		$logged = false;
		
		if ($user_name == "admin" && $user_password == "adminieasa100%") {
			
			$result = array();
			
			$result["user_name"] = "Administrador";
			$result["user_fullname"] = "Administrador";
			$result["user_profile"] = "";
			$result["user_type_desc"] = "";
			
			$logged = true;
			
		}
		
		if ($result) {
			
			session_start();
			
			$_SESSION["user_info"] = $result;
			
		}
		
	}else{
		
		die("Invalid Token");
		
	}
	
?>

<!DOCTYPE html>
<html lang="es">
<head>

	<title>Inicio</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<?php include("./scripts.default.php"); ?>
	<?php include("./scripts.onresize.php"); ?>		
	
</head>
<body style="overflow:hidden;">

	<div id="page">
	
		<?php include("./html.navbar-main.php"); ?>
		
		<div class="page-container" style="background-color: #FFFFFF; height:100%; padding:100px;">
		
			<?php
		
		if ($result) {
			
			?>
			
			<h2 class="m-v-50" style="font-size:12px;">
				<p>Bienvenido <?php echo "Administrador de IEASA"; //echo $_SESSION["user_info"]["user_fullname"]; ?>!</p>
			</h2>
			
			<h3 class="text-success" style="font-size:14px;"> Redireccionando por favor espere... </h3>
			
			<?php
			
		}else{
			
			?>
			
			<h2 class="m-v-50" style="font-size:12px;">
				<p>Los datos ingresados son incorrectos</p>
				<p>Por favor verifique la información ingresada y vuelva a intentar</p>
			</h2>
			
			<h3 class="text-danger" style="font-size:14px;"> Redireccionando por favor espere... </h3>
			
			<?php
			
		}
		
		?>
		
		<script type="text/javascript">
		
			setTimeout(function() {
							
				location.href = "<?php echo $_SERVER["HTTP_REFERER"]; ?>"
							
			},5000);
				
		</script>
			
		</div>
		
	</div>
			
	<?php include("./html.navs.php"); ?>
			
	<?php include("./footer.php"); ?>
	
	<?php //include("./widget-links.php"); ?>

</body>
</html>