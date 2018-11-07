<?php
include('includes/database.php');
$page_title = "Register For Account"; 

//PROCESS REGISTRATION FORM
$request_type = $_SERVER['REQUEST_METHOD'];
if( $request_type == 'POST' ){
     //array to store errors
    $errors = array();
    $first_name = $_POST['firstname'];
   if(strlen($first_name) !== strlen( trim($first_name) ) ){
      $errors['firstname'] = 'cannot contain spaces'; 
   }
    //echo "fistname=$first_name";
    $last_name = $_POST['lastname'];
    if(strlen($last_name) !== strlen( trim($last_name) ) ){
      $errors['lastname'] = 'cannot contain spaces'; 
   }
   // echo "lastname=$last_name";
    $email = $_POST['email'];
    if( filter_var($email, FILTER_VALIDATE_EMAIL) == false ){
        $errors ['email'] = 'please enter a valid email address';
    }
    //echo "email=$email";
    $phone = $_POST['phone'];
    //echo "phone=$phone";
    $password = $_POST['password'];
    if( strlen( $password ) < 6){
        $errors ['password'] = 'must be longer than 6 characters';
    }
    //check if there are errors
    if( count($errors) == 0){
        $query = 'INSERT INTO customer
        (first_name,last_name,email,phone,password)
        VALUES
        (?,?,?,?,?)';
        $hash = password_hash ( $password, PASSWORD_DEFAULT);
        
        $statement = $connection -> prepare ($query);
        $statement -> bind_param ('ssssssss',$first_name, $last_name, $email, $phone, $hash);
        if( $statement -> execute() ){
            //sucess
            //redirect to booking page
        }
        else{
            $errors['registration'] = 'Oops something is wrong';
        }
        
    }
}

?>
<html>
    <?php include('includes/head.php')?>
    <body>
        <?php include('includes/navigation.php'); ?>
        <div class="container">
            <div class="row">
                <form id="register-form" method="post" action="register.php" class="col-md-4 offset-md-4">
                    <h2>Register For Your Account</h2>
                    <?php 
                    if( $errors['firstname'] ){
                        $message = $errors['firstname'];
                        $firstname_class = 'is-invalid';
                    } 
                    $class = ( $firstname_class) ? $firstname_class : '' ;
                   
                    ?>
                    <div class="form-group" >
                        <label for="firstname"> First Name</label>
                        <input type="text"
                        class="form-control <?php echo $class;?>"
                        name="firstname"
                        id="firstname"
                        placeholder="Jane" 
                        required
                        value="<?php echo $first_name; ?>">
                    <div class="invalid-feedback">
                        <?php echo $message; ?>
                    </div>    
            </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text"
                        class="form-control"
                        name="lastname"
                        id="lastname"
                        placehokder="Smith" required>
            </div>
             <?php 
                    if( $errors['firstname'] ){
                        $message = $errors['firstname'];
                        $firstname_class = 'is-invalid';
                    } 
                    $class = ( $firstname_class) ? $firstname_class : '' ;
                   
                    ?>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email"
                        class="form-control"
                        name="email"
                        id="phone"
                        placehokder="Jane" required>
            </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text"
                        class="form-control"
                        name="phone"
                        id="phone"
                        placehokder="029000000" 
                        required>
            </div>
             <?php 
                    if( $errors['password'] ){
                        $message = $errors['password'];
                        $firstname_class = 'is-invalid';
                    } 
                    $class = ( $firstname_class) ? $password_class : '' ;
                   
                    ?>
            
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password"
                        class="form-control"
                        name="password"
                        id="password"
                        placehokder="minimum 6 characters" required>
            </div>
            <div class="button-row">
                <button type="reset" class="btn btn-primary">Cancel</button>
                <button type="submit" class="btn btn-success">Register</button>
            </div>
        </form>
            
    </div>
</div>
    </body>
</html>