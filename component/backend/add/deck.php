<?php 
session_start();
    try {

        $dbh = new PDO('mysql:host=localhost;dbname=flashcards;charset=utf8', 'root', '');

        if (isset($_POST["name"]))         $name         = htmlspecialchars($_POST["name"]);
        if (isset($_POST["description"]))  $description  = htmlspecialchars($_POST["description"]);
        if (isset($_POST["new_card_day"])) $new_card_day = htmlspecialchars($_POST["new_card_day"]);

        if (isset($_SESSION["id"])) {
            $id_account = $_SESSION["id"];
            if(isset($_POST["name"]) && isset($_POST["new_card_day"])) {
                $sth = $dbh->prepare("INSERT INTO `deck` (`id`, `id_account`, `name`, `description`, `max_new_learning_card`) VALUES (NULL, ?, ?, ?, ?)");
                $sth->execute(array($id_account, $name, $description, $new_card_day));
                echo "success";
            }
        } else echo "error_session";
        
        
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
?>