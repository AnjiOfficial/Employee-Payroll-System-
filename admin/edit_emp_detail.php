<?php
include_once '../dbfiles/config.php';
$id= $_GET['id'];
$query= mysql_query("Select workers.id as id, worker_fname, worker_lname, profilepic, gross, hra, accno,basic,grade,bname,pan,mfactor from workers, worker_fixeds, worker_acc where workers.id=worker_fixeds.worker_id and workers.id=worker_acc.id and workers.id= '$id'");
$result= mysql_fetch_assoc($query);
echo'<table align="center" style="width: 30%;margin: auto;">';
echo '<tr><th>Fields</th><th>Values</th></tr><tr>';
echo '<td>Emp ID:</td>';
echo '<td><input type="hidden"  name="id" value="'.$result['id'].'"/>'.$result['id'].'</td></tr><tr>';
echo '<td>First Name:</td>';
echo '<td><input type="text"  name="fname" value="'.$result['worker_fname'].'"/></td>';
echo'</tr><tr>';
echo '<td>Last Name:</td>';
echo '<td><input type="text"  name="lname" value="'.$result['worker_lname'].'"/></td>';
echo'</tr><tr>';
echo '<td>Basic:</td>';
echo '<td><input type="text" name="basic" value="'.$result['basic'].'" /></td>';
echo'</tr><tr>';
echo '<td>Grade:</td>';
echo '<td><input type="text" name="grade" value="'.$result['grade'].'" /></td>';
echo'</tr><tr>';
echo '<td>HRA:</td>';
echo '<td><input type="text" name="hra" value="'.$result['hra'].'" /></td>';
echo'</tr><tr>';
echo '<td>Bank Account Number:</td>';
echo '<td><input type="text" name="acc" value="'.$result['accno'].'" /></td>';
echo'</tr><tr>';

echo '<td>Bank Name:</td>';
echo '<td><input type="text" name="bname" value="'.$result['bname'].'" /></td>';
echo'</tr><tr>';
echo '<td>PAN Number:</td>';
echo '<td><input type="text" name="pan" value="'.$result['pan'].'" /></td>';
echo'</tr><tr>';
echo '<td></td>';
echo '<td><input type="hidden" name="mfactor" value="'.$result['mfactor'].'" /></td>';
echo'</tr><tr>';

echo '<td>Employee Pic:</td>';
echo '<td><div id="preview">';
if($result['profilepic']==''){
    echo 'Image not in database. Please Choose a file to upload';
}
else{
    echo '<img src="uploads/'.$result['profilepic'].'" width="114px" height="114px" alt="Image is not found in folder">';
}
echo '</div><br/><input type="file" name="photoimg" id="photoimg" /></td>';
echo'</tr><tr>';
echo '<td colspan="2"><center><input type="submit" value="Update Data" onclick="return validateedit();"/></center></td>';
echo '<table>';
?>