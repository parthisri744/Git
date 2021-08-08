<?php 
ini_set("display_errors",1);
ini_set("display_startup_errors",1);
error_reporting(E_ALL);
$getmethod = $_GET['functionname'];
$id=$_GET['id'];
if($getmethod == 'insertstudents'){
    if(!empty($_POST)) {
        $regno=post_method('regno');
        $sname=post_method('sname');
        $dob=post_method('dob');
        $course =post_method('course');
        $branch=post_method('branch');
        $syear=post_method('syear');
        $email=post_method('email');
        $phoneno=post_method('phoneno');
        $stu_address=post_method('stu_address');
        $balance=post_method('balance');
        $password = password_hash($dob, PASSWORD_DEFAULT);
        $id=post_method('student_id');
        //echo "ID".$id;
        if($id != '' && $regno!='' && $dob!='' && $course!='' && $branch !='' && $syear != '' && $email != '' && $phoneno !='' && $balance!='' && $stu_address!='' ){
            $result = updatedata($regno,$sname,$dob,$course,$branch,$syear,$email,$phoneno,$balance,$stu_address,$id);
            if($result){
            echo "Updated Successfully";
            }else{
                echo "Unable to process your Request";
            }
        }elseif($regno!='' && $dob!='' && $course!='' && $branch !='' && $syear != '' && $email != '' && $phoneno !='' && $balance!='' && $stu_address!='') {

            $result =insertdata($regno,$sname,$dob,$course,$branch,$syear,$email,$password,$phoneno,$balance,$stu_address);
            if($result){
                echo "Inserted Successsfully";
            }else {
                echo "Unable to process your Request";

            }
        }else {
            echo "Please Fill the Form credentials";
        }
        // return $output;
        }   
    }elseif($getmethod == 'getdata_for_edit'){
        $getid =$_GET['id'];
        $result=fetch_data_for_studentupdate($getid);
    }elseif($getmethod=="deletedata") {
        $database = new PDO("mysql:host=localhost;dbname=SSS",'root','');
        $ids = isset($_POST["users_arr"]) ? $_POST["users_arr"] : "";
        var_dump($ids);
        $ids = implode(',',$ids);
        $query = $database->prepare("DELETE FROM students WHERE ID IN ( $ids )");
        $query->execute();
        echo "Deleted Successfully";
    }elseif($getmethod == 'getdata_for_purchasedit'){
        $getid =$_GET['id'];
        $database = new PDO("mysql:host=localhost;dbname=SSS",'root','');
        $sql = "SELECT * FROM adminstock WHERE ID=$getid";
        $stmt=$database->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);    
    }elseif($getmethod == 'insert_stock'){
        if(!empty($_POST)) {
            $product_name=post_method('product_name');
            $product_quantity=post_method('product_quantity');
            $product_price=post_method('product_price');
            $id = $_POST['product_id'];;
           // echo "Product ID :".$id;
            //echo "Name :".$product_name."Product Quantity :".$product_quantity."Price :".$product_price;
            if($id != '' && $product_name!='' && $product_quantity!='' && $product_price!='' ){
                $result = updateproduct($product_name,$product_quantity,$product_price,$id);
                if($result){
                echo "Updated Successfully";
                }else{
                    echo "Unable to process your Request";
                }
            }elseif($product_name!='' && $product_quantity!='' && $product_price!='') {
    
                $result =insertproduct($product_name,$product_quantity,$product_price);
                if($result){
                    echo "Inserted Successsfully";
                }else {
                    echo "Unable to process your Request";
    
                }
            }else {
                echo "Please Fill the Form credentials";
            }
        }
    }elseif($getmethod == 'deleteproduct'){
        $database = new PDO("mysql:host=localhost;dbname=SSS",'root','');
        $ids = isset($_POST["users_arr"]) ? $_POST["users_arr"] : "";
       // var_dump($ids);
        $ids = implode(',',$ids);
        $query = $database->prepare("DELETE FROM adminstock WHERE ID IN ( $ids )");
        $query->execute();
        echo "Deleted Successfully";
    }
   function post_method($param){
        $param = isset($_POST[$param]) ? trim($_POST[$param]) : "";
        //echo "Parameter :".$param."<br/>";
        return $param;
    }
    function insertdata($regno,$sname,$dob,$course,$branch,$syear,$email,$password,$phoneno,$balance,$stu_address){
        $database = new PDO("mysql:host=localhost;dbname=SSS",'root','');
         $sql="INSERT INTO students (regno,sname,dob,course,branch,syear,email,password,phoneno,balance,stu_address) VALUES (:regno,:sname,:dob,:course,:branch,:syear,:email,:password,:phoneno,:balance,:stu_address)";
         //echo "sql :".$sql;
         $stmt=$database->prepare($sql); 
         $stmt->bindParam(":regno", $regno, PDO::PARAM_STR);
         $stmt->bindParam(":sname", $sname, PDO::PARAM_STR);
         $stmt->bindParam(":dob", $dob );
         $ecourse=base64_encode(encrypt($course,"UcEnSsS"));
         $stmt->bindParam(":course", $ecourse, PDO::PARAM_STR);
         $stmt->bindParam(":branch", $branch);
         $stmt->bindParam(":syear", $syear , PDO::PARAM_STR);
         $stmt->bindParam(":email", $email , PDO::PARAM_STR);
         $stmt->bindParam(":password", $password , PDO::PARAM_STR);
         $stmt->bindParam(":phoneno", $phoneno , PDO::PARAM_STR);
         $stmt->bindParam(":balance", $balance , PDO::PARAM_STR);
         try{           
         $stmt->bindParam(":stu_address", $stu_address , PDO::PARAM_STR);
            $stmt->execute();
            //echo "Inseted Successfully";
            return $database->lastInsertId();
        } catch (PDOException $e){
             echo "sql = ".$sql."<br/>".$e->getMessage();
        }
    }
    function updatedata($regno,$sname,$dob,$course,$branch,$syear,$email,$phoneno,$balance,$stu_address,$id){
        $database = new PDO("mysql:host=localhost;dbname=SSS",'root','');
         $sql="UPDATE students SET regno=:regno,sname=:sname,dob=:dob,course=:course,branch=:branch,syear=:syear,balance=:balance,phoneno=:phoneno,stu_address=:stu_address,email=:email WHERE ID = $id";
         //echo "SQL :".$sql;
         $stmt=$database->prepare($sql); 
         $stmt->bindParam(":regno", $regno, PDO::PARAM_STR);
         $stmt->bindParam(":sname", $sname, PDO::PARAM_STR);
         $stmt->bindParam(":dob", $dob );
         $ecourse=base64_encode(encrypt($course,"UcEnSsS"));
         $stmt->bindParam(":course", $ecourse, PDO::PARAM_STR);
         $stmt->bindParam(":branch", $branch);
         $stmt->bindParam(":syear", $syear , PDO::PARAM_STR);
         $stmt->bindParam(":email", $email , PDO::PARAM_STR);
         $stmt->bindParam(":phoneno", $phoneno , PDO::PARAM_STR);
         $stmt->bindParam(":balance", $balance , PDO::PARAM_STR);
         $stmt->bindParam(":stu_address", $stu_address , PDO::PARAM_STR);        
         $stmt->execute();
         return true;
    }
     function fetch_data_for_studentupdate($id){
       $database = new PDO("mysql:host=localhost;dbname=SSS",'root','');
        $sql = "SELECT * FROM students WHERE ID=$id";
        $stmt=$database->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);    
    }
    function fetch_data_for_purchaseupdate($id){
        $database = new PDO("mysql:host=localhost;dbname=SSS",'root','');
         $sql = "SELECT * FROM adminstock WHERE ID=$id";
         $stmt=$database->prepare($sql);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
         echo json_encode($row);    
     }
    function encrypt($plaintext, $password) {
        $method = "AES-256-CBC";
       $key = hash('sha256', $password, true);
        $iv = openssl_random_pseudo_bytes(16);
    
        $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
        $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);
    
        return $iv . $hash . $ciphertext;
    } 
    function insertproduct($product_name,$product_quantity,$product_price){
        $database = new PDO("mysql:host=localhost;dbname=SSS",'root','');
         $sql="INSERT INTO adminstock (product_name,product_quantity,product_price) VALUES (:product_name,:product_quantity,:product_price)";
         //echo "sql :".$sql;
         $stmt=$database->prepare($sql); 
         $stmt->bindParam(":product_name", $product_name, PDO::PARAM_STR);
         $stmt->bindParam(":product_price", $product_price, PDO::PARAM_STR);
         $stmt->bindParam(":product_quantity", $product_quantity, PDO::PARAM_STR);
         try{           
            $stmt->execute();
            //echo "Inseted Successfully";
            return $database->lastInsertId();
        } catch (PDOException $e){
             echo "sql = ".$sql."<br/>".$e->getMessage();
        }
    }
    function updateproduct($product_name,$product_quantity,$product_price,$id){
        $database = new PDO("mysql:host=localhost;dbname=SSS",'root','');
         $sql="UPDATE adminstock SET product_name=:product_name,product_quantity=:product_quantity,product_price=:product_price WHERE ID = $id";
        // echo "SQL :".$sql;
         $stmt=$database->prepare($sql); 
         $stmt->bindParam(":product_name", $product_name, PDO::PARAM_STR);
         $stmt->bindParam(":product_price", $product_price, PDO::PARAM_STR);
         $stmt->bindParam(":product_quantity", $product_quantity, PDO::PARAM_STR);      
         $stmt->execute();
         return true;
    }
   ?>