<?php
// Initialize the session
session_start();
include 'layouts/Navigation.php';
include 'layouts/Footer.php';
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
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
        include_once 'functions/Client.php';
        $client = new Client;
        $login_status_arr = $client->login($_POST['email'], $_POST['password']);
        
        if($login_status_arr->success){
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $login_status_arr->email;
            $_SESSION["id"] = $login_status_arr->id;
            header("location: index.php");
        }
    }
};
?>



<!DOCTYPE html>
<html lang="pl">

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>League of Legends - Champions</title>
    <!--- global css with basic styling and favicon -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;400&display=swap" rel="stylesheet">
</head>

<body class="login-body">
    <div class="header" id="header">

    </div>
    <?php navbar(); ?>


<div class="login-wrapper">
    <div class="login-box">
        <div class="login">
<H1>Login to your account!</H1>
            <form name="login" style="align-items: center;" method="POST">
            E-mail:<br>  <input type="text" class="input-box" name="email" placeholder="Enter your e-mail address" value="<?php echo $email; ?>"><br>
            <span class="help-block"><?php echo $email_err; ?></span><br>
            Password: <br> <input type="password" class="input-box" name="password" placeholder="Enter your password"><br>
            <span class="help-block"><?php echo $password_err; ?></span><br>
            <button type="submit" name="login-btn" class="reg-btn">Login</button><br><br>
            <span class="help-block"><?php if($login_status_arr){ echo $login_status_arr->msg;}?></span>
            </div>
    </div>
</div>



 <?php footer();?>

</body>
</html>