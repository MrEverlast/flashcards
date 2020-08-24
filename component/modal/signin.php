<div id="signin_modal" class="ui tiny modal">
    <i class="close icon"></i>
    <div class="header center">Sign-in</div>
    <div class="content">
        <form id="form_signin" class="ui form" method="post" autocomplete="on">
            <div class="required field">
                <label>Email</label>
                <input class="signin" type="email" name="email" placeholder="example@example.com">
            </div>
            <div class="required field">
                <label>Username</label>
                <input class="signin" type="text" name="username" placeholder="Username321">
            </div>
            <div class="required field">
                <label>Password</label>
                <input class="signin" type="password" name="new_password" placeholder="Password">
            </div>
            <div class="required field">
                <label>Confirm password</label>
                <input class="signin" type="password" name="confirm_password" placeholder="Confirm password">
            </div>
            <div id="message_signin_error" class="ui error message"></div>
            <button class="ui button" type="submit">Submit</button>
        </form>
    </div>
</div>
<script>
    $('#signin_modal').modal({
        closable: false
    }).modal('attach events', '#signin_button', 'show');
    $("#form_signin").submit(function(event) {
        let email            = $(".signin[name='email']").first().val();
        let username         = $(".signin[name='username']").first().val();
        let new_password     = $(".signin[name='new_password']").first().val();
        let confirm_password = $(".signin[name='confirm_password']").first().val();
        let error            = $("#message_signin_error");
        event.preventDefault();

        if (email.trim() && username.trim() && new_password.trim() && confirm_password.trim()){ 
            if (new_password === confirm_password) {
                $(".signin[name='new_password']").parent().removeClass("error");
                $(".signin[name='confirm_password']").parent().removeClass("error");
                error.removeClass("visible");
                
                $.ajax({
                    type: "POST",
                    url: "component/backend/account.php",
                    data: { 
                        email : email,
                        username : username,
                        new_password : new_password
                        },
                    success: (data) => {
                        if (data === "account_error") {
                            error.html("<p>Email or username are already taken.</p>");
                            error.addClass("visible");
                        } else if (data === "success") {
                            location.reload();
                        } else if (data === "account_length") {
                            error.html("<p>Inputs lenghts are not valid.</p>");
                            error.addClass("visible");
                        } else {
                            error.html("<p>Error.</p>");
                            error.addClass("visible");
                        }
                    }
                });

            } else {
                $(".signin[name='new_password']").parent().addClass("error");
                $(".signin[name='confirm_password']").parent().addClass("error");
                error.html("<p>The two password don't match.</p>");
                error.addClass("visible");
            }
        }
    });
</script>