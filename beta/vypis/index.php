<?php
session_start();
date_default_timezone_set("Europe/Prague");
include "../include/check.php";
$seznam_a="active";
include "../include/body.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Výpis
    </h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-home"></i>Domů</a></li>
      <li>Výpis členů klanu</li>
    </ol>

  </section>
	
	<section class="content">
<div class="box">
		<div class="box-body no-padding">
			<table id="example1" class="table table-condensed table-striped">
				<thead>


					<tr>
						<th>IGN (Jméno ve hře)</th>
						<th>eCZ hodnost</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$queryResult = $mysqli->query("SELECT IGN,ecz FROM users ORDER BY ecz DESC, FIELD(IGN,'PaulOneil','MasterPK'), IGN ASC;");
					if ($queryResult->num_rows > 0) {
						
						while($row = $queryResult->fetch_assoc()) {
							switch($row["ecz"]){
							case 0:$row["ecz"]="Čeká na potvrzení";
							break;
							case 1:$row["ecz"]="Soldier";
							break;
							case 2:$row["ecz"]="Officer";
							break;
							case 3:$row["ecz"]="Commander";
							break;
						};
							echo "
							<tr>
								<td>".$row["IGN"]."</td>
								<td class='center'>".$row["ecz"]."</td>
							</tr>
							";
						}
					};



					?>


				</tbody>
			</table>

			
		</div><!-- /.box-body -->
	</div><!-- /.box -->
	<!-- /block -->
	</section>
	</div>
	<?
include "../include/footer.php";
  
  
  ?>