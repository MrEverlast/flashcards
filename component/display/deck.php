<?php 
// SELECT B.id_screen, B.title, B.date, C.username, C.rank, D.avatar
// FROM `like` A
// INNER JOIN `screen` B ON B.id_screen = A.id_screen AND A.id_user_like = '$id_user'
// INNER JOIN `user` C ON C.id_user = B.id_user
// INNER JOIN `user_social` D ON D.id_user = C.id_user
// ORDER BY B.date DESC LIMIT $nb_screen,12

// SELECT A.`name`, A.`description`, COUNT(B.`id`) AS nbr_card
// FROM `deck` A
// INNER JOIN `card` B ON A.`id` = B.`id_deck` AND A.`id` = 2

$sth = $dbh->prepare("SELECT A.`name`, A.`description`, COUNT(B.`id`) AS nbr_card
                      FROM `deck` A
                      INNER JOIN `card` B ON A.`id` = B.`id_deck` AND A.id_account = ? AND A.`id` = ?");
$sth->execute(array($_SESSION["id"], $_GET["deck_id"]));
$data_deck = $sth->fetchAll()[0];

$sth = $dbh->prepare("SELECT `front`, `back`, `status` FROM `card` WHERE `id_deck` = ?");
$sth->execute(array($_GET["deck_id"]));
$data_cards = $sth->fetchAll();

if ($data_deck["name"]) { ?>

<div class="ui container">
    <div class="ui huge header">
        <div class="content">
            <?= $data_deck["name"]; ?>
            <!-- <i class="icon link edit"></i> -->
        </div>
        <div id="add_card_button" class="ui labeled right floated button" tabindex="0">
            <div class="ui basic button blue">
                <i class="plus icon"></i> Add a card
            </div>
            <a class="ui basic left pointing label blue">
                <?= $data_deck["nbr_card"]; ?>
            </a>
            <?php include_once "component/modal/card.php"; ?>
        </div>
        
    </div>
    <div class="ui segment">
        <?php if ($data_deck["description"]) { echo $data_deck["description"]; } else echo "No description." ; ?>
    </div>
    <div class="ui divider"></div>
    <div class="ui header">
        Cards
    </div>
    <div class="ui cards">
        <?php 
            foreach ($data_cards as $key => $value) {
                ?>
                    <div class="card <?= card_status_color($value["status"]); ?>" data-tooltip="<?= $value["back"]; ?>" data-inverted="" data-position="bottom center">
                        <div class="content">
                        <div class="ui <?= card_status_color($value["status"]); ?> top attached label tiny"><?= card_status_text($value["status"]); ?></div>
                            <div class="ui header">
                            <?= $value["front"]; ?>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
</div>



<?php } else {
    echo "Deck not found";
}
    

function card_status_color($status) {
    if ($status == 0) return "blue";
    if ($status == 1) return "orange";
    if ($status == 2) return "green";
    if ($status == 3) return "red";
}
function card_status_text($status) {
    if ($status == 0) return "To be learn";
    if ($status == 1) return "Learning";
    if ($status == 2) return "Learned";
    if ($status == 3) return "Stranded";
}
?>
