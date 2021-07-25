<?php
spl_autoload_register(function($className){
  require $className.".php";
});
$model = new Model();
//$view = new view();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mygit</title>
    <link rel="stylesheet" href="vendor/bootstrap.min.css">
    <style>
    #header {
	background-color:#660033;
	height:100px;
	color:white;
}
</style>
</head>
<body>
<h1 align="center" id="header" >Git Repository Management System</h1>
<div id="alert" class="alert alert-danger" role="danger">
<?php
echo "Cuurent dir :".getcwd();
$newdir =getcwd()."/gitrepo";
echo "changed dir :".chdir($newdir);
echo "Cuurent dir :".getcwd();
$fldname ="parthibans";
system("mkdir  '".$fldname."'");
$new =getcwd().'/'.$fldname;
echo "Dir New :".$new;
echo "changed dir :".chdir($new);
echo "Cuurent dir :".getcwd();
system("git init");
//system("get add .");
system("chmod a+rwx '".getcwd()."'");
//system("git init");
echo "new dir  :".chdir(__DIR__);
echo "get dir :".getcwd();
system("git add  --all");
system("git status");
system("git commit -m 'First Commit'");

//system();

//system('rm -rf /opt/lampp/htdocs/git/mygit/gitrepo/.git')
?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
<script src="vendor/popper.min.js" ></script>
<script src="vendor/bootstrap.min.js" ></script>
</body>
</html>