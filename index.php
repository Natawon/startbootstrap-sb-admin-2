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

<?php
//getting id from url
include_once("connect.php");


// $id = $_GET['id'];
// echo $_GET["sort"];
  $sort ="1";
  $strKeyword = null;

  if (isset($_GET["sort"]) != 0 && isset($_GET["sort"]) != 1) {
    $sql = "SELECT * FROM projects_domain_logs";
  }

    if(isset($_GET["sort"]))
    { 
      
         $sort = $_GET["sort"]; 
         $sql = "SELECT * FROM projects_domain WHERE status=$sort";

    }
    else{
        $sql = "SELECT * FROM projects_domain WHERE status='1'";
    }
 
    if(isset($_POST["txtKeyword"]))
    { 
      $strKeyword = $_POST["txtKeyword"]; 
      $sql = "SELECT * FROM projects_domain WHERE container_name LIKE '%".$strKeyword."%'";


    }

   $pdo_statement = $pdo_conn->prepare($sql);
   $pdo_statement->execute();
// $pdo_statement = $pdo_conn->prepare("SELECT * FROM projects_domain WHERE status=$sort");
// $pdo_statement->execute(array(':id' => $id));
// $pdo_statement = $pdo_conn->fetchAll();

?>


<?php
    include_once("connect.php");

    $project_status = 'all';

    if (isset($_GET['project_status'])) {
        $project_status = $_GET['project_status'];
    }

    $serverup_query = $pdo_conn->prepare("select count(id) as total from projects_domain where status=1");
    $serverup_query->execute();
    $serverup_data = $serverup_query->fetchAll();

    $serverdown_query = $pdo_conn->prepare("select count(id) as total from projects_domain where status=0");
    $serverdown_query->execute();
    $serverdown_data = $serverdown_query->fetchAll();

    // print_r($result);
    // echo $resultUp[0]['total'];
    // exit;
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

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <link href="css/admin.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.11.1/css/all.css">


    <style>
        .card {
            border: 0 !important;
            box-shadow: 0 .125rem .25rem 0 rgba(58,59,69,.2)!important;
            -webkit-transition: box-shadow .25s ease,-webkit-transform .25s ease;
                transition: box-shadow .25s ease,-webkit-transform .25s ease;
                transition: box-shadow .25s ease,transform .25s ease;
                transition: box-shadow .25s ease,transform .25s ease,-webkit-transform .25s ease;
        }

        .a-card:hover {
            text-decoration: none !important;
        }

        .a-card:hover .card {
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important;
            -webkit-transform: translate3d(0,-3px,0);
            transform: translate3d(0,-3px,0);
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

    <script>
    function autoSubmit()
    {
        var formObject = document.forms['theForm'];
        formObject.submit();
    }
    </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                    <i class="fa fa-desktop"></i>
                </div>
                <div class="sidebar-brand-text mx-3">FGN Admin <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
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
            <li class="nav-item">
                <a class="nav-link" href="charts.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


            <!-- Sidebar Message -->
            <!-- <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->
            <div class="text-center d-none d-md-inline">
            <span style="font-size:12px;">Copyright &copy; FROG GENIUS <?=date('Y')?></span>
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
                    <!-- <form
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
                    </form> -->

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
                                <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?= $_SESSION['name'].' '.$_SESSION['surname'];?></span> -->
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <div class="d-flex flex-row-reverse">

                        
                        <a href="./export/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fa fa-download fa-sm text-white-50"></i> Export data</a>&nbsp;
                                <a href="./check_status/input.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fa fa-upload fa-sm text-white-50"></i> Upload data</a>
                                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                   

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-4 col-lg-5">
                            <!-- <a href="check_status/monitor3.php" class="a-card" target="_blank"> -->
                                <div class="card border-0 mb-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="mr-4">
                                                <i class="fa-solid fa-circle-up text-success fa-3x"></i>
                                            </div>
                                            <div class="text-right">
                                                <small class="text-uppercase text-muted">Server Up</small>
                                                <h1 class="display-4 mb-0 text-success font-weight-bold"><?=$serverup_data[0]['total']?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- </a> -->
                        </div>

                        <div class="col-xl-4 col-lg-5">
                            <!-- <a href="check_status/monitor4.php" class="a-card" target="_blank"> -->
                                <div class="card border-0 mb-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="mr-4">
                                                <i class="fa-solid fa-circle-down text-danger fa-3x"></i>
                                            </div>
                                            <div class="text-right">
                                                <small class="text-uppercase text-muted">Server Down</small>
                                                <h1 class="display-4 mb-0 text-danger font-weight-bold"><?=$serverdown_data[0]['total']?></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- </a> -->
                        </div>                        
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="mb-4">
                                        Project List
                                    </h5>
                                    <div class="filters-block mb-4">
                                    <form name="frmSearch" method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
                                    <!-- <form action="" name='theForm' id='theform'> -->
                                            <div class="form-row">
                                                <div class="col-xl-4">
                                                    <div class="input-group mb-0">
                                                        <input type="text" class="form-control" name="txtKeyword" id="txtKeyword" value="<?php echo $strKeyword;?>" placeholder="Search...">
                                                        <div class="input-group-append">
                                                            <!-- <button class="btn btn-dark px-4" type="button" name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>"><i class="fa-solid fa-magnifying-glass"></i></button> -->
                                                            <!-- <input name="txtKeyword" type="text" id="txtKeyword" value="<?php echo $strKeyword;?>"> -->

                                                            <input type="submit" class="btn btn-dark px-4" value="Search"></th>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            <form action="" name='theForm' id='theform'>
                                                <!-- <div class="col-xl-5 ml-auto text-right"> -->
                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                        <!-- <label class="btn btn-light border px-3">
                                                             <input type="radio" id="radioButton1" name="sort" <?php if ($sort == 'all') { ?>checked='checked' <?php } ?>value="1" onChange="autoSubmit();" /> all
                                                        </label>  -->
                                                        <label class="btn btn-light border px-3">
                                                             <input type="radio" id="radioButton2" name="sort" <?php if ($sort == 'up') { ?>checked='checked' <?php } ?>value="1" onChange="autoSubmit();" /><i class="fa-solid fa-circle-up text-success"></i> up
                                                        </label>
                                                        <label class="btn btn-light border px-3 <?=$f_pj_status_down_class?>">
                                                             <input type="radio" id="radioButton3" name="sort" <?php if ($sort == 'down') { ?>checked='checked' <?php } ?> value="0" onChange="autoSubmit();" /><i class="fa-solid fa-circle-up text-danger"></i> down
                                                        </label>
                                                        <label class="btn btn-light border px-3 <?=$f_pj_status_down_class?>">
                                                             <input type="radio" id="radioButton3" name="sort" <?php if ($sort == 'down') { ?>checked='checked' <?php } ?> value="2" onclick="location.href='allevents.php'"/><i class="fa-solid fa-circle"></i> All event
                                                        </label>
                                                    </div>
                                                <!-- </div> -->
                                            <!-- </div> -->
                                        </form>
                                    </div>
                                    <div style="overflow-x: auto;">
                                    <table id="data" class="table" >
                                        <thead>
                                            <tr>
                                                <th colspan="2">Project</th>
                                                <th>URL</th>
                                                <th>Server</th>
                                                <!-- <th>Status</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($row = $pdo_statement->fetch(PDO::FETCH_ASSOC))
                                         {
                                        ?>
                                        <tr>
                                                <td width="24">
                                                <?php 
                                                if($row['status']==1){
                                                    echo '<i class="fa fa-circle" style="color: green !important;"></i>';
                                                }else{
                                                    echo '<i class="fa fa-circle" style="color: red !important;"></i>';
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
                                                  <?php echo $row['ip'];?>
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
                                                <form action="/manage-service/ssh.php" method="post" class="was-validated">

                                                     <input type="hidden" class="form-control" id="ip"  name="ip" value="<?php echo $row['ip'] ;?>">
                                                     <input type="hidden" class="form-control" id="password"  name="password" value="<?php echo $row['password'] ;?>">
                                                     <input type="hidden" class="form-control" id="script"  name="script" value="<?php echo $row['script'] ;?>">
                                                     <input type="hidden" class="form-control" id="name"  name="name" value="<?php echo $row['container_name'] ;?>">   
                                                     <input type="hidden" class="form-control" id="url"  name="url" value="<?php echo $row['check_url'] ;?>">
                                                     
                                                 <?php 
                                                if($row['status']==0){
                                                    echo '<button type="submit" class="btn btn-primary" onclick="clicked(event)">Reload PHP</button>';              
                                                }else{
                                                    echo '<button type="submit" class="btn btn-secondary" onclick="clicked(event)" disabled>Reload PHP</button>';
                                                }
                                                
                                                ?>
                                                <!-- <button type="submit" class="btn btn-primary" onclick="clicked(event)">Reload PHP</button> -->
                                                </form>

                                                </td>
                                            </tr>
                                            <?php }?>

                                    </tbody>
                                 </table>
                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row d-none">

                        <!-- Content Column -->
                        <div class="col-lg-8 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Color System -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            Primary
                                            <div class="text-white-50 small">#4e73df</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            Success
                                            <div class="text-white-50 small">#1cc88a</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            Info
                                            <div class="text-white-50 small">#36b9cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            Warning
                                            <div class="text-white-50 small">#f6c23e</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Danger
                                            <div class="text-white-50 small">#e74a3b</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            Secondary
                                            <div class="text-white-50 small">#858796</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            Light
                                            <div class="text-black-50 small">#f8f9fc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            Dark
                                            <div class="text-white-50 small">#5a5c69</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; FROG GENIUS <?=date('Y')?></span>
                    </div>
                </div>
            </footer> -->
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
                <!-- <div class="modal-body">ยืนยันการ "Logout" .</div> -->
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
    <!-- <script>
      let radBtnDefault = document.getElementById("radioButton1");
      radBtnDefault.checked = true;
   </script> -->

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