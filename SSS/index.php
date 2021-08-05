<?php
ini_set("display_errors",1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);
session_start();
 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
spl_autoload_register(function($className) {
           require_once "Model/".$className.".php";
});
$obj=new DBModel();
//$logout=$obj->session_logout();
$data= $obj->fetch_data_datatable();
//var_dump("Data".$data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSS</title>
</head> 
<body ng-app="ucensss" ng-controller="sssctrl" ng-init="GenerateTable()">
<div><?php  require_once("Navigation/Navigation.php");  ?></div>
    <div class="container-fluid">
        <div class="row">
                <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <?php
                            $param=$_GET['temp'];
                            //echo "Param :".$param;
                            if($param=="dc7161be3dbf2250c8954e560cc35060"){

                                   require_once("View/Dashboard.php");
                            } elseif($param=="aba064f896dc3eb1653c3b68b9548ef1"){
                                   require_once("View/Students.php");
                            }else{
                               // echo "dir".__DIR__;
                                
                                   require_once("Datatabel.php");
                            }
                        ?>
                </div>
          </div>
<script src="vendors/js/Main.js"></script>
<link rel='stylesheet' href='vendors/css/style.css'></link>  
<script>
angular.module("ucensss",[]).controller("sssctrl",function($scope,$http){

});
</script>
</body>
<br /></br/>
<div class="footer fixed-bottom bg-primary   ">
<div class="footer-copyright text-center py-3">© 2020 Copyright:Parthiban
</div>
</div>
</html>
<!--sticky-buttom page-footer -->