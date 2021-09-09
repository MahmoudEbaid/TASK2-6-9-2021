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

   $imagetmp_path = $_FILES['image']['tmp_name'];
   $imagename     = $_FILES['image']['name'];
   $imagesize     = $_FILES['image']['size'];
   $imagetype     = $_FILES['image']['type'];
   $errorMessages = [];
    }


   function validate($input,$flag){
    $status = true;
    
     switch ($flag) {
         case 1:
             # code...
             if(empty($input)){
               $status = false;
             }
             break;
    
        case 2: 
            if(!preg_match('/^[a-zA-Z\s]*$/',$input)){
                $status = false;
            }
           break;
    
        case 3: 
            # code 
            if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
                $status = false;
            } 
            break; 
    
    
        case 4: 
            $allowedExt = ['image'];
    
            $extArray = explode('/',$input);
        
            if(!in_array($extArray[1],$allowedExt)){
                $status = false;
            }
    
          break;
    
    
       }
      
        return $status;
    
    }


   
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

if(!validate($imagename,1)){
    $errors['image'] = "Field Required";  
}
elseif(!validate($imagetype,4)){
    $errors['image'] = "Invalid Extension";
}

if(count($errors) > 0){

    foreach($errors as $key => $value){
        echo '* '.$key.' : '.$value.'<br>';
    }
}
    else{
       
        $extArray = explode('/',$imagetype);
        $finalName =   rand().time().'.'.$extArray[1];
        }   
         
         if(move_uploaded_file($imagetmp_path)){
  
          $_SESSION['student'] = ['name' => $name , 'email' => $email , 'image' => $finalName ];

         }
         else{
             echo 'Error In Uploading Try Again';
            }



   if(count($errorMessages) > 0){

      foreach($errorMessages as $key => $value){

          echo '* '.$key.' : '.$value.'<br>';
      }
   }
   else{
   
        echo 'Valid Data';
  }

}

?>
