<?php 
    // INSERT INTO `account` (`id`, `username`, `email`, `password`) VALUES (NULL, 'Everlast', 'max.brooks@gmail.com', 'test');
    try
    {
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=flashcards;charset=utf8', 'root', '');
        // * Sign-in * //

        if (isset($_POST["username"])) $username   = htmlspecialchars($_POST["username"]);
        if (isset($_POST["email"]))    $email      = htmlspecialchars($_POST["email"]);
        if (isset($_POST["email"]))    $password   = htmlspecialchars($_POST["new_password"]);

        if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["new_password"])) {
            $sth = $dbh->prepare("SELECT COUNT(`id`) FROM `account` WHERE `username` = ? OR `email` = ?");
            $sth->execute(array($username, $email));
            $row = $sth->fetchColumn();
            if ($row >= 1) {
                echo "account_error";
            } else {
                if (strlen($username) <= 20 && strlen($email) <= 100 && strlen($password) <= 200) {
                    $sth = $dbh->prepare("INSERT INTO `account` (`id`, `username`, `email`, `password`) VALUES (NULL, ?, ?, ?)");
                    $sth->execute(array($username, $email, $password));
                    create_session($dbh->lastInsertId(), $username, $email);
                    echo "success";
                } else {
                    echo "account_length";
                }
            }
        } else if(isset($_POST["email"]) && isset($_POST["new_password"])) {
            $sth = $dbh->prepare("SELECT COUNT(`id`) AS 'exist', `id`, `username` FROM `account` WHERE `email` = ? AND `password` = ?");
            $sth->execute(array($email, $password));
            $data = $sth->fetchAll()[0];
            if ($data["exist"] >= 1) {
                create_session($data["id"], $data["username"], $email);
                echo "success";
            } else {
                echo "error";
            }
        }
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    
    function get_account_id($dbh, $email) {

    }

    function create_session($id, $username, $email) {
        session_start();
        $_SESSION["id"]       = $id;
        $_SESSION["username"] = $username;
        $_SESSION["email"]    = $email;
    }


?>