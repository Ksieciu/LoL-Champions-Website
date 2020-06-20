<?php
    include 'functions/DataManager.php';
    include 'functions/MonsterManager.php';
    $data = new DataManager('http://localhost/Lol-Heroes/LoL-Champions-Website/php-champions-rest-api/api/champion/');
    $monster_data = new MonsterManager('http://localhost/Lol-Heroes/LoL-Champions-Website/php-champions-rest-api/api/champion/');
   // $data = new DataManager('http://localhost/Lol-Heroes/LoL-Champions-Website/php-champions-rest-api/api/champion/');

   if(isset($_POST['sbutton'])){
        $header_url = 'location: ' . 'details.php?name=' . $_POST['ch_search'];
        header($header_url);
        exit;
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
<body>
    <div class="header" id="header">

    </div>
<div class="stick-nav">
<ul class="nav-elements">
    <li class="right-elem"></li>
    <li ><a href="#chemp_find">Find your champion</a></li>
    <li><a href="#add_new">Add new champion</a></li>
    <li><a href="#show_all">Show all Champions</a></li>
    <li><a href="#monster_button">Show all Monsters</a></li>
    

    <li class="left-elem"></li>
    <li title="Register"><a href="./register.php">
        <svg class="bi bi-person-plus" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M11 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM1.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM6 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm4.5 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
          <path fill-rule="evenodd" d="M13 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/></a>
        </svg></li>
          
        <li title="Login"><a href="./login.php">
        <svg class="bi bi-door-closed" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2zm1 0v13h8V2H4z"/>
            <path d="M7 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            <path fill-rule="evenodd" d="M1 15.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z"/></a>
          </svg></li>       
           
         <li title="Log out"><a href="">
              <svg class="bi bi-box-arrow-in-right" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8.146 11.354a.5.5 0 0 1 0-.708L10.793 8 8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0z"/>
                  <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 1 8z"/>
                  <path fill-rule="evenodd" d="M13.5 14.5A1.5 1.5 0 0 0 15 13V3a1.5 1.5 0 0 0-1.5-1.5h-8A1.5 1.5 0 0 0 4 3v1.5a.5.5 0 0 0 1 0V3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5h-8A.5.5 0 0 1 5 13v-1.5a.5.5 0 0 0-1 0V13a1.5 1.5 0 0 0 1.5 1.5h8z"/>
              </a>    </svg></li>
            

        <li title="My favourites" class=""><a href="#your_list"><a href="#fav">
        <svg class="bi bi-heart" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/></a>
          </svg></li>

    <li title="Go UP to the home page"><a href="#header">
        <svg class="bi bi-house" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/></a>
        </svg></li>
   
</ul><hr>

    </div>


    <div class="search-block">
   

            <div class="search-box">
                <h2 id="chemp_find">Find your champion</h2>
                <form method="post">
                <input type="search" class="input-box" name="ch_search" placeholder=" Find your champion..."><br>
                    <button type="submit" name="sbutton" id="sbutton">
                        <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                  </svg>Search</button>
                  </form>
            </div>

    </div>


    <div class="module-wrapper-invert">

        <div class="add-box">
    
            <h2 id="add_new"> Add new champion</h2><form method="POST" name="add_new" style="align-items: center;">
            Champions ID:<br> <input type="number" class="input-box" name="id" placeholder="Enter your champions id"><br> 
            Champions name:<br> <input type="text" class="input-box" name="name" placeholder="Enter your champions name"><br> 
            Champions title: <br> <input type="text" class="input-box" name="title" placeholder="Enter your champions title"><br>
            Champions description:<br>  <input type="text" class="input-box" name="description" placeholder="Enter your champions description"><br>
            Champions icon URL:<br>  <input type="text" class="input-box" name="icon" placeholder="Past yours icon url"><br>

        </div>
            <button type="submit" id="add_champ" onclick="<?php $result = $data->create_champion($_POST); ?>">Add</button> </form>
        

    </div>

    
    <div class="module-wrapper-pure">

        
            <h2 id="show_all"> List of all Champions</h2>
           <!---       <button type="submit" name="show_button" id="show_button" method="POST">SHOW ALL</button> -->  
      
            <?php  
             
            $data->show_champs_icons('show_all_champions.php'); ?>

        
    </div>
</div>
    <div class="module-wrapper-monster">

    
           List of all Neutral Monsters<br>
       <!---         <button type="submit" name="monster_button" id="monster_button">SHOW ALL</button> -->  
            
             <?php $monster_data->show_monsters_icons('show_all_monsters.php'); ?>

        

    </div>

    <div class="module-wrapper-buff">

    
List of Buffs <br>
  <!--- -->  

 <?php $monster_data->show_monsters_icons('show_all_monsters.php'); ?>



</div>

<footer>
    © 2020 by WW Dev - Sebastian Winiarski & Piotr Wroblewski
</footer>

<script src="scripts/navscript.js"></script>
</body>
</html>