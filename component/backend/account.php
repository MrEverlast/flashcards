<?php 
    // INSERT INTO `account` (`id`, `username`, `email`, `password`) VALUES (NULL, 'Everlast', 'max.brooks@gmail.com', 'test');
    try
    {
        $dbh = new PDO('mysql:host=localhost;dbname=flashcards;charset=utf8', 'root', '');
        // * Sign-in * //
        if(isset($_POST["username"]) && isset($_POST["email"]) &&  isset($_POST["new-password"]) && isset($_POST["confirm-password"]))
        {
            $sth = $dbh->prepare("SELECT COUNT(`id`) FROM `account` WHERE `username` = ? OR `email` = ?");
            $sth->execute(array($_POST["username"], $_POST["email"]));
            $row = $sth->fetchColumn();
            if ($row >= 1) {
                echo "account_error";
            } else {
                $sth = $dbh->prepare("INSERT INTO `account` (`id`, `username`, `email`, `password`) VALUES (NULL, ?, ?, ?)");
                $sth->execute(array($_POST["username"], $_POST["email"], $_POST["new-password"]));
                echo "success";
            }
        }
        // * Login * //
        if(isset($_POST["email"]) && isset($_POST["new-password"]))
        {
            $sth = $dbh->prepare("SELECT COUNT(`id`) FROM `account` WHERE `email` = ? AND `password` = ?");
            $sth->execute(array($_POST["email"], $_POST["new-password"]));
            $row = $sth->fetchColumn();
            if ($row >= 1) {
                echo "success";
            } else {
                echo "error";
            }
        }
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    


?>