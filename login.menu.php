<?php 

if (sizeof($_SESSION) > 0) {

?>

	<li class="dropdown">
		<a href="#" id="navbarDropdown-help" role="button" data-toggle="dropdown" aria-expanded="false" title="Menu de usuario">
			<i class="fa fa-user"></i>
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown-help" id="dropdown-help">
			<ul>
				<li>
					<a class="dropdown-item" href="#">Mi Panel</a>
				</li>
				<li>
					<a class="dropdown-item" href="#">Mi Colección</a>
				</li>
				<li>
					<a class="dropdown-item" href="#">Cambiar Contraseña</a>
				</li>
				<li>
					<a class="dropdown-item" href="#">Cerrar Sesión</a>
				</li>
			</ul>
		</div>            
	</li>

<?php }else{ ?>
	
	<li class="dropdown">
		<a href="#" id="navbarDropdown-help" role="button" data-toggle="dropdown" aria-expanded="false" title="Menu de usuario">
			<i class="fa fa-user"></i>
		</a>
		<form method="post" action="./CMD-login.php" id="frm">
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown-help" id="dropdown-help">
				<ul>
					<li>
						<div class="form-group">
							<i class="fa fa-user"></i>
							<input type="text" placeholder="Usuario" name="user-name" data-placeholder="Usuario">
						</div>
					</li>
					<li>
						<div class="form-group">
							<i class="fa fa-key"></i>
							<input type="password" placeholder="Contraseña" name="user-password" data-placeholder="Contraseña">
						</div>
					</li>
					<li>
						<div class="form-group form-group-button">
							<a href="#" class="login-black-button" onclick="document.getElementById('frm').submit();">INGRESAR</a>
						</div>
					</li>
				</ul>
			</div>
		</form>
	</li>

<?php
	
}

?>