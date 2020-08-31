<?php 

    $data_deck = get_data_deck($dbh);

?>
<div id="start_session" style="height:100%;">

    <div class="ui middle aligned center aligned grid" style="height: 100%;">
    <div class="column" style="max-width: 1080px;">
        <p style="font-size: 24px;">
            You are about to start a study session of <b><?= $data_deck["name"]; ?></b> deck.
        </p>
        <?php if ($data_deck["description"]) { ?>
            <div class="ui segment">
                <?= $data_deck["description"]; ?>
            </div>
        <?php } ?>
        <div id="start_session_button" class="ui button blue">
            Start session
        </div>
    </div>
    </div>
</div>
<script>
    let cards;
    let start_session_div = $("#start_session");
    let current_card = 0;
    $("#start_session_button").on('click', () => {
        let deck_id = <?= $data_deck["id"]; ?>;
        $.ajax({
            type: "POST",
            url: "component/backend/study/cards.php",
            data: { 
                deck_id : deck_id,
                exec_script : "onStart"
                },
            success: (data) => {
                cards = $.parseJSON(data);
                console.log(cards);
                start_session(cards);
            }
        });
    });
// BUTTON AGAIN
    let button_again = () => {
        let card = cards[0];
        let button = "again";
        let ease = 250;
        let day = 0;
        $.ajax({
            type: "POST",
            url: "component/backend/study/buttons.php",
            data: { 
                button : button,
                card_id : card.id,
                day : day,
                ease : ease,
                status : card.status
                },
            success: (data) => {
                cards[0].status = "1";
                cards.push(cards.shift());
                display_card(cards, 0);
            }
        });
        
    };
// BUTTON GOOD
    let button_good = () => {
        let card = cards[0];
        let button = "good";
        $.ajax({
            type: "POST",
            url: "component/backend/study/buttons.php",
            data: { 
                button : button,
                card_id : card.id,
                day : card.day,
                ease : card.ease,
                status : card.status
                },
            success: (data) => {
                if (card.status != 0) {
                    cards.splice(0, 1);
                } else {
                    cards[0].status = "1";
                    cards.push(cards.shift());
                }
                    display_card(cards, 0);
                console.log(data);
            }
        });
    };
// BUTTON EASY
    let button_easy = (status) => {
        let card = cards[0];
        let button = "easy";
        $.ajax({
            type: "POST",
            url: "component/backend/study/buttons.php",
            data: { 
                button : button,
                card_id : card.id,
                day : card.day,
                ease : card.ease,
                status : card.status
                },
            success: (data) => {
                cards.splice(0, 1);
                display_card(cards, 0);
                console.log(cards);
            }
        });
    };
// BUTTON HARD
    let button_hard = (status) => {
        let button = "hard";

        cards.splice(0, 1);
        console.log(cards);
    };

    let start_session = (cards) => {
        display_card(cards, current_card);
    }

    let display_card = (cards, card_index) => {
        let card = cards[card_index];
        $.ajax({
            type: "POST",
            url: "component/backend/study/display/card.php",
            data: { 
                card_id : card.id,
                card_front : card.front,
                card_back : card.back,
                card_status : card.status
                },
            success: (data) => {
                start_session_div.html(data);
            }
        });
    }
</script>

<?php 

function get_data_deck($dbh) {

    $query  =  "SELECT A.`id`, A.`name`, A.`description`, A.`max_new_learning_card`
                FROM `deck` A
                INNER JOIN `card` B ON A.`id` = B.`id_deck` AND A.id_account = ? AND A.`id` = ?";

    $sth = $dbh->prepare($query);
    $sth->execute(array($_SESSION["id"], $_GET["deck_id"]));
    return $sth->fetchAll()[0];
}
?>
