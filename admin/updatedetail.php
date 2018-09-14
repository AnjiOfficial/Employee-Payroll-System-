<?php
session_start();
include "../dbfiles/config.php";
if($_SESSION['user']!='admin'){header('location:../checklogin/error.php');}
class updatabase{
	 private $total= array();
    private $workdays;
    private $hra;
    private $pf;
    private $esi;
    private $adv;
    private $id;
    private $month;
    private $year;
    private $query;
	
    public function updetail($rate,$i, $w, $h, $p, $e, $a,$hrad,$watercharges,$electricity,$gpf,$gis,$npsec1,$npsec0,$tds,$special,$mis,$pen){
		
		$this->rate= $rate;
        $this->id= $i;
        $this->workdays= $w;
        $this->hra= $h;
        $this->pf= $p;
        $this->esi= $e;
        $this->adv= $a;
		$this->hrad=$hrad;
		$this->watercharges=$watercharges;
		$this->electricity=$electricity;
		 $this->gpf= $gpf;
		 $this->gis= $gis;
		$this->npsec1= $npsec1;
			$this->npsec0= $npsec0;
		$this->tds= $tds;
		$this->pension= $pen;
		$this->special= $special;
		$this->miscellaneous= $mis;
        $this->month= date('n')-1;
        $this->year= date('Y');
		
		 $this->nett=    ($p+$e+$a +($rate)*($w)) -($hrad+$watercharges+$electricity+$gpf+$gis+$npsec0+$npsec0+$pen+$special+$mis
												   +$tds);
		
		
        $this->query= mysql_query("Update worker_varys, worker_fixeds SET hra='$this->hra', workdays='$this->workdays', CC='$this->pf', npscurrent='$this->esi', npsprevious='$this->adv',hrad='$this->hrad',watercharges='$this->watercharges',electricity='$this->electricity',gpf= '$this->gpf', gis= '$this->gis',NPSEC1= '$this->npsec1',NPSEC0= '$this->npsec0',TDS='$this->tds',Special='$this->special',Miscellaneous='$this->miscellaneous',Pension='$this->pension',nett=' $this->nett' where worker_varys.id=worker_fixeds.worker_id and id='$this->id' and month='$this->month' and year='$this->year'");
		
		
		
		
        if(!$this->query){
        header('location:qerror.php?op=updaatabase');
        }
        else{
            echo "<script>alert('You are now directed to updation page');
window.location= 'updatesheet.php';

</script>";
        }
    }
}
$updb= new updatabase();
$updb->updetail($rate=$_POST['rate'],$i=$_POST['id'], $w=$_POST['workday'], $h=$_POST['hra'], $p=$_POST['CC'], $e=$_POST['npscurrent'], $a=$_POST['npsprevious'],$hrad=$_POST['hrad'],$watercharges=$_POST['watercharges'],$electricity=$_POST['electricity'],$gpf=$_POST['gpf'],$gis=$_POST['gis'],$npsec1=$_POST['npsec1'],$npsec0=$_POST['npsec0'],$tds=$_POST['tds'],$special=$_POST['special'],$mis=$_POST['miscellaneous'],$pen=$_POST['pension']);

?>