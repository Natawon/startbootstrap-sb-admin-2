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
	 header("Location:login.php");
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

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin  - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0" href="styles/shards-dashboards.1.1.0.min.css">
        <link rel="stylesheet" href="styles/extras.1.1.0.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
    .caption {
        font-size: 0.75rem;
        line-height: 1.25rem;
        letter-spacing: 0.0333333333em;
    }
    .stretched-link::after {
    position: absolute;
    inset: 0px;
    z-index: 1;
    content: "";
}
    
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">FGN Admin <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Interface
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li> -->

            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->

            <!-- Nav Item - server -->
            <li class="nav-item">
                <a class="nav-link" href="server.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Server DO</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link" href="charts.php">
                <i class="fas fa-fw fa-chart-area"></i>

                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php

                            $id=$_SESSION['user'];
                            $query = $conn->query("SELECT * FROM users inner join activity on users.user_id=activity.user_id where users.user_id='$id' limit 1");
                            while($roww = $query->fetch())
                            {
                            $user_id = $roww['user_id'];
                            $user_status = $roww['user_status'];
                            $name = $roww['name'];
                            // echo $name;

                        ?>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $name;?></span>
                        <?php
                            }
                        ?>	
                                <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['name'].' '.$_SESSION['surname'];?></span> -->
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="activity.php">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <?php
                    
                    $sql = "SELECT * FROM digitalocean order by id DESC limit 1 ";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();                
                    $data = [];

                    while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {          
                        $data[] = $row2;  
                    } 

                     $response         = [];
                     $response['data'] =  $data;

                    // echo json_encode($response, JSON_PRETTY_PRINT);

                    $sql_total = "SELECT * FROM digitalocean";
                    $stmt_total = $conn->prepare($sql_total);
                    $stmt_total->execute();                
                    $data_total = [];

                    while ($row_total = $stmt_total->fetch(PDO::FETCH_ASSOC)) {          
                        $data_total[] = $row_total;  
                    } 

                     $response2        = [];
                     $response2['data'] =  $data_total;
                          
                ?>
                <?php
                    
                    $sql2 = "SELECT * FROM bandwidth order by id DESC limit 1 ";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->execute();                
                    

                    $sql_total2 = "SELECT * FROM bandwidth";
                    $stmt_total2 = $conn->prepare($sql_total2);
                    $stmt_total2->execute();                
                    $data_total2 = [];

                    while ($row_total2 = $stmt_total2->fetch(PDO::FETCH_ASSOC)) {          
                        $data_total2[] = $row_total2;  
                    } 

                     $response3        = [];
                     $response3['data'] =  $data_total2;


                    $sql3 = "SELECT * FROM aws order by id DESC limit 1 ";
                    $stmt3 = $conn->prepare($sql3);
                    $stmt3->execute();                
                    

                    $sql_total3 = "SELECT * FROM aws";
                    $stmt_total3 = $conn->prepare($sql_total3);
                    $stmt_total3->execute();                
                    $data_total3 = [];

                    while ($row_total3 = $stmt_total3->fetch(PDO::FETCH_ASSOC)) {          
                        $data_total3[] = $row_total3;  
                    } 

                     $response4        = [];
                     $response4['data'] =  $data_total3;
                          
                ?>

                <!-- End of Topbar -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                    <div class="col-lg col-md-6 col-sm-6 mb-4">
                        <div class="stats-small stats-small--1 card card-small">
                        <div class="card-body p-0 d-flex">
                            <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Digitalocean</span>
                                 
                                <?php 
                                                foreach ($data as $key => $row) 
                                                {
            
                                                ?>
                                            <div><h6 class="stats-small__value count my-3">$ <?php echo $row['costs'];?></h6></div>
                                                <?php }                                                    
                                                ?>
                                                <?php 
                                                $sum =0 ;
                                                $last_index = count($data_total) - 2;

                                                // echo json_encode($data, JSON_PRETTY_PRINT);  
                                                foreach ($data_total as $key => $row_totals) 
                                                {
                                                    
                                                    // $sum +=$row_totals['costs'];
                                                    $last_data = end($row_totals);
                                                    // $before_last_key = prev($row_totals);
                                                    if ($key === $last_index) {
                                                        $a = $row_totals['costs'];
                                                        // echo $a;
                                                        $b = $last_data;
                                                        // echo $b;

                                                        $percentage = ($a / $b) * 100;
                                                        // echo"<div class='caption fw-500 me-2'><i class='fa fa-arrow-up'></i>$percentage%  from last month</div>";
                                                    }
                                                    
                                                    $sum += $row_totals['costs'];

                                                    // echo $lastElement;

                                                    // echo $last_data."\n";
                                                    // echo $last_value."\n";

                                                ?>
                                                <?php
                                                }
                                            ?>
                                            <?php
                                            // echo $a;
                                            // echo $last_data;
                                            $percentage = (($last_data - $a) / $a) * 100;
                                            ?>
                                             
                                <!-- <h6 class="stats-small__value count my-3">2,390</h6> -->
                            </div>
                            <div class="stats-small__data">
                                <?php
                                if(round($percentage,2) >= 0){
                                    echo"<span class='stats-small__percentage stats-small__percentage--increase'>".round($percentage,2)."%  from last month"."</span>";
                                }else{
                                    echo"<span class='stats-small__percentage stats-small__percentage--decrease'>".round($percentage,2)."%  from last month"."</span>"; 
                                }
                                // <span class="stats-small__percentage stats-small__percentage--decrease">4.7%</span>
                                ?>
                            </div>
                            </div>
                            <?php
                               if(round($percentage,2) >= 0){
                                echo "<canvas height='120' class='blog-overview-stats-small-1'></canvas>";
                               }else{
                                echo "<canvas height='120' class='blog-overview-stats-small-3'></canvas>";
                               }
                            ?>
                        </div>
                        </div>
                    </div>
                        
                    
                    <div class="col-lg col-md-6 col-sm-6 mb-4">
                        <div class="stats-small stats-small--1 card card-small">
                        <div class="card-body p-0 d-flex">
                            <div class="d-flex flex-column m-auto">
                            <div class="stats-small__data text-center">
                                <span class="stats-small__label text-uppercase">Digitalocean</span>
                                 
                                <?php 
                                                foreach ($data as $key => $row) 
                                                {
            
                                                ?>
                                            <div><h6 class="stats-small__value count my-3"><?php echo "35";?></h6></div>
                                                <?php }                                                    
                                                ?>
                                                <?php 
                                                $sum =0 ;
                                                $last_index = count($data_total) - 2;

                                                // echo json_encode($data, JSON_PRETTY_PRINT);  
                                                foreach ($data_total as $key => $row_totals) 
                                                {
                                                    
                                                    // $sum +=$row_totals['costs'];
                                                    $last_data = end($row_totals);
                                                    // $before_last_key = prev($row_totals);
                                                    if ($key === $last_index) {
                                                        $a = $row_totals['costs'];
                                                        // echo $a;
                                                        $b = $last_data;
                                                        // echo $b;

                                                        $percentage = ($a / $b) * 100;
                                                        // echo"<div class='caption fw-500 me-2'><i class='fa fa-arrow-up'></i>$percentage%  from last month</div>";
                                                    }
                                                    
                                                    $sum += $row_totals['costs'];

                                                    // echo $lastElement;

                                                    // echo $last_data."\n";
                                                    // echo $last_value."\n";

                                                ?>
                                                <?php
                                                }
                                            ?>
                                            <?php
                                            // echo $a;
                                            // echo $last_data;
                                            $percentage = (($last_data - $a) / $a) * 100;
                                            ?>
                                             
                                <!-- <h6 class="stats-small__value count my-3">2,390</h6> -->
                            </div>
                            <div class="stats-small__data">
                              <span style="text-align:center; font-size:0.7em;">Droplet</span>

                            </div>
                            </div>
                            <?php
                               if(round($percentage,2) >= 0){
                                echo "<canvas height='120' class='blog-overview-stats-small-1'></canvas>";
                               }else{
                                echo "<canvas height='120' class='blog-overview-stats-small-2'></canvas>";
                               }
                            ?>
                        </div>
                        </div>
                    </div>
                        

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Bandwidth (Month)
                                            </div>
                                            <?php 
                                                foreach ($stmt2 as $key2 => $row2) 
                                                {
            
                                                ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo $row2['usage'];?> TB</div>
                                                <?php }                                                    
                                                ?>
                                                <?php 
                                                $sum2 =0 ;
                                                $last_index2 = count($data_total2) - 2;
                                                    // print_r($stmt2);
                                                // echo json_encode($data, JSON_PRETTY_PRINT);  
                                                foreach ($data_total2 as $key => $row_totals2) 
                                                {
                                                    
                                                    // $sum +=$row_totals['costs'];
                                                    $last_data2 = end($row_totals2);
                                                    // echo $last_data2;
                                                    // $before_last_key = prev($row_totals);
                                                    if ($key === $last_index2) {
                                                        $a2 = $row_totals2['usage'];
                                                        // echo $a;
                                                        $b2 = $last_data2;
                                                        // echo $b;

                                                        $percentage2 = ($a2 / $b2) * 100;
                                                        
                                                        // echo"<div class='caption fw-500 me-2'><i class='fa fa-arrow-up'></i>$percentage%  from last month</div>";
                                                    }
                                                    $sum2 += $row_totals2['usage'];

                                                    // echo $sum2;

                                                    // echo $last_data."\n";
                                                    // echo $last_value."\n";

                                                ?>
                                                <?php
                                                }
                                            ?>
                                            <?php
                                            // echo $a;
                                            // echo $last_data;
                                            $percentage2 = (($last_data2 - $a2) / $a2) * 100;
                                            ?>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <!-- <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">40.1TB</div> -->
                                                    <?php
                                                       if(round($percentage2,2) >= 0)
                                                       {
                                                       echo" <div style='color:green' class='caption fw-500 me-2'><i class='fa fa-arrow-up'></i> ". round($percentage2,2)." %  from last month</div>";
                                                       }else{
                                                        echo" <div style='color:red' class='caption fw-500 me-2'><i class='fa fa-arrow-down'></i> ". round($percentage2,2)." %  from last month</div>";
                                                       }
                                                    ?>
                                                </div>
                                                <div class="col">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-file fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                            Bandwidth (Annual)</div>
                                            
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo $sum2;?> TB</div>
                                            <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">100TB</div> -->
                                            <!-- <div class="caption fw-500 me-2"><i class="fa fa-arrow-up"></i><?php echo round($percentage2,2);?>%  from last month</div> -->
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                            <i class="fas fa-tachometer-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Digitalocean Price Chart</h1>
                    <p class="mb-4">The cost of a DigitalOcean server. <a
                            target="_blank" href="https://cloud.digitalocean.com/account/billing?i=e8818d">digitalocean billing</a>.</p>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-8 col-lg-7">

                            <!-- Area Chart -->
                            <!-- <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>
                                    Styling for the area chart can be found in the
                                    <code>/js/demo/chart-area-demo.js</code> file.
                                </div>
                            </div> -->

                            <!-- Bar Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cost - list</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                    <hr>
                                    <!-- Styling for the bar chart can be found in the
                                    <code>/js/demo/chart-bar-demo.js</code> file. -->
                                </div>
                            </div>

                            <?php
                                            $total_transcode1 =16500000;
                                            $current_progress = 14277410.82;
                                            $percent = ($current_progress / $total_transcode1) * 100;
                                            $result= round($percent,2);
                                            $tb = $current_progress / 1048576; // convert to terabytes
                                            $formatted_tb = number_format($tb, 2); // format to 2 decimal places
                                            // echo $formatted_tb; // output the formatted result
                                            $tb_total = $total_transcode1 / 1048576; // convert to terabytes
                                            $formatted_tb_total = number_format($tb_total, 2); // format to 2 decimal places
                                            // echo $formatted_tb_total; // output the formatted result

                                            $total_transcode2 =16500000;
                                            $current_progress2 = 12915259.66;
                                            $percent2 = ($current_progress2 / $total_transcode2) * 100;
                                            $result2= round($percent2,2);
                                            // echo $result2;
                                            $tb2 = $current_progress2 / 1048576; // convert to terabytes
                                            $formatted_tb2 = number_format($tb2, 2); // format to 2 decimal places
                                            // echo $formatted_tb; // output the formatted result
                                            $tb_total2 = $total_transcode2 / 1048576; // convert to terabytes
                                            $formatted_tb_total2 = number_format($tb_total2, 2); // format to 2 decimal places
                            ?>
                        </div>
                  
                     

                         <div class="card shadow mb-4 col-sm-8 col-md-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Usage Transcode</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Transcode1&nbsp;&nbsp; &nbsp;  
                                        <span class="float-right"><?php echo $result."%";?></span></h4>
                                            
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $result."%";?>"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="small font-weight-bold" style="margin-top:-3.8%;"><?php echo $formatted_tb." TB"." ".""."of"." "." ".$formatted_tb_total."".""." TB",""." used";?></div>

                                    <br>
                                    <h4 class="small font-weight-bold">Transcode2&nbsp;&nbsp; &nbsp; 
                                    <span class="float-right"><?php echo $result2."%";?></span></h4>

                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width:<?php echo $result2."%";?>"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="small font-weight-bold" style="margin-top:-3.8%;"><?php echo $formatted_tb2." TB"." ".""."of"." "." ".$formatted_tb_total2."".""." TB",""." used";?></div>
                                </div>
                          </div>
                    </div>
                    </div>


                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-danger">Nipa Price Chart</h1>
                    <p class="mb-4">The cost of a Nipa server.

                    <!-- Content Row -->
                 <div class="row">

                        <div class="col-xl-8 col-lg-7">

                            <!-- Bar Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-dark">Cost - list</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart2"></canvas>
                                    </div>
                                    <hr>
                                    <!-- Styling for the bar chart can be found in the
                                    <code>/js/demo/chart-bar-demo.js</code> file. -->
                                </div>
                            </div>
                        </div>
                        <div class="card shadow mb-4 col-sm-8 col-md-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-dark">vm - list</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold"> - Generate Cert&nbsp;&nbsp; &nbsp; 
                                    <h4 class="small font-weight-bold"> - Test Elearning SET&nbsp;&nbsp; &nbsp; 

                                    <!-- Styling for the bar chart can be found in the
                                    <code>/js/demo/chart-bar-demo.js</code> file. -->
                                </div>

                         </div>
                   </div>
                </div>
                <div class="container-fluid">
                   <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Domain Usage</div>
                                            <div class="medium font-weight-bold ">name.com (24)</div>
                                            <div class="medium font-weight-bold ">enom.com (1)</div>
                                            <div class="medium font-weight-bold ">ireallyhost (1)</div>
                                            <div class="caption fw-500 me-2"><i class="fa fa-arrow-up"></i>0%  from last month</div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                            <i class="fas fa-network-wired fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">                                            
                                    <a href="#" class="stretched-link text-decoration-none"  data-toggle="modal" data-target="#domain">View  Domains&nbsp; &nbsp;</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Adobe (Month)</div>
                                            <div class="medium font-weight-bold"><span>3,888 Baht / Month</span></div>
                                            <!-- <div class="caption fw-500 me-2"><i class="fas fa-arrow-down"></i>0%  from last month</div> -->
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                            <i class="fas fa-palette fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">                                            
                                    <a href="#" class="stretched-link text-decoration-none" data-toggle="modal" data-target="#adobe">View  Billing&nbsp; &nbsp;</a>
                                </div>
                            </div>        
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            AWS (Month)</div>
                                            <?php 
                                                foreach ($stmt3 as $key => $row3) 
                                                {
            
                                                ?>
                                            <div class="medium font-weight-bold"> <?php echo $row3['costs'];?> $</div>
                                                <?php }                                                    
                                                ?>
                                                <?php 
                                                $sum3 =0 ;
                                                $last_index3 = count($data_total3) - 2;
                                                    // print_r($stmt2);
                                                // echo json_encode($data, JSON_PRETTY_PRINT);  
                                                foreach ($data_total3 as $key => $row_totals3) 
                                                {
                                                    
                                                    // $sum +=$row_totals['costs'];
                                                    $last_data3 = end($row_totals3);
                                                    // echo $last_data2;
                                                    // $before_last_key = prev($row_totals);
                                                    if ($key === $last_index3) {
                                                        $a3 = $row_totals3['costs'];
                                                        // echo $a;
                                                        $b3 = $last_data3;
                                                        // echo $b;

                                                        $percentage3 = ($a3 / $b3) * 100;
                                                        
                                                        // echo"<div class='caption fw-500 me-2'><i class='fa fa-arrow-up'></i>$percentage%  from last month</div>";
                                                    }
                                                    // $sum3 += $row_totals3['usage'];

                                                    // echo $sum2;

                                                    // echo $last_data."\n";
                                                    // echo $last_value."\n";

                                                ?>
                                                <?php
                                                }
                                            ?>
                                            <?php
                                            // echo $a;
                                            // echo $last_data;
                                            $percentage3 = (($last_data3 - $a3) / $a3) * 100;
                                            ?>
                                            <!-- <div class="medium font-weight-bold"><span>$197.65 / Month</span></div> -->
                                            <?php
                                                       if(round($percentage3,2) >= 0)
                                                       {
                                                       echo" <div class='caption fw-500 me-2'><i class='fa fa-arrow-up'></i> ". round($percentage3,2)." %  from last month</div>";
                                                       }else{
                                                        echo" <div class='caption fw-500 me-2'><i class='fa fa-arrow-down'></i> ". round($percentage3,2)." %  from last month</div>";
                                                       }
                                                    ?>
                                            <!-- <div class="caption fw-500 me-2"><i class="fa fa-arrow-up"></i>0%  from last month</div> -->
                                            <!-- <div class="caption fw-500 me-2"><i class="fas fa-arrow-down"></i>0%  from last month</div> -->
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-server fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">                                            
                                <a href="#" class="stretched-link text-decoration-none" data-toggle="modal" data-target="#aws">View  Billing&nbsp; &nbsp;</a>
                                </div>
                            </div>        
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:orange;">
                                            wowza (Month)</div>
                                            <div class="medium font-weight-bold"><span>$475.65/ Month</span></div>
                                            <!-- <div class="caption fw-500 me-2"><i class="fas fa-arrow-down"></i>0%  from last month</div> -->
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-signal-stream fa-2x text-gray-300"></i> -->
                                            <i class="fas fa-stream fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">                                            
                                <a href="#" class="stretched-link text-decoration-none" data-toggle="modal" data-target="#wowza">View  Billing&nbsp; &nbsp;</a>
                                </div>
                            </div>        
                        </div>
                    </div>
                </div>
                
                <!-- /.container-fluid -->
    </div>

           <!-- Modal -->
            <div class="modal fade" id="domain" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Domain List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
                   <h6> DOMAINMANAGEWHOISEXPIRATION RENEWAL </h6><hr>

                   <p>- passion2grow.com  Feb 2023  OFF </p><hr>
                   <p>- idp27.com 30 Mar 2023 OFF</p></n><hr>
                   <p>- rdtaxschool.com 06 May 2023 ON</p></n><hr>
                   <p>- strategic-online.com 15 May 2023 ON</p></n><hr>
                   <p>- medmasterth.co 25 May 2023 OFF</p></n><hr>
                   <p>- froggenius.online 31 May 2023 ON</p></n><hr>
                   <p>- thaipowerlearning.com 23 Jun 2023 ON</p></n><hr>
                   <p>- tma-virtualevents.com 01 Jul 2023 ON</p></n><hr>
                   <p>- frogacademy.co 06 Jul 2023 ON</p></n><hr>
                   <p>- americanfoodacademy.com 20 Jul 2023 ON</p></n><hr>
                   <p>- froggeniusacademy.co 03 Aug 2023 ON</p></n><hr>
                   <p>- theafterclassthailand.com 08 Oct 2023 ON</p></n><hr>
                   <p>- frogplus.tv 09 Oct 2023 ON</p></n><hr>
                   <p>- froglive.tv 22 Nov 2023 ON</p></n><hr>
                   <p>- dxacademy.co 20 Dec 2023 ON</p></n><hr>
                   <p>- thedxacademy.com 10 Jan 2024 ON</p></n><hr>
                   <p>- gblearning.co 24 Jan 2024 ON</p></n><hr>
                   <p>- doublea-hrdlearning.com 25 Mar 2024 ON</p></n><hr>
                   <p>- gastalkth.com 25 Mar 2024 ON</p></n><hr>
                   <p>- froggenius.net 26 Mar 2024 ON</p></n><hr>
                   <p>- newgfmisthai-elearning.com 30 Mar 2024 ON</p></n><hr>
                   <p>- liveloom.com  17 Aug 2024 ON</p></n><hr>
                   <p>- frogdigital.co 03 Dec 2024 ON</p></n><hr>
                   <p>- froggenius.com 05 Feb 2025 </p></n>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="adobe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">ADOBE List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
                   <h6> ADOBE RENEWAL </h6><hr>

                   <h6>#JAN-</h6><p>3,888 Baht/Month</p><hr>
                   <h6>#FEB-</h6><p></p><hr>
                   <h6>#MAR-</h6><p></p><hr>
                   <h6>#APR-</h6><p></p><hr>
                   <h6>#MAY-</h6><p></p><hr>
                   <h6>#JUN-</h6><p></p><hr>
                   <h6>#JUL-</h6><p></p><hr>
                   <h6>#AUG-</h6><p></p><hr>
                   <h6>#SEP-</h6><p></p><hr>
                   <h6>#OCT-</h6><p></p><hr>
                   <h6>#NOV-</h6><p></p><hr>
                   <h6>#DEV-</h6><p></p>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>


             <!-- Modal -->
             <div class="modal fade" id="aws" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">AWS List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
                   <h6> AWS RENEWAL </h6><hr>

                   <h6>#JAN-</h6><p>197.65$/Month</p><hr>
                   <h6>#FEB-</h6><p></p><hr>
                   <h6>#MAR-</h6><p></p><hr>
                   <h6>#APR-</h6><p></p><hr>
                   <h6>#MAY-</h6><p></p><hr>
                   <h6>#JUN-</h6><p></p><hr>
                   <h6>#JUL-</h6><p></p><hr>
                   <h6>#AUG-</h6><p></p><hr>
                   <h6>#SEP-</h6><p></p><hr>
                   <h6>#OCT-</h6><p></p><hr>
                   <h6>#NOV-</h6><p></p><hr>
                   <h6>#DEV-</h6><p></p>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="wowza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">WOWZA List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
                   <h6> WOWZA RENEWAL </h6><hr>

                   <h6>#JAN-</h6><p>$475.65/Month</p><hr>
                   <h6>#FEB-</h6><p></p><hr>
                   <h6>#MAR-</h6><p></p><hr>
                   <h6>#APR-</h6><p></p><hr>
                   <h6>#MAY-</h6><p></p><hr>
                   <h6>#JUN-</h6><p></p><hr>
                   <h6>#JUL-</h6><p></p><hr>
                   <h6>#AUG-</h6><p></p><hr>
                   <h6>#SEP-</h6><p></p><hr>
                   <h6>#OCT-</h6><p></p><hr>
                   <h6>#NOV-</h6><p></p><hr>
                   <h6>#DEV-</h6><p></p>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <!-- <span>Copyright &copy; Your Website 2020</span> -->
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Ready to Leave?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>
    <script src="js/demo/chart-bar-demo2.js"></script>
    <script src="js/shards-dashboards.1.1.0.min.js"></script>
    <script src="js/extras.1.1.0.min.js"></script>
    <script src="js/app/app-blog-overview.1.1.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>


</body>

</html>