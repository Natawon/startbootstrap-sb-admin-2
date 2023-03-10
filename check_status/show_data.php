<?php
session_start();
echo '
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
//เช็คว่ามีตัวแปร session อะไรบ้าง
//print_r($_SESSION);
//exit();
//สร้างเงื่อนไขตรวจสอบสิทธิ์การเข้าใช้งานจาก session
if(empty($_SESSION['id']) && empty($_SESSION['name']) && empty($_SESSION['surname'])){
            echo '<script>
                setTimeout(function() {
                swal({
                title: "คุณไม่มีสิทธิ์ใช้งานหน้านี้",
                type: "error"
                }, function() {
                window.location = "../login.php"; //หน้าที่ต้องการให้กระโดดไป
                });
                }, 1000);
                </script>';
            exit();
}
?>
<?php
//getting id from url
include_once("connect.php");

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
    $url = $row['check_url'];

	


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand">
        <!-- <a class="navbar-brand" href="#">FROG GENIUS</a> -->
        <div class="collapse navbar-collapse pl-4" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../check_status/monitor3.php">Back <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
<!-- <a href="../check_status/monitor3.php">Back to Homepage</a> -->

<div class="container">
<div class="shadow-lg p-3 mb-5 bg-white rounded">
  <h2>INFO</h2>
  <p>Data to webserver </p>
  <form action="../check_status/runbash2.php" method="post" class="was-validated">
  <div class="container">
  <div class="row">
    <div class="col-sm">
        <input type="hidden" class="form-control" id="ip"  name="ip" value="<?php echo $ip ;?>"><p>IP: <?php echo $ip ;?></p>
        <input type="hidden" class="form-control" id="password"  name="password" value="<?php echo $password ;?>">

    </div>
    <div class="col-sm">
        <input type="hidden" class="form-control" id="script"  name="script" value="<?php echo $script ;?>"><p>Project_name: <?php echo $name2;?></p>
        <input type="hidden" class="form-control" id="name"  name="name" value="<?php echo $name2 ;?>">   
        <input type="hidden" class="form-control" id="url"  name="url" value="<?php echo $url ;?>">
    </div>
    <div class="col-sm">
    <button type="submit" class="btn btn-primary" onclick="clicked(event)">Reload PHP</button>

    </div>
  </div>
</div>

     <!-- <div class="col-sm-4" style="background-color:#999999; color:white;"><input type="hidden" class="form-control" id="ip"  name="ip" value="<?php echo $ip ;?>"><p>IP: <?php echo $ip ;?></p></div>
     <div class="col-md-4" style="background-color:#999999;color:white"><input type="hidden" class="form-control" id="script"  name="script" value="<?php echo $script ;?>"><p>Project_name: <?php echo $name2;?></p></div>
     <div class="col-sm-4" style="background-color:#999999; color:white;"><input type="hidden" class="form-control" id="password"  name="password" value="<?php echo $password ;?>"></div>
     <div class="col-sm-4" style="background-color:#999999; color:white;"><input type="hidden" class="form-control" id="name"  name="name" value="<?php echo $name2 ;?>"></div>
     <div class="col-md-4" style="background-color:#999999; color:white;"><input type="hidden" class="form-control" id="url"  name="url" value="<?php echo $url ;?>"></div>
    <button type="submit" class="btn btn-primary" onclick="clicked(event)">Reload PHP</button> -->
   

  </form>
  </div>
</div>


<script>
function clicked(e)
{
    if(!confirm('Do you want to Reload')) {
        e.preventDefault();
    }
}
</script>	


</body>
</html>
