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
                                <h2><span>Add New Employee</span></h2>
                                <?php
                                include_once '../dbfiles/config.php';
                                ?>
                                <form name="add_emp" method="post" enctype="multipart/form-data" action="add_emp.php">
                                    <table style="width: 50%;margin: auto;">
                                        <tr>
                                            <th colspan="2">
                                               Select the Day of Rest for Each Employee
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                Employee Id's
                                            </td>
                                            <td>
                                                <?php $query= mysql_query("SELECT max(id) as id from workers");
                                                $result= mysql_fetch_array($query);
                                                ?>
                                                <input type="hidden" name="emp_id" value="<?php echo $result['id']+1; ?>"/>
                                                <?php echo $result['id']+1;?>
                                            </td>
                                        </tr>  
                                        <tr>
                                            <td>
                                                Employee First Name:
                                            </td>
                                            <td>
                                                <input type="text" name="fname" value=""/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Employee Last Name:
                                            </td>
                                            <td>
                                                <input type="text" name="lname" value=""/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Enter Basic:
                                            </td>
                                            <td>
                                                <input type="text" name="basic" value=""/>
                                            </td>
                                        </tr>
										  <tr>
                                            <td>
                                                Enter Grade:
                                            </td>
                                            <td>
                                                <input readonly="value" name="grade" value="0"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Enter HRA:
                                            </td>
                                            <td>
                                                <input type="text" name="hra" value=""/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Enter Employee Bank A/C No:
                                            </td>
                                            <td>
                                                <input type="text" name="acc" value=""/>
                                            </td>
                                        </tr>
										
										 <tr>
                                            <td>
                                                Enter Employee Bank Name:
                                            </td>
                                            <td>
                                                <input type="text" name="bname" value=""/>
                                            </td>
                                        </tr>
										
										 <tr>
                                            <td>
                                                Enter Employee PAN No:
                                            </td>
                                            <td>
                                                <input type="text" name="pan" value=""/>
                                            </td>
                                        </tr>
										
										
										
										
										
										
										
                                        <tr>
                                            <td>
                                                Upload Image
                                            </td>
											
                                            <td>
                                                <input type="file" name="photoimg" id="photoimg" />
                                            </td>
                                        </tr>
										
										<tr>
                                            <td>
                                              Employee's Category:
                                            </td>
											<td>
                                            <input readonly="value" name="cat" value="STAFF"/>
											</td>
                                        </tr>
										
											
										<tr>
                                            <td></td>
											<td>
                                            <input type="hidden" name="dac" value="0.05"/>
											</td>
                                        </tr>
										
										
										
										
										
                                    </table>
                                    <center><input type="submit" value="Add Employee" name="submit" onclick="return validateForm();"/></center>
                                </form>
                                <br/>
                                
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
