<?php
include "../dbfiles/config.php";
session_start();
if($_SESSION['user']!='admin'){header('location:../checklogin/error.php');}
function insertsalarydetail(){
	  $result= array();
    $cc= $_POST['cc'];
	$fname= $_POST['fname'];
	$lname= $_POST['lname'];
    $esi= $_POST['nps1'];
    $adv= $_POST['nps0'];
    $id= $_POST['id'];
    $rate= $_POST['rate'];
	$hrad=$_POST['hrad'];
	$watercharges=$_POST['watercharges'];
	$electricity=$_POST['electricity'];
	$gpf=$_POST['gpf'];
	$gis=$_POST['gis'];
	$npsec1=$_POST['npsec1'];
	$npsec0=$_POST['npsec0'];
	$tds=$_POST['tds'];
	$miscellaneous=$_POST['miscellaneous'];
	$special=$_POST['special'];
	$pension=$_POST['pension'];
    $i=0;
    foreach ($_POST['workdays'] as $workday){
        if($workday=='' || $cc[$i]=='' || $esi[$i]=='' || $adv[$i]==''){
            echo "<script>alert('You have to pay for this');window.location = 'newsheet.php';</script>";
        }
        $i=$i+1;
    }
    $i=0;
    $m= date('n')-1;
    $y= date('Y');
	$total[1]=0;
	 $total[2]=0;
	$total[3]=0;
	$total[4]=0;
    foreach ($_POST['workdays'] as $workday){
		$total[1]=sprintf('%.2f',($rate[$i])*($workday));
		 $total[2]=$cc[$i]+$esi[$i]+$adv[$i]+$total[1];
         $total[3]=$hrad[$i]+$watercharges[$i]+$electricity[$i]+$gpf[$i]+$gis[$i]+$npsec1[$i]+$npsec0[$i]+$tds[$i]+$miscellaneous[$i]+$special[$i]+$pension[$i];	
		$total[4]= $total[2]-$total[3];
    $query=mysql_query("Insert into worker_varys (id,fname,lname, rate, workdays, CC, npscurrent, npsprevious, month, year,hrad,watercharges,electricity,gpf,gis,NPSEC1,NPSEC0,TDS,Miscellaneous,Special,Pension,nett) values ('$id[$i]','$fname[$i]','$lname[$i]', '$rate[$i]', '$workday', '$cc[$i]', '$esi[$i]', '$adv[$i]', '$m', '$y','$hrad[$i]','$watercharges[$i]','$electricity[$i]','$gpf[$i]','$gis[$i]','$npsec1[$i]','$npsec0[$i]','$tds[$i]','$miscellaneous[$i]','$special[$i]','$pension[$i]','$total[4]')");
		
		
    $i=$i+1;
}
if(!$query){
    header('location:qerror.php?op=enterdata');
}
else{
    echo "<script>alert('Data has been entered and you are now being redirected to Home Page');
    window.location= 'adminhome.php';
</script>";
}
}
insertsalarydetail();
?>