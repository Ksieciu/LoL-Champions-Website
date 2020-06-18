<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}
 
$email = '';
$email_err = '';
$password = '';
$password_err = '';
$login_status_arr = false;

// Check for POST data
if($_POST && isset($_POST) && !empty($_POST)){

    // Check if email post is not empyu
    if(empty(trim($_POST['email']))){
        $email_err = "Enter your email!";
    } else {
        $email = trim($_POST['email']);
    }

    // Check if password post is not empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Enter your password!";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // if no errors then proceed with authentication via SOAP
    if($email_err === '' && $password_err === ''){
        include_once 'Client.php';
        $client = new Client;
        $login_status_arr = $client->login(trim($_POST['email']), $_POST['password']);
        
        if($login_status_arr->success){
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $login_status_arr->email;
            $_SESSION["id"] = $login_status_arr->id;
            header("location: welcome.php");
        }
    }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <form method="POST">
            <div class="form-group <?php echo ($email_err !== '') ? 'has-error' : ''; ?>">
                <label>email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group <?php echo ($password_err !== '') ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <span class="help-block"><?php if($login_status_arr){ echo $login_status_arr->msg; 
                echo $login_status_arr->email; }?></span>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>