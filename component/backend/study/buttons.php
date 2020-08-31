<?php 

    if (isset($_POST["button"]) && isset($_POST["card_id"]) && isset($_POST["day"]) && isset($_POST["ease"]) && isset($_POST["status"])) {
        require_once "../dbh.php";
        $button  = $_POST["button"];
        $card_id = $_POST["card_id"];
        $day     = $_POST["day"];
        $ease    = $_POST["ease"];
        $status  = $_POST["status"];

        switch ($button) {
            case "good":
                button_good($dbh, $card_id, $day, $ease, $status);
                break;
            case "again":
                button_again($dbh, $card_id, $day, $ease, $status);
                break;
            
            case "easy":
                button_easy($dbh, $card_id, $day, $ease, $status);
                break;
        }

    }

    // AGAIN EASY
    function button_easy($dbh, $card_id, $day, $ease, $status) {
        $date = new DateTime("NOW");
        $easeIncrease = 10;
        $ease += $easeIncrease;

        switch ($status) {
            case "0":
                $day = (int)1;
                $date->add(new DateInterval('PT10M'));
                break;

            case "1":
                $day = (int)2;
                $date->add(new DateInterval('P'. $day .'D'));
                break;

            default:
                $day = (int)($ease/100) * ($day + 1);
                $date->add(new DateInterval('P'. $day .'D'));
                break;
        }

        
        $new_date = $date->format('Y-m-d H:i:s');
        $status = 2;
        update_card($dbh, $card_id, $status, $ease, $day, $new_date);
    }

    // AGAIN BUTTON
    function button_again($dbh, $card_id, $day, $ease, $status) {
        $date = new DateTime("NOW");
        $date->add(new DateInterval('PT10M'));
        $new_date = $date->format('Y-m-d H:i:s');

        $status = 1;
        update_card($dbh, $card_id, $status, $ease, $day, $new_date);
    }
    // GOOD BUTTON
    function button_good($dbh, $card_id, $day, $ease, $status) {
        $easeIncrease = 2;
        $date = new DateTime("NOW");
        $ease += $easeIncrease;

        switch ($status) {
            case "0":
                $status = 1;
                $date->add(new DateInterval('PT10M'));
                break;

            case "1":
                $status = 2;
                $day = (int)1;
                $date->add(new DateInterval('P1D'));
                break;

            default:
                $status = 2;
                $day = (int)($ease/100) * $day;
                $date->add(new DateInterval('P'. $day .'D'));
                break;
        }

        $new_date = $date->format('Y-m-d H:i:s');
        update_card($dbh, $card_id, $status, $ease, $day, $new_date);
        
    }

    function update_card($dbh, $card_id, $status, $ease, $day, $new_date) {
        $query = "UPDATE `card` SET `status`= $status,`ease`= $ease,`day`= $day,`review_date` = '$new_date' WHERE `id` = $card_id";
        $sth = $dbh->prepare($query);
        $sth->execute();
    }
?>