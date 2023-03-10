<?php
//getting id from url
include_once("connect.php");


// $id = $_GET['id'];
$sort = "";
 if(isset($_GET["sort"]))
    { 
     $sort = $_GET["sort"]; 

    }


//selecting data associated with this particular id

$pdo_statement = $pdo_conn->prepare("SELECT * FROM projects_domain WHERE status=$sort");
$pdo_statement->execute(array(':id' => $id));


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
   
    <script>
function autoSubmit()
{
    var formObject = document.forms['theForm'];
    formObject.submit();
}
</script>

</head>
<body>

        <div class="filters-block mb-4">
                                        <form action="" name='theForm' id='theform'>
                                            <div class="form-row">
                                                <div class="col-xl-4">
                                                    <div class="input-group mb-0">
                                                        <input type="text" class="form-control" placeholder="Search...">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-dark px-4" type="button" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-5 ml-auto text-right">
                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <?php
                                                        $sort = "";
                                                        if(isset($_GET["sort"]))
                                                        { 
                                                            $sort = $_GET["sort"]; 

                                                        }
                                                    ?>
                                                        
                                                        
                                                        <label class="btn btn-light border px-3">
                                                             <input type="radio" name="sort" <?php if ($sort == 'up') { ?>checked='checked' <?php } ?>value="1" onChange="autoSubmit();" /><i class="fa-solid fa-circle-up text-success"></i> up
                                                        </label>
                                                        <label class="btn btn-light border px-3 <?=$f_pj_status_down_class?>">
                                                             <input type="radio" name="sort" <?php if ($sort == 'down') { ?>checked='checked' <?php } ?> value="0" onChange="autoSubmit();" /><i class="fa-solid fa-circle-up text-danger"></i> down
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Project</th>
                                                <th>URL</th>
                                                <th>Server</th>
                                                <th>Status</th>
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
                                                        name : <?php echo $row['title'];?>
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
                                                <td>
                                                <?php 
                                                if($row['status']==1){
                                                    echo "UP";
                                                }else{
                                                    echo "DOWN";
                                                }
                                                
                                                ?>
                                                </td>
                                                <td>
                                                <form action="./check_status/runbash2.php" method="post" class="was-validated">

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
                                                </form>

                                                </td>
                                            </tr>
                                            <?php }?>

                                    </tbody>
                        </table>

    </body>
</html>


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

    <script>
function clicked(e)
{
    if(!confirm('Do you want to Reload')) {
        e.preventDefault();
    }
}
</script>	



