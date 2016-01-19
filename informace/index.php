<?php
session_start();
date_default_timezone_set("Europe/Prague");
include "../include/check.php";
$informace_levemenu="active";
include "../include/body.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Informace <small>stav serveru</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="./"><i class="fa fa-home"></i>Domů</a></li>
			<li>Informace</li>
		</ol>

	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-md-4">
				<div class="box box-primary" >
					<div class="box-header with-border">
						<h3 class="box-title">Statistiky návštěvnosti</h3>
						<div class="box-tools pull-right">
							<!-- Buttons, labels, and many other things can be placed here! -->
							<!-- Here is a label for example -->
							<span class="label label-warning"></span>
						</div><!-- /.box-tools -->
					</div><!-- /.box-header -->
					<div class="box-body">
						<a href="http://www.toplist.cz/stat/1709478" target="_BLANK">
							<button class="btn btn-primary btn-flat btn-block">Zobrazení statistik</button><br>
						</a>
					</div><!-- /.box-body -->

				</div>

			</div>
			<div class="col-md-4" >
				<div class="box box-primary" >
					<div class="box-header with-border">
						<h3 class="box-title">Stav databáze</h3>
						<div class="box-tools pull-right">
							<?
							$velikost = $mysqli->query("
								SELECT table_schema                                        'DB Name', 
								Round(Sum(data_length + index_length) / 1024, 1) 'DB Size in KB' 
								FROM   information_schema.tables 
								GROUP  BY table_schema; ");
							$velikost = $velikost->fetch_assoc();

							?>
							<span class="label label-warning"></span>
						</div><!-- /.box-tools -->
					</div><!-- /.box-header -->
					<div class="box-body">
						Název datábaze: <strong><? echo $velikost["DB Name"]; ?></strong><br>
						Velikost databáze v KB: <strong><? echo $velikost["DB Size in KB"]; ?></strong><br>
						Velikost databáze v MB: <strong><? echo round($velikost["DB Size in KB"]/1024,2); ?></strong><br>
					</div><!-- /.box-body -->

				</div>

			</div>
		</div>
	</section>
</div>	

	<?
	include "../include/footer.php";

	?>