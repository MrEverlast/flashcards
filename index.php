<?php
session_start();
define('ROOTPATH', __DIR__);
$dbh = new PDO('mysql:host=127.0.0.1;dbname=flashcards;charset=utf8', 'root', '');

?>

<!DOCTYPE html>
<html lang="en">
<?php include_once(ROOTPATH."/component/head.php") ?>
<body style="margin-top: 83px; margin-left: 92px; width: calc(100% - 92px); height: calc(100% - 71px);">
    <?php include_once(ROOTPATH."/component/header.php"); ?>
    <?php include_once(ROOTPATH."/component/sidebar.php"); ?>
    <?php 
        if (!isset($_SESSION["username"]) && !isset($_SESSION["email"])) {
            include_once(ROOTPATH."/component/modal/signin.php");
            include_once(ROOTPATH."/component/modal/login.php"); 

            ?> 
            <h1 class="ui center aligned icon header">
                Please login to get access to your decks
            </h1>
    <?php 
        } else if (isset($_GET["deck_id"])) {
            
            include_once "component/display/deck.php";

        } else { ?>
            <div id="display_main" class="ui container">
                <div class="ui four cards">
                <?php 
                        //$dbh = new PDO('mysql:host=127.0.0.1;dbname=flashcards;charset=utf8', 'root', '');

                        $sth = $dbh->prepare("SELECT `id`, `name`, `description` FROM deck WHERE `id_account` = ?");
                        $sth->execute(array($_SESSION["id"]));
                        $data = $sth->fetchAll();
                        foreach ($data as $key => $value) {
                            ?>
                            <a class="ui card" href="?deck_id=<?= $value['id']; ?>">
                                <div class="content">
                                <!-- <i class="red right floated icon close"></i> -->
                                <div class="header">
                                    <?= $value['name']; ?>
                                </div>
                                <div class="description">
                                    <?= $value['description']; ?>
                                </div>
                                </div>
                            </a>
                            <?php
                        }
                ?>
                </div>
                
            </div>
    <?php 
        } 
    ?>
    
    
</body>
</html>