<?php 
session_start();
    if (isset($_POST["deck_id"]) && isset($_POST["exec_script"])) {
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=flashcards;charset=utf8', 'root', '');
        $data_deck = get_data_deck($dbh, $_POST["deck_id"]);

        switch ($_POST["exec_script"]) {
            case 'onStart':
                if($data_deck["card_left_study_session"] == NULL) {
                    $data_deck["card_left_study_session"] = $data_deck["max_new_learning_card"];
                }
                echo json_encode(get_study_session_data($dbh, $_POST["deck_id"], $data_deck["card_left_study_session"]));

                break;
            
            default:
                echo "error";
                break;
        }


    } else {

        echo "error";
    }


    function get_study_session_data($dbh, $deck_id, $session_card) {

        $query  =  "(SELECT *
                    FROM `card`
                    WHERE `id_deck` = $deck_id AND `review_date` < CURRENT_TIMESTAMP AND `status` = 0 LIMIT $session_card)
                    UNION ALL
                    (SELECT *
                    FROM `card`
                    WHERE `id_deck` = $deck_id AND `review_date` < CURRENT_TIMESTAMP AND `status` = 1 OR `status` = 2)";

        $sth = $dbh->prepare($query);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS);
    }

    function get_data_deck($dbh, $deck_id) {
        $query  =  "SELECT A.`name`, A.`description`, COUNT(B.`id`) AS nbr_card, A.`max_new_learning_card`, A.`card_left_study_session`
                    FROM `deck` A
                    INNER JOIN `card` B ON A.`id` = B.`id_deck` AND A.id_account = ? AND A.`id` = ?";

        $sth = $dbh->prepare($query);
        $sth->execute(array($_SESSION["id"], $deck_id));
        return $sth->fetchAll()[0];
    }

?>