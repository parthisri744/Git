<?php 
ini_set("display_errors",1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);
   $getmethod = $_GET['functionname'];
   $getid = $_GET['id'];
   if($getmethod == 'insertstudents'){
    insertstudents($getid);
    }
   function insertstudents($id){
    $output= [];
    $studentinfo = json_decode(file_get_contents("php://input"));
    //var_dump($studentinfo);
    if(isset($studentinfo) && !empty($studentinfo)){
    $regno=isset($studentinfo->regno) ? trim($studentinfo->regno) :"";
    $sname=isset($studentinfo->sname) ? trim($studentinfo->sname) :"";
    $dob=isset($studentinfo->dob) ? trim($studentinfo->dob) :"";
    $course=isset($studentinfo->course) ? trim($studentinfo->course) :"";
    $branch=isset($studentinfo->branch) ? trim($studentinfo->branch) :"";
    $syear=isset($studentinfo->syear) ? trim($studentinfo->syear) :"";
    $balance=isset($studentinfo->balance) ? trim($studentinfo->balance) :"";
    $phoneno=isset($studentinfo->phoneno) ? trim($studentinfo->phoneno) :"";
    $stu_address=isset($studentinfo->stu_address) ? trim($studentinfo->stu_address) :"";
    $email=isset($studentinfo->email) ? trim($studentinfo->email) :"";
    $password=password_hash($dob, PASSWORD_DEFAULT);
    if($id == 0 ){
       $result= insertdata($regno,$sname,$dob,$course,$branch,$syear,$email,$password,$phoneno,$balance,$stu_address);
        if($result){
            $output[]="Submitted Successfully";
        }else {
            $output[]="Please Enter Valid Date";
        }
    }
    echo json_encode($output);
    }
 }
    function insertdata($regno,$sname,$dob,$course,$branch,$syear,$email,$password,$phoneno,$balance,$stu_address){
        $database = new PDO("mysql:host=localhost;dbname=SSS",'root','');
         $sql="INSERT INTO students (regno,sname,dob,course,branch,syear,email,password,phoneno,balance,stu_address) VALUES (:regno,:sname,:dob,:course,:branch,:syear,:email,:password,:phoneno,:balance,:stu_address)";
         //echo "sql :".$sql;
         $stmt=$database->prepare($sql); 
         $stmt->bindParam(":regno", $regno, PDO::PARAM_STR);
         $stmt->bindParam(":sname", $sname, PDO::PARAM_STR);
         $stmt->bindParam(":dob", $dob ,PDO::PARAM_STR);
         $ecourse=base64_encode(encrypt($course,"UcEnSsS"));
         $stmt->bindParam(":course", $ecourse, PDO::PARAM_STR);
         $stmt->bindParam(":branch", $branch);
         $stmt->bindParam(":syear", $syear , PDO::PARAM_STR);
         $stmt->bindParam(":email", $email , PDO::PARAM_STR);
         $stmt->bindParam(":password", $password , PDO::PARAM_STR);
         $stmt->bindParam(":phoneno", $phoneno , PDO::PARAM_STR);
         $stmt->bindParam(":balance", $balance , PDO::PARAM_STR);
         $stmt->bindParam(":stu_address", $stu_address , PDO::PARAM_STR);
        try{           
            $stmt->execute();
            //echo "Inseted Successfully";
            return $database->lastInsertId();
        } catch (PDOException $e){
             echo "sql = ".$sql."<br/>".$e->getMessage();
        }
    }
    function encrypt($plaintext, $password) {
        $method = "AES-256-CBC";
       $key = hash('sha256', $password, true);
        $iv = openssl_random_pseudo_bytes(16);
    
        $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
        $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);
    
        return $iv . $hash . $ciphertext;
    } 
   ?>