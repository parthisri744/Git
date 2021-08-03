<?php
spl_autoload_register(function($className) {
           require_once "../Model/".$className.".php";
});
$obj=new DBModel();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSS</title>
   
         <style>
      @media (min-width:992px) {    
      .vertical-nav {
      position: fixed;
      left: 0;
      height: 100%;
      background-color: lightblue;
      overflow-y: auto;
      padding-top: 30px;
    }
} 
    </style> -->
<!--    <div class="container">
<p>Experience as a program manager, engineering manager, or equivalent practical experience
Experience working with Accelerators or with startups
Experience developing strategies for solutions
Experience communicating with stakeholders across levels, through structuring and delivering presentations and materials</p>
</div> -->
</head> 
<body ng-app="ucensss" ng-controller="sssctrl">
    <div><?php  require_once("../Navigation/Navigation.php");  ?></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="width: 100px">
                <div class="card ">
                    <div class="card-body">
                        <div class="container">
<p>Experience as a program manager, engineering manager, or equivalent practical experience
Experience working with Accelerators or with startups
Experience developing strategies for solutions
Experience communicating with stakeholders across levels, through structuring and delivering presentations and materials</p>
</div>
                    </div>
                </div>
            </div>
                        <div class="col-md-10 col-xs-5">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
<p>Experience as a program manager, engineering manager, or equivalent practical experience
Experience working with Accelerators or with startups
Experience developing strategies for solutions
Experience communicating with stakeholders across levels, through structuring and delivering presentations and materials</p>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="../vendors/js/Main.js"></script>
<link rel='stylesheet' href='../vendors/css/style.css'></link>  
</body>
<div class="footer fixed-bottom bg-primary sticky-buttom page-footer ">
<div class="footer-copyright text-center py-3">© 2020 Copyright:Parthiban
</div>
</div>
</html>
