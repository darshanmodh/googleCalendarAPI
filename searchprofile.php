<?php
include('connection.php');
?>
<html>
<head>
<script>
	function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
      }	//onlyAlphabets() is finished
</script>
</head>
<body>
<?php
session_start();
include("connection.php");
include("header.php"); 
?>
 <h2>Search Member</h2>
  <table width="428" border="0" align="center">
  <form action="#" method="post">
  <tr>
    <th width="150" height="35" scope="col"><label>Username </label></th>
    <th width="262" scope="col"><div align="left"><input id="uname" name="uname" type="text" /></div></th>
    </tr>
     <tr>
    <th width="150" height="35" scope="col"><label>First Name</label></th>
    <th width="262" scope="col"><div align="left"><input id="fname" name="fname" type="text" onKeyPress="return onlyAlphabets(event,this);" /> </div></th>
    </tr>
    <tr>
<th width="150" height="35" scope="col"><label>Last Name</label></th>
    <th width="262" scope="col"><div align="left"><input id="lname" name="lname" type="text" onKeyPress="return onlyAlphabets(event,this);"/> </div></th>
    </tr>
            <tr>
<th width="150" height="35" scope="col"><label>Email</label></th>
    <th width="262" scope="col"><div align="left"> <input id="email" name="email" type="email" /></div></th>
    </tr>
		   <tr width="262"><th colspan="2"><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input id="submit" type="submit"  value="View Records" name="search" /></th>
    </tr>
  </form>
  </table>
  
  
<?php 

if(isset($_SESSION["uid"]))
{	
		if(isset($_POST["search"]))
	{
		$result = mysql_query("SELECT * FROM reg where 
		uname='$_POST[uname]' || fname='$_POST[fname]' || lname='$_POST[lname]' || email='$_POST[email]'");
	 
if(mysql_num_rows($result) >= 1)
{
	?>
    <h2>Member Details</h2>
    <div id="table-data" style="clear:both; text-align:center;">
    <table width="70%" border="1" align="center">
      <tr>
        <td><strong>SR NO</strong></td>
        <td><strong>UID</strong></td>
        <td><strong>Username</strong></td>
        <td><strong>Name</strong></td>
        <td><strong>Date of birth</strong></td>
     <?php
	 if($_SESSION["type"]=="admin")
	 {
		?>
        	<td><strong>Action</strong></td>
        <?php
	 }
	 ?>
     	</tr>
      <?php
		$i = 1;
  while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>&nbsp;"  . $i . "</td>";
  echo "<td>&nbsp;"  . $row['uid'] . "</td>";
  echo "<td>&nbsp;" . $row['uname'] . "</td>";
  echo "<td>&nbsp;" . $row['fname'] . " " . $row['lname'] . "</td>";
  echo "<td>&nbsp;" . $row['bday'] . "</td>";
	 
  if($_SESSION["type"]=="admin")
  {
	  ?>
	      <td><a href="#" onClick="opennewsletter('viewprofile.php?uid=<?php echo $row['uid']; ?>','View Profile');"><img src='images/view.png' width='32' height='32' /></a>
		   <a href="#" onClick="opennewsletter('editprofile.php?uid=<?php echo $row['uid']; ?>','Edit Profile');"><img src='images/edit.png' width='32' height='32' /></a>
		   <a href='admin.php?uid=$row[uid]&view=delete'><img src='images/delete.png' width='32' height='32' onclick='return confirm('Are you sure??')'/></a></td>
		<?php
  }
  echo "</tr>&nbsp;";
 $i++;
  } //while records are available
    echo "</table>";
      
}
else
{
	echo "<h2>No Records Found...</h2>";
}
	}//if search is clicked
}//if(isset($_SESSION["uid"]))
?>
</body>
</html>
