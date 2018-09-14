<?php
session_start();
if($_SESSION['user']!='admin') {
    header('location:../checklogin/error.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>BUAT</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link href="tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
        <script type="text/javascript" src="tablecloth/tablecloth.js"></script>
        <script type="text/javascript" src="scripts/validate.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/coin-slider.css" />
        <link rel="stylesheet" type="text/css" href="../css/superfish.css" media="screen" />
        <script type="text/javascript" src="../js/menu.js"></script>
		
        <script type="text/javascript" src="../js/footer.js"></script>
        <script type="text/javascript" src="../js/sidebar.js"></script>
        <script type="text/javascript" src="../js/cufon-yui.js"></script>
        <script type="text/javascript" src="../js/cufon-quicksand.js"></script>
        <script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
        <script type="text/javascript" src="../js/coin-slider.min.js"></script>
        <script type="text/javascript" src="../js/hoverIntent.js"></script>
        <script type="text/javascript" src="../js/superfish.js"></script>
        <script type="text/javascript">

            // initialise plugins
            jQuery(function(){
                jQuery('ul.sf-menu').superfish();
            });

        </script>
    </head>
    <body>
        <div class="main">
            <div class="header">
                <div class="header_resize">
                    <div class="logo">
                        <h1><a href="adminhome.php"></a></h1>
                    </div>

                    <div class="clr"></div>
                    <script type="text/javascript">menue();</script>
					
                    <br/>
                    <div class="clr"></div>

                </div>
                <div class="content">
                    <div class="content_resize">
                        <div class="mainbar">
                            <div class="article">
                                <br />
                                <span style="float: left;"><a href="javascript:history.go(-1)"><img src="../images/back.png" width="30px" height="30px" alt="BACK" title="Back"></img></a></span>
                                <span style="float: right;"><a href="adminhome.php">Home<img src="../images/home.png" width="30px" height="30px"></img></a></span>
                                <br />
                                <h2><span>SELECT THE CATEGORY OF EMPLOYEE</span></h2>
                                <?php
                                include_once '../dbfiles/config.php';
                                ?>
						
						 <form >
                                    <table style="width: 100%;margin-top:10px ;">
                                        <tr>
                                           <td>
                                            <select name="forma" onchange="location = this.value;">
												<option value=" ">SELECT CATEGORY OF EMPLOYEE</option>
                                            <option value="os.php" name ="staff">STAFF</option>
                                           <option value="off.php">OFFICER</option>
                                            <option value="fac.php">FACULTY</option>
                                          </select>
						 </td>
                                        </tr>
						
						              </table>
                                   
                                        </form>
                   
                            </div>
                        </div>

                        <div class="clr"></div>
                    </div>
                </div><br />
                <div id="disclaimer">
                    <script type="text/javascript">footere();</script>
                </div>
            </div>
        </div>
    </body>
</html>
