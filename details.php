<?php
    include 'functions/DataManager.php';
    include 'functions/MonsterManager.php';
    include 'layouts/Navigation.php';
    include 'layouts/Footer.php';
    include 'layouts/Head.php';

    $data = new DataManager('http://localhost/Lol-Heroes/LoL-Champions-Website/php-champions-rest-api/api/champion/');
    session_start();
    
    
    if(isset($_POST["delete"])){
        if($_SESSION['check'] == 1){
            $api_url = '/delete_champion.php';
            $data->delete_object($api_url, $_SESSION['obj_id']);
        } elseif ($_SESSION['check'] == 2){
            $api_url = '/delete_monster.php';
            $data->delete_object($api_url, $_SESSION['obj_id']);
        } elseif ($_SESSION['check'] == 3){
            $api_url = '/delete_buff.php';
            $data->delete_object($api_url, $_SESSION['obj_id']);
        }
        
        
        header("location: index.php");
        exit;
    }

    if(isset($_POST["update"])){
        echo $_SESSION['check'];
        if($_SESSION['check'] == 1){
            $api_url = '/update_champion.php';
            $data->update_object($api_url, $_POST);
        } elseif ($_SESSION['check'] == 2){
            $api_url = '/update_monster.php';
            $data->update_object($api_url, $_POST);
        } elseif ($_SESSION['check'] == 3){
            $api_url = '/update_buff.php';
            $data->delete_object($api_url, $_SESSION['obj_id']);
        }
        // header("location: index.php");
        // exit;
    }
?>

<!DOCTYPE html>
<html lang="pl">
<?php head(); ?>

<body class="details-body">
    <div class="header" id="header">

    </div>

    <?php navbar(); ?>

    <div class="details-wrapper">
        <div class="details-box">
            <form method="POST">
            <?php 
                $api_url = '/show_champion.php?name=' . $_GET['name'];
                $_SESSION['obj_id'] = $data->show_all_info($api_url); 
                $_SESSION['check'] = 1;
                if($_SESSION['obj_id'] == false){
                    $api_url = '/show_monster.php?name=' . $_GET['name'];
                    $_SESSION['obj_id'] = $data->show_all_info($api_url); 
                    $_SESSION['check'] = 2;
                    if($_SESSION['obj_id'] == false){
                        $api_url = '/show_buff.php?name=' . $_GET['name'];
                        $_SESSION['obj_id'] = $data->show_all_info($api_url); 
                        $_SESSION['check'] = 3;
                        if($_SESSION['obj_id'] == false){
                            echo "<br>There is no such object in database!<br>";
                        }
                    }
                }
                    
                
                
            ?><br>
            
        </div>
    </div>
</div>


<?php footer();?>

</body>
</html>