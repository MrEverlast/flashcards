<div id="login_modal" class="ui tiny modal">
    <div class="header center">Login</div>
    <div class="content">
        <form method="post" class="ui form" autocomplete="on">
            <div class="required field">
                <label>Email</label>
                <input type="email" name="email" placeholder="example@example.com">
            </div>
            <div class="required field">
                <label>Password</label>
                <input type="password" name="new-password" placeholder="Password">
            </div>
            <button class="ui button" type="submit">Submit</button>
        </form>
    </div>
</div>
<script>
    $('#login_modal')
        .modal('attach events', '#login_button', 'show')
    ;
</script>