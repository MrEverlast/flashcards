<?php 
    try {
        $sth = $dbh->prepare("SELECT `id`, `name` FROM deck WHERE `id_account` = ?");
        $sth->execute(array($_SESSION["id"]));
        $data = $sth->fetchAll();
        foreach ($data as $key => $value) {
            ?>
            <a class="item <?= isDeckActive($_GET["deck_id"], $value["id"]); ?>" href="?deck_id=<?= $value["id"] ?>">
                <i class="th icon"></i>
                <?= $value["name"] ?>
            </a> 
            <?php
        }

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    function isDeckActive($deck_id, $deck_value_id) {
        if ($deck_id == $deck_value_id) return "active";
    }
?>
  
 
