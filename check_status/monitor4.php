
<?php
// require('timezone.php');
require('../dbconnect.php');
//error_reporting(~E_NOTICE);
function start_session()
{
	$_SESSION['user']='';
	session_start();
if(empty($_SESSION['user']))
{
	 header("Location:../login.php");
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
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Monitor</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.11.1/css/all.css">
    
    <!-- <base href="/check_status/"> -->

    <style>
        .bg-f5 {
            background-color: #f5f5f5;
        }

        .table-list th {
            border-top: 0;
            color: rgba(0, 0, 0, 0.5);
        }

        .bg-success-soft {
            background: rgba(40, 167, 69, .1);
            color: #28a745;
        }

        .bg-danger-soft {
            background-color: rgba(223,71,89,.1);
            color: #df4759;
        }

        .project-down {
            background-color: rgba(223,71,89,.1) !important;
            color: #df4759 !important;
        }

        .project-down *:not(.btn):not(.badge):not(i) {
            color: #df4759 !important;
        }
       
       
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand">
        <!-- <a class="navbar-brand" href="#">FROG GENIUS</a> -->
        <div class="collapse navbar-collapse pl-4" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/manage-service/index.php">Homepage <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="main-block" class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center mb-2">
                    <h1 class="mr-3">Monitor</h1>
                </div>
                <div class="form-row">
                    <div class="col-6 col-sm-4 mb-3">
                        <input type="text" class="form-control rounded-pill px-3" placeholder="Search...">
                    </div>
                    <div class="col-3 col-xl-2">
                        <button type="button" class="btn btn-success rounded-pill px-3">
                            <i class="far fa-search mr-1"></i> Search
                        </button>
                    </div>
                    <div class="col-3 col-xl-2 ml-auto text-right">
                        <button id="btn-reload" type="button" class="btn btn-secondary rounded-pill px-3" onclick="projectsList();">
                            <i class="far fa-sync-alt mr-1"></i> Reload
                        </button>
                    </div>
                </div>
                <table class="table table-list">
                    <thead>
                        <tr>
                            <th colspan="2">Project</th>
                            <th>URL</th>
                            <th>Server</th>
                            <th>Status</th>
                            <th width="128">Action</th>
                        </tr>
                    </thead>
                    <tbody id="project-block">
                        <tr>
                            <td colspan="5" class="text-muted text-center">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
 

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

    <script>
        function displyProjectsList(data) {
            var html = '';
            for (var i = 0; i < data.length; i++) {
                var status_class = 'success';
                var status_text = 'running';
                var btn_restart_class = 'secondary';
                if (data[i].status == 0) {
                    status_class = 'danger';
                    status_text = 'down';
                    btn_restart_class = 'primary';
                }

                html += `
                <tr class="project-`+ status_text +`">
                    <td width="32">
                        <i class="fad fa-circle text-`+ status_class +`"></i>
                    </td>
                    <td>
                        `+ data[i].title +`
                        <div class="small text-muted">
                            Container: `+ data[i].container_name +`
                        </div>
                    </td>
                    <td>
                        <a href="`+ data[i].site_url +`" target="_blank">
                            `+ data[i].site_url +`
                        </a>
                    </td>
                    <td>`+ data[i].ip +`</td>
                    <td>
                        <label class="badge badge-pill badge-`+ status_class +` py-2 px-3 mb-0 text-capitalize">
                            `+ status_text +`
                        </label>
                        <br>
                        <small class="text-muted"><i class="far fa-clock"></i> `+ data[i].status_datetime +`</small>
                    </td>
                    <td>
                     <button type="button" class="btn btn-`+ btn_restart_class +` px-3 rounded-pill" "><a href=\"../check_status/show_data.php?id=`+ data[i].id +`\" style="color:#FDFEFE">Manage</button>
                    </td>
                </tr>
                `;
            }

            $('#project-block').html(html);
        }

        
        function projectsList() {
            $('#btn-reload').prop('disabled', true);
            $.get('/check_status/service/project-list2.php', function(data) {
                displyProjectsList(data);
                setTimeout(() => {
                    $('#btn-reload').prop('disabled', false);
                }, 500);
            });
        }

        function restart(status) {
            status = status.toLowerCase();
            if (status == 'down') {
                if (confirm("This project is running, are you sure to restart?") == true) {
                    // location.reload();
                   // window.location.href = " http://monitor2.open-cdn.com:8003/check_status/runbash.php";

                } else {
                }
            }
        }
        $(document).ready(function() {
            projectsList();
           
        });
        setInterval(function() {
        $(document).ready(function() {
            projectsList();
            // setInterval(function() {
            //     projectsList();
            // }, 10000);
        });
    }, 30000);
    </script>
</body>
</html>


