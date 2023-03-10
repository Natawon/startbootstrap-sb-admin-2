<?php
// require('timezone.php');
require('dbconnect.php');
//error_reporting(~E_NOTICE);
function start_session()
{
	$_SESSION['user']='';
	session_start();
if(empty($_SESSION['user']))
{
	header("Location:index.php");
	exit();
	}
}
echo start_session();
function db_query()
{
	global $conn;
$stmt=$conn->prepare( "SELECT * FROM users where user_id=:uid") ;
if($stmt->execute(['uid'=>$_SESSION['user']]))
{
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$count=$stmt->rowcount();
	       }
	}
	echo db_query();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.11.1/css/all.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<style>
body{
    /* background:#F6F6F6;    */
}
#ww{
position:relative;
width:1400px;
max-width:100%;
height:350px;
bottom:30px;
}

#tt{
position:relative;
text-align: justify;
max-width:100%;
width:300px;
margin:auto;
height:auto;
right:20%;
top:190px;
height:200px;
}

	/*.avatar {
    vertical-align: middle;
    width: 50px;
    height: 50px;
    border-radius: 50%;
	float:left;
}

.avatar2 {
	position:relative;
    vertical-align: middle;
    width: 50px;
    height: 50px;
    border-radius: 50%;
	float:left;
	top:80px;
	clear:both;
	left:0.1%;
}

.avatar3 {
	position:relative;
    vertical-align: middle;
    width: 50px;
    height: 50px;
    border-radius: 50%;
	float:left;
	top:150px;
	clear:both;
	left:0.1%;
}
#asside{
position:relative;
background-color:#FFF;
box-shadow: 0 2px 10px 0 rgba(1, 1, 1, 0.2);
text-align: justify;
max-width:100%;
width:600px;
margin:auto;
height:auto;
float:left;
top:50px;
}



#side{
position:relative;
background-color:#FFF;
box-shadow: 0 2px 10px 0 rgba(1, 1, 1, 0.2);
text-align: justify;
max-width:100%;
width:800px;
margin:auto;
height:auto;
float:left;
top:10px;
left:1px;
}
*/
#aside{
position:relative;
background-color:#FFF;
box-shadow: 0 2px 10px 0 rgba(1, 1, 1, 0.2);
text-align: justify;
max-width:100%;
width:600px;
margin:auto;
height:auto;
float:left;
top:100px;
left:1px;
border-radius:5px;
box-shadow: 0 5px 10px 0 rgba(1, 1, 1, 0.2);
}
.avatar
{
	position:relative;
    vertical-align: middle;
    width: 100px;
    height:30px;
    border-radius: 90%;
	float:LEFT;
	bottom:80px;
	clear:both;
	right:130px;
	}
    table {
  border-collapse: collapse;
  width: 100%;
}
th, td {
  text-align: left;
  padding: 8px;
}
tr:nth-child(even) {background-color: #f2f2f2;}


</style>
</head>
<body>  
<nav class="navbar navbar-dark bg-dark navbar-expand">
        <!-- <a class="navbar-brand" href="#">FROG GENIUS</a> -->
        <div class="collapse navbar-collapse pl-4" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">back <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <br>

<h3 style="text-align:center;">All events</h3>
			<div class="container">
			    <div class="row">
                  <?php
                    
            $id=$_SESSION['user'];
            $query = $conn->query("SELECT * FROM projects_domain_logs ORDER BY id DESC");
            while($roww = $query->fetch())
            {
            $name = $roww['container_name'];
            $ip = $roww['ip'];
            $site_url = $roww['site_url'];
            $user_status = $roww['status'];
             ?>
        <?php
        require('connect.php');

        $query = $pdo_conn->query("SELECT * FROM projects_domain_logs ORDER BY id DESC");

        $strKeyword = null;

            //  echo '<h6>'.'<b>'.'<p class="text-primary">'.$name."  ".$roww['ip'];
            //  echo 'service'." ". $ip .'time was &nbsp;'.date("d/m/y H:i:sA",strtotime($roww['change_time']));

     if(isset($_POST["txtKeyword"]))
    { 
      $strKeyword = $_POST["txtKeyword"]; 
      $query = $pdo_conn->query("SELECT * FROM projects_domain_logs WHERE container_name LIKE '%".$strKeyword."%' ORDER BY id DESC");


    }
    // $pdo_statement = $pdo_conn->prepare($sql);
    // $pdo_statement->execute();
        ?>
        <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                                    <!-- <form action="" name='theForm' id='theform'> -->
                                            <div class="form-row">
                                                <div class="col-xl-4">

                                                    <div class="input-group mb-0">
                                                        <div class="input-group-append">
                                                            <!-- <button class="btn btn-dark px-4" type="button" name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>"><i class="fa-solid fa-magnifying-glass"></i></button> -->
                                                            <!-- <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>"> -->
                                                            <!-- <input type="text" class="form-control" name="txtKeyword" id="txtKeyword" value="<?php echo $strKeyword;?>" placeholder="Search..."> -->
                                                            <!-- <input type="text" class="form-control" name="txtKeyword" id="txtKeyword" value="<?php echo $strKeyword;?>" placeholder="Search...">

                                                            <input type="submit" class="btn btn-dark px-4" value="Search"></th> -->
                                                            <input type="text" placeholder="Search.." name="txtKeyword" value="<?php echo $strKeyword;?>">
                                                            <button type="submit"><i class="fa fa-search"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
         </form>
        
                                    <table id="data" class="table" >
                                        <thead>
                                            <tr>
                                                <th colspan="2">Events</th>
                                                <th>Monitor</th>
                                                <th>Date-Time</th>
                                                <!-- <th>Status</th> -->
                                                <th>Duration</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        // $query = $conn->query("SELECT * FROM projects_domain_logs ORDER BY id DESC");

                                        

            
                                        while($row = $query->fetch(PDO::FETCH_ASSOC))
                                         {
                                            $i++;
                                        ?>
                                        <tr>
                                                <td width="24">
                                                <?php 
                                                if($row['status']==1){
                                                    echo '<i  style="color: green !important;">UP</i>';
                                                }else{
                                                    echo '<i  style="color: red !important;">DOWN</i>';
                                                }
                                                
                                                ?>
                                                </td>
                                                <td>
                                                    <div style="color: #212529 !important;">
                                                        name : <?php echo $row['container_name'];?>
                                                    </div>
                                                    <div class="text-muted">
                                                        Container: <?php echo $row['container_name'];?>
                                                    </div>
                                                </td>
                                                 <td>                                                       
                                                    URL: <?php echo $row['site_url'];?>
                                                 </td>
                                                 <td>
                                                  <?php echo $row['change_time'];?>
                                                 </td>
                                                <!-- <td>
                                                <?php 
                                                if($row['status']==1){
                                                    echo "UP";
                                                }else{
                                                    echo "DOWN";
                                                }
                                                
                                                ?>
                                                </td> -->
                                                <td>
                                               
                                               <?php 

                                                if($row['status']==1){
                                                    $change_time1=$row['change_time'];
                                                    $now = date('Y-m-d H:i:s');
                                                    $start_date = new DateTime($change_time1);
                                                    $since_start = $start_date->diff(new DateTime($now));
                                                    echo $since_start->h.' hours'." , ";
                                                echo $since_start->i.' minutes'." , ";
                                                echo $since_start->s.' seconds';
                                                }else{
                                                    $change_time2=$row['change_time'];
                                                    $now = date('Y-m-d H:i:s');
                                                    $start_date = new DateTime($change_time2);
                                                    $since_start = $start_date->diff(new DateTime($change_time1));
                                                    echo $since_start->h.' hours'.' , ';
                                                echo $since_start->i.' minutes'.' , ';
                                                echo $since_start->s.' seconds';
                                                }
                                            //    $change_time=$row['change_time'];
                                            //    $now = date('Y-m-d H:i:s');
                                            //    $start_date = new DateTime($change_time);
                                            //    $since_start = $start_date->diff(new DateTime($now));

                                            //    echo $since_start->days.' days total<br>';
                                            //     echo $since_start->y.' years<br>';
                                            //     echo $since_start->m.' months<br>';
                                            //     echo $since_start->d.' days<br>';
                                            //     echo $since_start->h.' hours<br>';
                                            //     echo $since_start->i.' minutes<br>';
                                            //     echo $since_start->s.' seconds<br>';
                                           
                                            //    echo $row['status_time']= dateDifference($row['change_time'], date('Y-m-d H:i:s'));
                                                
                                                ?>
                                                <!-- <button type="submit" class="btn btn-primary" onclick="clicked(event)">Reload PHP</button> -->
                                                </form>

                                                </td>
                                            </tr>
                                             
                                         <?php }
                                            echo "Total :".$i;
                                         
                                         
                                         ?>

                                    </tbody>
                                 </table>
        
<br/><br/><br/>
<?php
	}
?>	
	 
	 </div>                   
	 </div>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>


<script>
 $(document).ready(function(){
    $('#data').after('<div id="nav"></div>');
    var rowsShown = 10;
    var rowsTotal = $('#data tbody tr').length;
    var numPages = rowsTotal/rowsShown;
    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nav').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
    }
    $('#data tbody tr').hide();
    $('#data tbody tr').slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');
    $('#nav a').bind('click', function(){

        $('#nav a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * rowsShown;
        var endItem = startItem + rowsShown;
        $('#data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
        css('display','table-row').animate({opacity:1}, 300);
    });
});
 </script>
</body>  
</html> 
 