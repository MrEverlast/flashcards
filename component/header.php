
<div class="ui top fixed menu inverted" style="margin-left: 92px; width: calc(100% - 92px);height: 71px;">
    <div class="item">Flashcards</div>
    <div class="right menu" >
        <div class="item">
            <div class="right menu">
                <?php if (!isset($_SESSION["username"]) && !isset($_SESSION["email"])) { ?>
                    <div id="signin_button" class="ui primary button">
                        <i class="user icon"></i>
                        Sign-in
                    </div>
                    <div id="login_button" class="ui white button">
                        <i class="user icon"></i>
                        Login
                    </div>
                <?php } else { ?>
                    <div class="ui right dropdown borderless item">
                        <i class="user big icon"></i>
                        <?= $_SESSION["username"] ?>
                        <div class="menu">
                            <div id="button_disconnect" class="item">
                                Disconnect
                                <i class="icon power"></i>
                            </div>
                        </div>
                    </div>
                    <script>
                        $('.ui.dropdown').dropdown();

                        $('#button_disconnect').on('click', () => {
                            $.ajax({
                                url: "component/backend/disconnect.php"
                                }).done(() => {
                                location.reload();
                            });
                        });
                        
                    </script>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
