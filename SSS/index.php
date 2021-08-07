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
//var_dump($data);
function decrypt($ivHashCiphertext, $password) {
    $method = "AES-256-CBC";
    $iv = substr($ivHashCiphertext, 0, 16);
    $hash = substr($ivHashCiphertext, 16, 32);
    $ciphertext = substr($ivHashCiphertext, 48);
    $key = hash('sha256', $password, true);
    if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;
    return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
  } 
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
                                
                                   require_once("View/Newstudent.php");
                            }
                        ?>
                </div>
          </div>
      </div>
    </div>
</div>
<script src="vendors/js/Main.js"></script>
<link rel='stylesheet' href='vendors/css/style.css'></link>  
<script>
angular.module("ucensss",[]).controller("sssctrl",function($scope,$http,$filter){

$scope.courseDetails=["Bachelor of Engineering","Bachelor of Technology"];

$scope.BecourseDetails=["Computer Science Engineering","Mechanical Engineering","Electrical and Electronics Engineering",
"Electronics and Communication Engineering","Civil Engineering"];

$scope.BtechcourseDetails = ["Informational Technology"];

$scope.ayear = ["First Year","Second Year","Third Year","Final Year"];
var studentid= 0;

$scope.insert= function(){
   var cdate =  $filter('date')($scope.dob, "yyyy-mm-dd");
   $http.post("Model/Ajaxinsert.php?functionname=insertstudents&id="+studentid,{
       'regno': $scope.registerno,
       'sname': $scope.stuname,
       'dob' : cdate,
       'course' : $scope.course,
       'branch' : $scope.branch,
       'syear' : $scope.year,
       'email' : $scope.email,
       'phoneno' : $scope.phoneno,
       'balance':$scope.balance,
       'stu_address':$scope.stu_address
       }).then(function success(response){ 
           var message= response.data;   
           swal({
                text: message,
                timer: 2000,
                showConfirmButton: true
             }, function(){
                 window.location.href = "index.php?temp=aba064f896dc3eb1653c3b68b9548ef1";
            });
       },function error(response){
            alert(response.data);
       });
   }
});
</script>
</body>
<br /></br/> 
<div class="footer fixed-bottom bg-primary   ">
<div class="footer-copyright text-center py-3">© 202 Copyright:Parthiban
</div>
</div>
</html>
<!--sticky-buttom page-footer -->