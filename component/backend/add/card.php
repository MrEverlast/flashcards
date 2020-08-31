<?php 
session_start();
    try {

        require_once "../dbh.php";

        if (isset($_POST["deck_id"])) $deck_id = htmlspecialchars($_POST["deck_id"]);
        if (isset($_POST["front"]))   $front   = htmlspecialchars($_POST["front"]);
        if (isset($_POST["back"]))    $back    = htmlspecialchars($_POST["back"]);

        if (isset($_SESSION["id"])) {
            $id_account = $_SESSION["id"];
            if(isset($_POST["deck_id"]) && isset($_POST["front"]) && isset($_POST["back"])) {
                $sth = $dbh->prepare("INSERT INTO `card` (`id`, `id_deck`, `front`, `back`) VALUES (NULL, ?, ?, ?)");
                $sth->execute(array($deck_id, $front, $back));
                echo "success";
            }
        } else echo "error_session";
        
        
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
?>