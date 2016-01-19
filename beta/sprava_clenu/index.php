<?php
session_start();
date_default_timezone_set("Europe/Prague");
include "../include/check.php";
$pseznam_a="active";
include "../include/body.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Správa členů klanu
		</h1>
		<ol class="breadcrumb">
			<li><a href="./"><i class="fa fa-home"></i>Domů</a></li>
			<li>Správa členů klanu</li>
		</ol>

	</section>

	<style>
	th{width: 18%;}
	</style>
	
	<section class="content">
		<!-- commanders -->
		 <div class="row">
            <div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Commanders</h3>
				<div class="box-tools pull-right">
					<!-- Buttons, labels, and many other things can be placed here! -->
					<!-- Here is a label for example -->
					<? 
					$queryResult = $mysqli->query("SELECT athena_rank,Fname,Lname,IGN,last_activity,registrace FROM users WHERE ecz=\"3\" ORDER BY FIELD(athena_rank,'L','C','M','C1','C4','G1','G3','G4','G5') DESC, FIELD(IGN,'PaulOneil','MasterPK') ASC, IGN ASC;");
					?>
					<span class="label label-primary"><? echo mysqli_num_rows($queryResult);?></span>
				</div><!-- /.box-tools -->
			</div>
			<div class="box-body table-responsive no-padding">
							<table id="example1" class="table table-striped table-condensed">

					<thead>

						<tr>
							<th>Athena rank <span class="fa fa-sor"></span></th>
							<th>IGN (Jméno ve hře) <span class="fa fa-sor"></span></th>
							<th>Jméno <span class="fa fa-sor"></span></th>
							<th>Registrován dne <span class="fa fa-sor"></span></th>
							<th>Poslední aktivita <span class="fa fa-sor"></span></th>
							<th></th>
						</tr>

					</thead>
					<tbody>
						<?php





						if ($queryResult->num_rows > 0) {

							while($row = $queryResult->fetch_assoc()) {

								switch($row["ecz"]){
									case "0":$row["ecz"]="Čeká na potvrzení";
									break;
									case "1":$row["ecz"]="Soldier";
									break;
									case "2":$row["ecz"]="Officer";
									break;
									case "3":$row["ecz"]="Commander";
									break;
								};
								switch($row["athena_rank"]){
									case "L":$row["athena_rank"]="LIEUTENANT 1-5";
									break;
									case "C":$row["athena_rank"]="CAPTAIN 1-5";
									break;
									case "M":$row["athena_rank"]="MAJOR 1-5";
									break;
									case "C1":$row["athena_rank"]="COLONEL 1-3";
									break;
									case "C4":$row["athena_rank"]="COLONEL 4-5";
									break;
									case "G1":$row["athena_rank"]="GENERAL 1-2";
									break;
									case "G3":$row["athena_rank"]="GENERAL 3";
									break;
									case "G4":$row["athena_rank"]="GENERAL 4";
									break;
									case "G5":$row["athena_rank"]="GENERAL 5";
									break;
								}; 
								$datum_registrace=mktime(0,0,0,substr($row["registrace"], 5,2),substr($row["registrace"], 8,2),substr($row["registrace"], 0,4));
								$aktivita=mktime(0,0,0,substr($row["last_activity"], 5,2),substr($row["last_activity"], 8,2),substr($row["last_activity"], 0,4));
								$d2=ceil((time()-$aktivita)/60/60/24);
								if($d2>15){$callout="label-warning";if($d2>30){$callout="label-danger";};}else{$callout="label-success";};
								echo "
								
								<tr>

									<td>".$row["athena_rank"]."</td>
									<td>".$row["IGN"]."</td>
									<td>".$row["Fname"]." ".$row["Lname"]."</td>
									<td>".date("d.m.Y",$datum_registrace)."</td>
									<td>
										<div class='label ".$callout."'>".date("d.m.Y",$aktivita)."</div>


									</td>
									";
									if($vysledek2["IGN"]!=$row["IGN"]){ 

										echo "
										<td><a href='?id=edit_u&name=".$row["IGN"]."'><button class=\"btn btn-primary btn-flat btn-sm btn-block\">Upravit</button></a></td>
										";}else{

											echo "	<td><a href='?id=edit_u&name=".$row["IGN"]."'><button class=\"btn btn-primary btn-flat btn-sm btn-block\">Zobrazit</button></a></td>";

										};
										echo "</tr> ";




									}
								};



								?>


							</tbody>
						</table>

					</div>
				</div><!-- /.box-body -->
				<!-- /.box -->
				<!-- /commanders -->
				<!-- officers -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Officers</h3>
						<div class="box-tools pull-right">
							<span class="label label-primary"><? 
								$queryResult = $mysqli->query("SELECT athena_rank,Fname,Lname,IGN,ecz,last_activity,registrace FROM users WHERE ecz=\"2\" ORDER BY FIELD(athena_rank,'L','C','M','C1','C4','G1','G3','G4','G5') DESC, FIELD(IGN,'PaulOneil','MasterPK') ASC, IGN ASC;");
								echo mysqli_num_rows($queryResult);?></span>
							</div>
						</div>
						<div class="box-body table-responsive no-padding">
							<table id="example1" class="table table-striped table-condensed">

								<thead>

									<tr>
										<th>Athena rank</th>
										<th>IGN (Jméno ve hře)</th>
										<th>Jméno</th>
										<th>Registrován dne</th>
										<th>Poslední aktivita</th>
										<th></th>
									</tr>

								</thead>
								<tbody>
									<?php





									if ($queryResult->num_rows > 0) {

										while($row = $queryResult->fetch_assoc()) {

											switch($row["ecz"]){
												case "0":$row["ecz"]="Čeká na potvrzení";
												break;
												case "1":$row["ecz"]="Soldier";
												break;
												case "2":$row["ecz"]="Officer";
												break;
												case "3":$row["ecz"]="Commander";
												break;
											};
											switch($row["athena_rank"]){
												case "L":$row["athena_rank"]="LIEUTENANT 1-5";
												break;
												case "C":$row["athena_rank"]="CAPTAIN 1-5";
												break;
												case "M":$row["athena_rank"]="MAJOR 1-5";
												break;
												case "C1":$row["athena_rank"]="COLONEL 1-3";
												break;
												case "C4":$row["athena_rank"]="COLONEL 4-5";
												break;
												case "G1":$row["athena_rank"]="GENERAL 1-2";
												break;
												case "G3":$row["athena_rank"]="GENERAL 3";
												break;
												case "G4":$row["athena_rank"]="GENERAL 4";
												break;
												case "G5":$row["athena_rank"]="GENERAL 5";
												break;
											}; 
											$datum_registrace=mktime(0,0,0,substr($row["registrace"], 5,2),substr($row["registrace"], 8,2),substr($row["registrace"], 0,4));
											$aktivita=mktime(0,0,0,substr($row["last_activity"], 5,2),substr($row["last_activity"], 8,2),substr($row["last_activity"], 0,4));
											$d2=ceil((time()-$aktivita)/60/60/24);
											if($d2>15){$callout="label-warning";if($d2>30){$callout="label-danger";};}else{$callout="label-success";};
											echo "
											<tr>
												<td>".$row["athena_rank"]."</td>
												<td>".$row["IGN"]."</td>
												<td>".$row["Fname"]." ".$row["Lname"]."</td>
												<td>".date("d.m.Y",$datum_registrace)."</td>
												<td>
													<div class='label ".$callout."'>".date("d.m.Y",$aktivita)."</div>


												</td>
												";
												if($vysledek2["IGN"]!=$row["IGN"]){ 

													echo "
													<td><a href='?id=edit_u&name=".$row["IGN"]."'><button class=\"btn btn-primary btn-flat btn-sm btn-block\">Upravit</button></a></td>
													";}else{

														echo "	<td><a href='?id=edit_u&name=".$row["IGN"]."'><button class=\"btn btn-primary btn-flat btn-sm btn-block\">Zobrazit</button></a></td>";

													};
													echo "</tr>";




												}
											};



											?>


										</tbody>
									</table>

								</div>
							</div><!-- /.box-body -->
							<!-- /.box -->
							<!-- /officers -->
							<!-- soldiers -->
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">Soldiers</h3>
									<div class="box-tools pull-right">
										<span class="label label-primary"><? $queryResult = $mysqli->query("SELECT athena_rank,Fname,Lname,IGN,last_activity,registrace FROM users WHERE ecz=\"1\" ORDER BY FIELD(athena_rank,'L','C','M','C1','C4','G1','G3','G4','G5') DESC, FIELD(IGN,'PaulOneil','MasterPK') ASC, IGN ASC;");
											; echo mysqli_num_rows($queryResult);?></span>
										</div>
									</div>
									<div class="box-body table-responsive no-padding">
										<table id="example1" class="table table-striped table-condensed">

											<thead>

												<tr>
													<th>Athena rank</th>
													<th>IGN (Jméno ve hře)</th>
													<th>Jméno</th>
													<th>Registrován dne</th>
													<th>Poslední aktivita</th>
													<th></th>
												</tr>

											</thead>
											<tbody>
												<?php





												if ($queryResult->num_rows > 0) {

													while($row = $queryResult->fetch_assoc()) {

														switch($row["ecz"]){
															case "0":$row["ecz"]="Čeká na potvrzení";
															break;
															case "1":$row["ecz"]="Soldier";
															break;
															case "2":$row["ecz"]="Officer";
															break;
															case "3":$row["ecz"]="Commander";
															break;
														};
														switch($row["athena_rank"]){
															case "L":$row["athena_rank"]="LIEUTENANT 1-5";
															break;
															case "C":$row["athena_rank"]="CAPTAIN 1-5";
															break;
															case "M":$row["athena_rank"]="MAJOR 1-5";
															break;
															case "C1":$row["athena_rank"]="COLONEL 1-3";
															break;
															case "C4":$row["athena_rank"]="COLONEL 4-5";
															break;
															case "G1":$row["athena_rank"]="GENERAL 1-2";
															break;
															case "G3":$row["athena_rank"]="GENERAL 3";
															break;
															case "G4":$row["athena_rank"]="GENERAL 4";
															break;
															case "G5":$row["athena_rank"]="GENERAL 5";
															break;
														}; 
														$datum_registrace=mktime(0,0,0,substr($row["registrace"], 5,2),substr($row["registrace"], 8,2),substr($row["registrace"], 0,4));
														$aktivita=mktime(0,0,0,substr($row["last_activity"], 5,2),substr($row["last_activity"], 8,2),substr($row["last_activity"], 0,4));
														$d2=ceil((time()-$aktivita)/60/60/24);
														if($d2>15){$callout="label-warning";if($d2>30){$callout="label-danger";};}else{$callout="label-success";};
														echo "
														<tr>
															<td>".$row["athena_rank"]."</td>
															<td>".$row["IGN"]."</td>
															<td>".$row["Fname"]." ".$row["Lname"]."</td>
															<td>".date("d.m.Y",$datum_registrace)."</td>
															<td>
																<div class='label ".$callout."'>".date("d.m.Y",$aktivita)."</div>


															</td>
															";
															if($vysledek2["IGN"]!=$row["IGN"]){ 

																echo "
																<td><a href='?id=edit_u&name=".$row["IGN"]."'><button class=\"btn btn-primary btn-flat btn-sm btn-block\">Upravit</button></a></td>
																";}else{

																	echo "	<td><a href='?id=edit_u&name=".$row["IGN"]."'><button class=\"btn btn-primary btn-flat btn-sm btn-block\">Zobrazit</button></a></td>";

																};
																echo "</tr>";




															}
														};



														?>


													</tbody>
												</table>

											</div>
										</div><!-- /.box-body -->
										<? 						$queryResult = $mysqli->query("SELECT athena_rank,Fname,Lname,IGN,ecz,last_activity,registrace FROM users WHERE ecz=\"0\" ORDER BY FIELD(athena_rank,'L','C','M','C1','C4','G1','G3','G4','G5') DESC, FIELD(IGN,'PaulOneil','MasterPK') ASC, IGN ASC;");
										?>
										<!-- /soldiers -->
										<!-- Čekající na schávlení -->
										<div class="box box-primary">
											<div class="box-header with-border">
												<h3 class="box-title">Čekající na schválení</h3>
												<div class="box-tools pull-right">
													<span class="label label-primary"><? echo mysqli_num_rows($queryResult);?></span>
												</div>
											</div>
											<div class="box-body table-responsive no-padding">
												<table id="example1" class="table table-striped table-condensed">

													<thead>

														<tr>
															<th>Athena rank</th>
															<th>IGN (Jméno ve hře)</th>
															<th>Jméno</th>
															<th>Registrován dne</th>
															<th>Poslední aktivita</th>
															<th></th>
														</tr>

													</thead>
													<tbody>
														<?php





														if ($queryResult->num_rows > 0) {

															while($row = $queryResult->fetch_assoc()) {

																switch($row["ecz"]){
																	case "0":$row["ecz"]="Čeká na potvrzení";
																	break;
																	case "1":$row["ecz"]="Soldier";
																	break;
																	case "2":$row["ecz"]="Officer";
																	break;
																	case "3":$row["ecz"]="Commander";
																	break;
																};
																switch($row["athena_rank"]){
																	case "L":$row["athena_rank"]="LIEUTENANT 1-5";
																	break;
																	case "C":$row["athena_rank"]="CAPTAIN 1-5";
																	break;
																	case "M":$row["athena_rank"]="MAJOR 1-5";
																	break;
																	case "C1":$row["athena_rank"]="COLONEL 1-3";
																	break;
																	case "C4":$row["athena_rank"]="COLONEL 4-5";
																	break;
																	case "G1":$row["athena_rank"]="GENERAL 1-2";
																	break;
																	case "G3":$row["athena_rank"]="GENERAL 3";
																	break;
																	case "G4":$row["athena_rank"]="GENERAL 4";
																	break;
																	case "G5":$row["athena_rank"]="GENERAL 5";
																	break;
																}; 
																$datum_registrace=mktime(0,0,0,substr($row["registrace"], 5,2),substr($row["registrace"], 8,2),substr($row["registrace"], 0,4));
																$aktivita=mktime(0,0,0,substr($row["last_activity"], 5,2),substr($row["last_activity"], 8,2),substr($row["last_activity"], 0,4));
																$d2=ceil((time()-$aktivita)/60/60/24);
																if($d2>15){$callout="label-warning";if($d2>30){$callout="label-danger";};}else{$callout="label-success";};
																echo "
																<tr>
																	<td>".$row["athena_rank"]."</td>
																	<td>".$row["IGN"]."</td>
																	<td>".$row["Fname"]." ".$row["Lname"]."</td>
																	<td>".date("d.m.Y",$datum_registrace)."</td>
																	<td>
																		<div class='label ".$callout."'>".date("d.m.Y",$aktivita)."</div>


																	</td>
																	";
																	if($vysledek2["IGN"]!=$row["IGN"]){ 

																		echo "
																		<td><a href='?id=edit_u&name=".$row["IGN"]."'><button class=\"btn bg-primary btn-flat btn-sm btn-block\">Upravit</button></a></td>
																		";}else{

																			echo "	<td><a href='?id=edit_u&name=".$row["IGN"]."'><button class=\"btn bg-primary btn-flat btn-sm btn-block\">Zobrazit</button></a></td>";

																		};
																		echo "</tr>";




																	}
																};



																?>


															</tbody>
														</table>

													</div>
												</div><!-- /.box-body -->
												<!-- /.box -->
												<!-- /Čekající na schválení -->
												<!-- /block -->
											</div>
									
										</div>
									</div>

											</section>
									

										<?
										include "../include/footer.php";

										?>
										<script>

											$(function () {
												$("table").DataTable({
													"info": false,
													"language": {
														"zeroRecords": "Žádné dostupné výsledky",
														"loadingRecords": "Načítání...",
														"processing":     "Zpracovávání...",
														"search":         "Hledat:",
													},
													"paging": false,

												});
												
											});
</script>
