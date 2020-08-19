<div id="signin_modal" class="ui tiny modal">
    <div class="header center">Sign-in</div>
    <div class="content">
        <form action="component/backend/account.php" method="post" class="ui form" autocomplete="on">
            <div class="required field">
                <label>Email</label>
                <input type="email" name="email" placeholder="example@example.com">
            </div>
            <div class="required field">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username321">
            </div>
            <div class="required field">
                <label>Password</label>
                <input type="password" name="new-password" placeholder="Password">
            </div>
            <div class="required field">
                <label>Confirm password</label>
                <input type="password" name="confirm-password" placeholder="Confirm password">
            </div>
            <button class="ui button" type="submit">Submit</button>
        </form>
    </div>
</div>
<script>
    $('#signin_modal')
        .modal('attach events', '#signin_button', 'show')
    ;
</script>