<?php 
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=flashcards;charset=utf8', 'root', '');

        $sth = $dbh->prepare("SELECT `id`, `name` FROM deck WHERE `id_account` = ?");
        $sth->execute(array($_SESSION["id"]));
        $data = $sth->fetchAll();
        foreach ($data as $key => $value) {
            ?>
            <a class="item" data-id="<?= $value["id"] ?>">
                <i class="th icon"></i>
                <?= $value["name"] ?>
            </a> 
            <?php
        }

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

?>
  
 
