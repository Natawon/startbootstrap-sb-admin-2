<html>
<head>
<title></title>
</head>
<body>
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

	$strKeyword = null;

	if(isset($_POST["txtKeyword"]))
	{
		$strKeyword = $_POST["txtKeyword"];
	}
?>
<form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
  <table width="599" border="1">
    <tr>
      <th>Keyword
      <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>">
      <input type="submit" value="Search"></th>
    </tr>
  </table>
</form>

<?php

   require_once("connect.php");

	
   $sql = "SELECT * FROM projects_domain WHERE container_name LIKE '%".$strKeyword."%' ";

   $stmt = $pdo_conn->prepare($sql);
   $stmt->execute();

?>
<table width="600" border="1">
  <tr>
    <th width="91"> <div align="center">CustomerID </div></th>
    <th width="98"> <div align="center">Name </div></th>
    <th width="198"> <div align="center">ip </div></th>
    <th width="97"> <div align="center">site_url </div></th>
  
  </tr>
<?php
while($result = $stmt->fetch( PDO::FETCH_ASSOC ))
{
?>
  <tr>
    <td><div align="center"><?php echo $result["id"];?></div></td>
    <td><?php echo $result["container_name"];?></td>
    <td><?php echo $result["ip"];?></td>
    <td><div align="center"><?php echo $result["site_url"];?></div></td>
   
  </tr>
<?php
}
?>
</table>
<?php
$conn = null;
?>
</body>
</html>