<?php
    include 'functions/Client.php';
    include 'layouts/Navigation.php';
    include 'layouts/Footer.php';
   

    if($_POST && isset($_POST) && !empty($_POST)){
        $client = new Client;
        $client->register($_POST['email'], $_POST['password']);
        header('location: login.php');
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
</head>';

<body class="register-body">
    <div class="header" id="header">

    </div>

    <?php navbar(); ?>

    </div>
<div class="register-wrapper">
    <div class="register-box">
        <div class="registration">
<H1>Register your account!</H1>
            <form name="register" style="align-items: center;" method="POST">
            E-mail:<br>  <input type="text" class="input-box" name="email" placeholder="Enter your e-mail address"><br>
            Password: <br> <input type="password" class="input-box" name="password" placeholder="Enter your password"><br><br>
            
            <button type="submit" name="reg-btn" class="reg-btn">Register</button>
            </div>
    </div>
</div>


<?php footer();?>


</body>
</html>