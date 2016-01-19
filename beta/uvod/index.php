<?php
session_start();
date_default_timezone_set("Europe/Prague");
include "../include/check.php";
$nastenka_a="active";
include "../include/body.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Nástěnka
    </h1>
    <ol class="breadcrumb">
      <li><a href="./"><i class="fa fa-home"></i>Domů</a></li>
    </ol>

  </section>

  <!-- Main content -->
  <section class="content" >



<!-- Main content -->
<? if($_SESSION["ecz"]<3){}; ?>

<div class="box box-solid box-primary ">
  <div class="box-header with-border">
    <h3 class="box-title">Vítejte!</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <h4><b>Vítám Vás na ještě se rozvíjejících stránkách našeho klanu.</b></h4> <br>Účelem tohoto webu je lepší morální i fyzická stabilita klanu, spočívající na kontrole aktivity našich hráčů ve hře Ghost Recon Phantoms. 
    Náš klan je svou dlouhou tradicí spojován s výbornou hráčskou aktivitou a skvělým výběrem hráčské komunity, čili tímto krokem zaregistrovat se na této stránce vytvořené <i>MasteremPK</i> ještě více pomůžete k lepším výsledkům.
    <br>Každý z nás nyní může cítít, že náš klan prolétá i díky hře a stále zmenšující se hráčské platformě, hlavně u české a slovenské populace samotné, menšími „turbulencemi“, ale pevně věřím, že po Novém roce se vše 
    i díky Vám obrátí k lepšímu.<br><br>
    <i>Jménem představenstva klanu Paul Oneil</i>
  </div><!-- /.box-body -->
</div><!-- /.box -->

<div class="box box-solid box-primary ">
  <div class="box-header with-border">
    <h3 class="box-title">Novinky</h3>
  </div>
  <div class="box-body">
    <!-- box novinky -->
   <div class="box box-info ">
    <div class="box-header with-border">
      <h3 class="box-title">Aktualizace na verzi 1.1</h3>
    </div>
    <div class="box-body with-border">
      <b>Výpis hlavních změn:</b>
      <ul>
        <li>Zobrazení celkového počtu dnů existence klanu</li>
        <li>Úpravy celkového vzhledu</li>
        <li>Nová tabulku členů v pokročilém výpisu</li>
        <li>Kompletně předělané rozvržení stránky <i>Profil</i> a <i>Úprava uživatele</i></li>
        <li>Nová sekce <i>Informace pro správce</i></li>
        <li>Nová správa aktivity uživatelů</li>
        <li><b>Optimalizace výkonu</b></li>
        <li><b>Opravy chyb</b></li>
        <li>Nový systém statistik</li>
      </ul>
    </div>
  </div>
  <!-- box novinky konec-->
</div> 

</div>


  </section>
  </div>









<?
include "../include/footer.php";
  
  
  ?>