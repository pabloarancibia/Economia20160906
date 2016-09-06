<?php
session_start(); 
if(isset($_POST['bp']))
{
 $bsprod=$_POST['bsprod'];
 $_SESSION['razon'] = $bsprod; 
}
if(isset($_POST['bpr']))
{
 $nroprovd=$_POST['nroprovd'];
 $nroprovh=$_POST['nroprovh'];
 $_SESSION['nroprovd']=$nroprovd;
 $_SESSION['nroprovh']=$nroprovh;
 
}

header("Location: ../views/frmLDP.php");
 
?>