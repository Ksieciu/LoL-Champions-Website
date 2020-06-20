<?php
    include 'functions/DataManager.php';
    include 'functions/MonsterManager.php';
    $data = new DataManager('http://localhost/Lol-Heroes/LoL-Champions-Website/php-champions-rest-api/api/champion/');
    session_start();

    if(isset($_POST["delete"])){
        $api_url = '/delete_champion.php';
        $data->delete_object($api_url, $_SESSION['obj_id']);
        
        header("location: index.php");
        exit;
    }

    if(isset($_POST["update"])){

        $api_url = '/update_champion.php';
        $data->update_object($api_url, $_POST);

        foreach ($_POST as $key => $value) {
            echo $key . ': ' . $value;
        }
        // header("location: index.php");
        // exit;
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>League of Legends - Champions</title>
    <!--- global css with basic styling and favicon -->
    <link rel="stylesheet" href="css/global.css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;400&display=swap" rel="stylesheet">
</head>
<body class="details-body">
    <div class="header" id="header">

    </div>
<div class="stick-nav">
<ul class="nav-elements">
    <li class="right-elem"></li>
    <li ><a href="./index.php#chemp_find">Find your champion</a></li>
    <li><a href="./index.php#add_new">Add new champion</a></li>
    <li><a href="./index.php#show_all">Show all Champions</a></li>
    <li><a href="./index.php#monster_button">Show all Monsters</a></li>
    

    <li class="left-elem"></li>
    <li title="Register"><a href="./register.php">
        <svg class="bi bi-person-plus" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M11 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM1.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM6 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm4.5 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
          <path fill-rule="evenodd" d="M13 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/></a>
        </svg></li>

          
        <li title="Login/Logout"><a href="./logout.php">
        <svg class="bi bi-door-closed" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2zm1 0v13h8V2H4z"/>
            <path d="M7 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            <path fill-rule="evenodd" d="M1 15.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z"/></a>
          </svg></li>    



    <li title="Go UP to the home page"><a href="./index.php#header">
        <svg class="bi bi-house" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/></a>
        </svg></li>
   
</ul><hr>

    </div>
    <div class="details-wrapper">
        <div class="details-box">
            <form method="POST">
            <?php 
                $api_url = '/show_champion.php?name=' . $_GET['name'];
                $_SESSION['obj_id'] = $data->show_all_info($api_url); 
                
            ?><br>
            
        </div>
    </div>
</div>


  <footer>

    © 2020 by WW Dev - Sebastian Winiarski & Piotr Wroblewski

</footer> 

<script src="scripts/navscript.js"></script>

</body>
</html>