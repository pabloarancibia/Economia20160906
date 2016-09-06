<?php
session_start(); 
if(isset($_POST['bp']))
{
 $bsprod=$_POST['bsprod'];
 $_SESSION['razon'] = $bsprod; 
}
if(isset($_POST['bf']))
{
 $bddesde=$_POST['bddesde'];
 $bdhasta=$_POST['bdhasta'];
 $_SESSION['bddesde']=$bddesde;
 $_SESSION['bdhasta']=$bdhasta;

}
if(isset($_POST['bfp']))
{
 $nroformd=$_POST['nroformd'];
 $nroformh=$_POST['nroformh'];
 $_SESSION['nroformd']=$nroformd;
 $_SESSION['nroformh']=$nroformh;
}
if(isset($_POST['bpr']))
{
 $nroprovd=$_POST['nroprovd'];
 $nroprovh=$_POST['nroprovh'];
 $_SESSION['nroprovd']=$nroprovd;
 $_SESSION['nroprovh']=$nroprovh;
 
}

header("Location: ../views/frmMPP.php");
 
?>