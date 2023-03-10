<?php
    include_once("connect.php");


?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id

$pdo_statement = $pdo_conn->prepare("SELECT * FROM projects_domain WHERE id=:id");
$pdo_statement->execute(array(':id' => $id));

while($row = $pdo_statement->fetch(PDO::FETCH_ASSOC))
{
    $id2 = $row['id'];
	$name2 = $row['container_name'];
	$script = $row['script'];
	$ip = $row['ip'];
	$password = $row['password'];
	


}
?>

<html>
<head>	
	<title>Edit Data</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.11.1/css/all.css">

  <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  </script>

  <style>
  .input{
	background: #016ABC;
	color: #fff;
	font-size: 20px;
	border: 2px solid #eee;
	border-radius: 50px;
	box-shadow: 5px 5px 5px #eee;
	text-shadow: none;
  }
  
  </style>
</head>

<body>
	<a href="monitor3.php">Back to Homepage</a>
	<br/><br/>
	
	<form name="form1" method="post" action="runbash2.php">
		<table border="0" align="center">
			<tr> 
				<td>##</td>
				<td><input type="hidden" name="name" value="<?php echo $id2 ;?>"></td>
                <!-- <td><p><?php echo $id2 ;?></p></td> -->
			</tr>	
			<tr> 
				<td>ip</td>
				<td><input type="hidden" name="ip" value="<?php echo $ip ;?>"></td>
                <td><p><?php echo $ip ;?></p></td>
			</tr>
			<tr> 
				<td><input type="hidden" name="password" value="<?php echo $password ;?>"></td>
                <!-- <td><p><?php echo $ip ;?></p></td> -->
			</tr>
            <tr> 
				<td>Project_name</td>
				<td><input type="hidden" name="name" value="<?php echo $name;?>"></td>
                <td><p><?php echo $name2 ;?></p></td>

			</tr>
			<tr> 
				<td>Script</td>
				<td><input type="hidden" name="script" value="<?php echo $script;?>"></td>
                <!-- <td><p><?php echo $script ;?></p></td> -->

			</tr>
			<!-- <tr> 
				<td>date_expire</td>
				<td><input type="text" name="date_expire" id="datepicker" name="datepicker" value="<?php echo $date_expire;?>"></td>
			</tr> -->
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input class="input" type="submit" onclick="clicked(event)" name="update" value="Reload" ></td>
			</tr>
		</table>
	</form>

	<script>
function clicked(e)
{
    if(!confirm('Do you want to Reload')) {
        e.preventDefault();
    }
}
</script>		

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	$( function() {
	  $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	} );
	</script>
</body>
</html>
