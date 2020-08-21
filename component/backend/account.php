<?php 
    // INSERT INTO `account` (`id`, `username`, `email`, `password`) VALUES (NULL, 'Everlast', 'max.brooks@gmail.com', 'test');
    try
    {
        $dbh = new PDO('mysql:host=localhost;dbname=flashcards;charset=utf8', 'root', '');
        // * Sign-in * //
        if(isset($_POST["username"]) && isset($_POST["email"]) &&  isset($_POST["new_password"])) {
            $sth = $dbh->prepare("SELECT COUNT(`id`) FROM `account` WHERE `username` = ? OR `email` = ?");
            $sth->execute(array($_POST["username"], $_POST["email"]));
            $row = $sth->fetchColumn();
            if ($row >= 1) {
                echo "account_error";
            } else {
                $sth = $dbh->prepare("INSERT INTO `account` (`id`, `username`, `email`, `password`) VALUES (NULL, ?, ?, ?)");
                $sth->execute(array($_POST["username"], $_POST["email"], $_POST["new_password"]));
                create_session($_POST["username"], $_POST["email"]);
                echo "success";
            }
        } else if(isset($_POST["email"]) && isset($_POST["new_password"])) {
            $sth = $dbh->prepare("SELECT COUNT(`id`) FROM `account` WHERE `email` = ? AND `password` = ?");
            $sth->execute(array($_POST["email"], $_POST["new_password"]));
            $row = $sth->fetchColumn();
            if ($row >= 1) {
                $sth = $dbh->prepare("SELECT `username` FROM `account` WHERE `email` = ?");
                $sth->execute(array($_POST["email"]));
                $data = $sth->fetchAll()[0];
                create_session($data["username"], $_POST["email"]);
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

    function create_session($username, $email) {
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
    }


?>