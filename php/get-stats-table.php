<?php

include("../pgconfig.php");

$page = $_POST["page"];
$dt_id = $_POST["dt_id"];
$dt_variables = $_POST["dt_variables"];
$dt_cruce = $_POST["dt_cruce"];

$string_conn = "host=" . pg_server . " user=" . pg_user . " port=" . pg_portv . " password=" . pg_password . " dbname=" . pg_db;
	
$conn = pg_connect($string_conn);

$query_string = "SELECT * FROM mod_estadistica.get_dt_from($dt_id,'$dt_variables','$dt_cruce') AS query";

$query = pg_query($conn,$query_string);

$data = pg_fetch_assoc($query);

$rquery = $data["query"];

$query = pg_query($conn,$rquery);

?>
	
<div class="dataset">

	<div class="dataset-row dataset-row-header dataset-columns-row">

	<?php

	$query_string_a = array();
	$col = array();
	
	$query = pg_query($conn,$query_string);
	
	while($r = pg_fetch_assoc($query)) {
		
	?>
		
		<div class="dataset-cell dataset-cell-header">
			<span><?php echo $r["column_name"]; ?></span>
			<i class="fa fa-info-circle"></i>
		</div>
		
	<?php
		
		array_push($query_string_a,"SELECT DISTINCT " . $r["column_name"] . " FROM \"".$schema."\".\"".$table."\"");
		array_push($col,$r["column_name"]);
		
	}

	?>

	</div>
	
	<div class="dataset-row dataset-row-header dataset-filter-row">

	<?php
	
	for ($i=0; $i<sizeof($query_string_a); $i++) {
		
		$query = pg_query($conn,$query_string_a[$i]);
		
		?>
		
		<div class="dataset-cell dataset-cell-header">
			<select class="selectpicker filter-combo">		
				<option value="-1">Todo</option>
		<?php
		
		while($r = pg_fetch_assoc($query)) {
			
		?>
				<option value="<?php echo $r[$col[$i]]; ?>"><?php echo $r[$col[$i]]; ?></option>
			
		<?php
			
		}
		
		?>
			</select>
		</div>
			
		<?php
	
	}

	?>

	</div>
	
	<div class="dataset-row dataset-row-header dataset-operation-row">

	<?php
	
	for ($i=0; $i<sizeof($col); $i++) {
		
	?>
		<div class="dataset-cell">
			<select class="selectpicker operation-combo" tabindex="-98">
				<option value="-1">OPERACIONES</option>
				<option value="1">SUMA</option>
				<option value="2">PROMEDIO</option>
				<option value="3">MIN</option>
				<option value="4">MAX</option>
				<option value="5">CUENTA</option>
			</select>
		</div>
			
	
	<?php		
	
	}

	?>

	</div>

	<?php
	
	$col_str = implode($col,",");
	$col_str_order = implode($col," ASC,") . " ASC LIMIT 10 OFFSET " . (($page-1)*10);
	
	$query_string = "SELECT $col_str FROM \"".$schema."\".\"".$table."\" ORDER BY " . $col_str_order;
	
	$query = pg_query($conn,$query_string);
			
	while($r = pg_fetch_assoc($query)) {
	
	?>
	
	<div class="dataset-row">
		
		<?php
		
		for ($i=0; $i<sizeof($col); $i++) {
	
		?>
		
		<div class="dataset-cell">
			<span><?php echo $r[$col[$i]]; ?></span>
		</div>
		
		<?php
	
		}
		
		?>

	</div>
	
	<?php
		
	}

	?>

</div>

<div class="row jump-row">
	
	<div class="jus-between-f100 mt-30 align-center">

		<div>
	
			<a href="./estadisticas.php" id="stats-proceed" class="mt-50">&lt; ANTERIOR</a>
		
		</div>
	
		<div class="pagination">
	
			<ul class="mp0">
			
				<?php
	
				$query_string = "SELECT $col_str FROM \"".$schema."\".\"".$table."\"";
				$records = pg_num_rows(pg_query($conn,$query_string));
				$pageCount = ceil($records/10);
				/*echo $query_string;
				echo "<p>PAGECOUNT: " . $pageCount . "</p>";
				echo "<p>PAGE: " . $page . "</p>";*/
				
				
				if ($pageCount <= 10) {
					
					$class = "";
					
					for ($i=0; $i<$pageCount; $i++) {
					
						if ($page==($i+1)) {
							$class = " class=\"page-item page-active\"";
						}else{
							$class = " class=\"page-item\"";							
						}
						
						?>
						
						<li>
							<a href="javascript:void(0);" <?php echo $class; ?> data-page="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
						</li>
						
						<?php
						
					}
					
				}else{
					
					if (($page <= 3) || ($page > $pageCount -3)) {
						
						$class = "";
						
						for ($i=0; $i<5; $i++) {
							
							if ($page==($i+1)) {
								$class = " class=\"page-item page-active\"";
							}else{
								$class = " class=\"page-item\"";							
							}
							?>
							
							<li>
								<a href="javascript:void(0);"<?php echo $class; ?> data-page="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
							</li>
							
							<?php
							
						}
						
						$mid = round($pageCount/2);
						
						?>
						
						<li>
							<span>...</span>
						</li>
						<li>
							<a href="javascript:void(0);" <?php if ($page == ($mid-1)) { $class = " class=\"page-active\""; }else{ $class = " class=\"page-item\""; } echo $class;  ?> data-page="<?php echo ($mid-1); ?>"><?php echo ($mid-1); ?></a>
						</li>						
						<li>
							<a href="javascript:void(0);" <?php if ($page == ($mid)) { $class = " class=\"page-active\""; }else{ $class = " class=\"page-item\""; } echo $class; ?>  data-page="<?php echo ($mid); ?>"><?php echo ($mid); ?></a>
						</li>						
						<li>
							<a href="javascript:void(0);" <?php if ($page == ($mid+1)) { $class = " class=\"page-active\""; }else{ $class = " class=\"page-item\""; } echo ($mid+1); ?> data-page="<?php echo ($mid+1); ?>"><?php echo ($mid+1); ?></a>
						</li>	
						<li>
							<span>...</span>
						</li>
						
						<?php
						
						$class = "";
						
						for ($i=$pageCount-5; $i<$pageCount; $i++) {
							
							if ($page==($i+1)) {
								$class = " class=\"page-item page-active\"";
							}else{
								$class = " class=\"page-item\"";							
							}
							
							?>
							
							<li>
								<a href="javascript:void(0);" <?php echo $class; ?> data-page="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
							</li>
							
							<?php
							
						}
						
					}else{
						
						if ($page <= 6) {
							
							$class = "";
							
							for ($i=0; $i<6; $i++) {
					
								if ($page==($i+1)) {
									$class = " class=\"page-item page-active\"";
								}else{
									$class = " class=\"page-item\"";							
								}
						
								?>
								
								<li>
									<a href="javascript:void(0);"<?php echo $class; ?> data-page="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
								</li>
								
								<?php		
								
							}
							
							$mid = round($pageCount/2);
							
							?>
						
							<li>
								<span>...</span>
							</li>
							<li>
								<a href="javascript:void(0);" <?php if ($page == ($mid-1)) { $class = " class=\"page-active\""; }else{ $class = " class=\"page-item\""; } echo $class;  ?> data-page="<?php echo ($mid-1); ?>"><?php echo ($mid-1); ?></a>
							</li>						
							<li>
								<a href="javascript:void(0);" <?php if ($page == ($mid)) { $class = " class=\"page-active\""; }else{ $class = " class=\"page-item\""; } echo $class; ?>  data-page="<?php echo ($mid); ?>"><?php echo ($mid); ?></a>
							</li>						
							<li>
								<a href="javascript:void(0);" <?php if ($page == ($mid+1)) { $class = " class=\"page-active\""; }else{ $class = " class=\"page-item\""; } echo ($mid+1); ?> data-page="<?php echo ($mid+1); ?>"><?php echo ($mid+1); ?></a>
							</li>	
							<li>
								<span>...</span>
							</li>
							
							<?php
							
							$class = "";
							
							for ($i=$pageCount-3; $i<$pageCount; $i++) {
								
								if ($page==($i+1)) {
									$class = " class=\"page-item page-active\"";
								}else{
									$class = " class=\"page-item\"";							
								}
								
								?>
								
								<li>
									<a href="javascript:void(0);"<?php echo $class; ?> data-page="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
								</li>
								
								<?php
								
							}
							
						}else{
							
							if ($page > ($pageCount -6)) {
								
								$class = "";
								
								for ($i=0; $i<3; $i++) {
									
									if ($page==($i+1)) {
										$class = " class=\"page-item page-active\"";
									}else{
										$class = " class=\"page-item\"";							
									}
									
									?>
									
									<li>
										<a href="javascript:void(0);"<?php echo $class; ?> data-page="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
									</li>
									
									<?php
									
								}								
							
								$mid = round($pageCount/2);
								
								?>
							
								<li>
									<span>...</span>
								</li>
								<li>
									<a href="javascript:void(0);" <?php if ($page == ($mid-1)) { $class = " class=\"page-active\""; }else{ $class = " class=\"page-item\""; } echo $class;  ?> data-page="<?php echo ($mid-1); ?>"><?php echo ($mid-1); ?></a>
								</li>						
								<li>
									<a href="javascript:void(0);" <?php if ($page == ($mid)) { $class = " class=\"page-active\""; }else{ $class = " class=\"page-item\""; } echo $class; ?>  data-page="<?php echo ($mid); ?>"><?php echo ($mid); ?></a>
								</li>						
								<li>
									<a href="javascript:void(0);" <?php if ($page == ($mid+1)) { $class = " class=\"page-active\""; }else{ $class = " class=\"page-item\""; } echo $class; ?> data-page="<?php echo ($mid+1); ?>"><?php echo ($mid+1); ?></a>
								</li>	
								<li>
									<span>...</span>
								</li>
								
								<?php
								
								$class = "";
								
								for ($i=$pageCount-6; $i<$pageCount; $i++) {
									
									if ($page==($i+1)) {
										$class = " class=\"page-item page-active\"";
									}else{
										$class = " class=\"page-item\"";							
									}
									
									?>
									
									<li>
										<a href="javascript:void(0);"<?php echo $class; ?> data-page="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
									</li>
									
									<?php
									
								}
								
							}else{
								
								$class = "";
								
								for ($i=0; $i<3; $i++) {
									
									if ($page==($i+1)) {
										$class = " class=\"page-item page-active\"";
									}else{
										$class = " class=\"page-item\"";							
									}
									
								?>
								
								<li>
									<a href="javascript:void(0);"<?php echo $class; ?> data-page="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
								</li>
								
								<?php
								
								}
								
								?>
								
								<li>
									<span>...</span>
								</li>
								<li>
									<a href="javascript:void(0);" data-page="<?php echo ($page-1); ?>" class="page-item"><?php echo ($page-1); ?></a>
								</li>						
								<li>
									<a href="javascript:void(0);" data-page="<?php echo ($page); ?>" class="page-active"><?php echo $page; ?></a>
								</li>						
								<li>
									<a href="javascript:void(0);" data-page="<?php echo ($page+1); ?>" class="page-item"><?php echo ($page+1); ?></a>
								</li>		
								<li>
									<span>...</span>
								</li>
								
								<?php
								
								$class = "";
								
								for ($i=$pageCount-3; $i<$pageCount; $i++) {
									
									if ($page==($i+1)) {
										$class = " class=\"page-item page-active\"";
									}else{
										$class = " class=\"page-item\"";							
									}
									
									?>
									
									<li>
										<a href="javascript:void(0);"<?php echo $class; ?> data-page="<?php echo ($i+1); ?>"><?php echo ($i+1); ?></a>
									</li>
									
									<?php
									
								}
								
							}
							
						}
						
					}
					
				}
				
				?>
				
			</ul>
		
		</div>
	
		<div>
	
			<a href="./estadisticas.php" class="black-button">MAPEAR</a>
			<a href="./estadisticas.php" class="black-button">GRAFICAR</a>
		
		</div>

	</div>

</div>