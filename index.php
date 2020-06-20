<?php
    include 'functions/DataManager.php';
    include 'functions/MonsterManager.php';
    include 'layouts/Navigation.php';
    include 'layouts/Footer.php';
   
    $data = new DataManager('http://localhost/Lol-Heroes/LoL-Champions-Website/php-champions-rest-api/api/champion/');
    $monster_data = new MonsterManager('http://localhost/Lol-Heroes/LoL-Champions-Website/php-champions-rest-api/api/champion/');

   session_start();
   if(!$_SESSION['loggedin']){
       $_SESSION['loggedin'] = false;
   }

   if(isset($_POST['sbutton'])){
        $header_url = 'location: ' . 'details.php?name=' . $_POST['ch_search'];
        header($header_url);
        exit;
   }
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

<body>
    <div class="header" id="header">

    </div>
<?php navbar(); ?>
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
    <div class="module-wrapper-monster" id="monstaa">

    
           List of all Neutral Monsters<br>
       <!---         <button type="submit" name="monster_button" id="monster_button">SHOW ALL</button> -->  
            
             <?php $monster_data->show_monsters_icons('show_all_monsters.php'); ?>

        

    </div>

    <div class="module-wrapper-buff" id="buff">

    
List of Buffs <br>
  <!--- -->  

 <?php $monster_data->show_buffs_icons('show_all_buffs.php'); ?>



</div>
<?php footer();?>

</body>
</html>