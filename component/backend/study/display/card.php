<?php 

if (isset($_POST["card_id"]) && isset($_POST["card_front"]) && isset($_POST["card_back"]) && isset($_POST["card_status"])) {

    ?>
    <div class="ui middle aligned center aligned grid" style="height: 100%;">
        <div class="column" style="max-width: 1080px;">
            
                <div class="ui card centered <?= card_status_color($_POST["card_status"]) ?>">
                    <div class="content" style="font-size:24px;">
                    <div class="ui top right attached label tiny <?= card_status_color($_POST["card_status"]) ?>"><?= card_status_text($_POST["card_status"]) ?></div>
                        <?= $_POST["card_front"] ?>
                    </div>
                    <div id="back_card" class="ui content message hidden" style="font-size:24px;">
                    <?= $_POST["card_back"] ?>
                    </div>
                </div>
                <div id="show_answer" class="ui button">
                    Show answer
                </div>

                <div id="valid_study" class="ui container message hidden" data-status="<?= $_POST["card_status"] ?>">
                    <div onclick="button_again(<?= $_POST['card_status'] ?>)" id="button_again" class="ui button basic red">Again < 10min </div>
                    <?php if($_POST["card_status"] != 0) { ?> <div id="button_hard" class="ui button basic orange">Hard</div> <?php } ?>
                    <div onclick="button_good(<?= $_POST['card_status'] ?>)" id="button_good" class="ui button basic blue">Good</div>
                    <div id="button_easy" class="ui button basic green">Easy</div>
                </div>

        </div>
    </div>

<script>
    $('#show_answer').on('click', (e) => {
        $(e.target).hide();
        $("#back_card").removeClass("hidden");
        $("#valid_study").removeClass("message");
    });
</script>

    <?php

}

function card_status_color($status) {
    if ($status == 0) return "blue";
    if ($status == 1) return "orange";
    if ($status == 2) return "green";
    if ($status == 3) return "red";
}
function card_status_text($status) {
    if ($status == 0) return "New";
    if ($status == 1) return "Learning";
    if ($status == 2) return "Learned";
    if ($status == 3) return "Stranded";
}

?>