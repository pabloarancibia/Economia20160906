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
 $aleatoriod=$_POST['aleatoriod'];
 $aleatorioh=$_POST['aleatorioh'];
 $_SESSION['aleatoriod']=$aleatoriod;
 $_SESSION['aleatorioh']=$aleatorioh;
}
if(isset($_POST['bpr']))
{
 $nroprovd=$_POST['nroprovd'];
 $nroprovh=$_POST['nroprovh'];
 $_SESSION['nroprovd']=$nroprovd;
 $_SESSION['nroprovh']=$nroprovh;
 
}
if(isset($_POST['bOC']))
{
 $nocd=$_POST['nocd'];
 $noch=$_POST['noch'];
 $_SESSION['nocd']=$nocd;
 $_SESSION['noch']=$noch;
 }
if(isset($_POST['bPM']))
{
 $npmd=$_POST['npmd'];
 $npmh=$_POST['npmh'];
 $_SESSION['npmd']=$npmd;
 $_SESSION['npmh']=$npmh;
 } 

header("Location: ../views/frmViewConGestCom.php");
 
?>