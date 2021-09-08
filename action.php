<?php 

function clean($input){
 
    $input = trim($input);
    $input = stripcslashes($input);
    $input = htmlspecialchars($input);
     return $input;
}



if($_SERVER['REQUEST_METHOD'] == "POST"){

   $name     = clean($_POST['name']);
   $email    = clean($_POST['email']);
   $password = $_POST['password'];
   $address = $_POST['address'];
   $gender = $_POST['gender'];
   $linkedin = $_POST['linkedin'];

   $errorMessages = [];

   if(empty($name)){

       $errorMessages['Name'] = "Field Required";
   }


   if(empty($email)){

       $errorMessages['Email'] = "Field Required";
   }


   if(strlen($password) < 6){

       $errorMessages['Password'] = "Length Must be > 6 ch";
   }


   if(strlen($address) < 10){

    $errorMessages['address'] = "Length Must be > 10ch";
}

if(empty($gender)){

    $errorMessages['gender'] = "Field Required";

}
    


if(empty($linkedin)){

    $errorMessages['linkedin'] = "Field Required";
}


   if(count($errorMessages) > 0){

      foreach($errorMessages as $key => $value){

          echo '* '.$key.' : '.$value.'<br>';
      }


   }else{
   
        echo 'Valid Data';
  
   }
}


?>
