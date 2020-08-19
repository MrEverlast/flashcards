<?php
define('ROOTPATH', __DIR__);
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once(ROOTPATH."/component/head.php") ?>
<body style="margin-left: 92px; width: calc(100% - 92px);">
    <?php include_once(ROOTPATH."/component/header.php"); ?>
    <?php include_once(ROOTPATH."/component/sidebar.php"); ?>
    <?php include_once(ROOTPATH."/component/modal/signin.php"); ?>
    <?php include_once(ROOTPATH."/component/modal/login.php"); ?>
    <div style="margin-top: 71px;"></div>
    <h1 class="ui center aligned icon header">
        Please login to get access to your decks
    </h1>
    
</body>
</html>