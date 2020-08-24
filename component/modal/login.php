<div id="login_modal" class="ui tiny modal">
    <i class="close icon"></i>
    <div class="header center">Login</div>
    <div class="content">
        <form id="form_login" method="post" class="ui form" autocomplete="on">
            <div class="required field">
                <label>Email</label>
                <input class="login" type="email" name="email" placeholder="example@example.com">
            </div>
            <div class="required field">
                <label>Password</label>
                <input class="login" type="password" name="new_password" placeholder="Password">
            </div>
            <div id="message_login_error" class="ui error message"></div>
            <button class="ui button" type="submit">Submit</button>
        </form>
    </div>
</div>
<script>
    $('#login_modal').modal({
        closable: false
    }).modal('attach events', '#login_button', 'show');
    $("#form_login").submit(function(event) {
        let email            = $(".login[name='email']").first().val();
        let new_password     = $(".login[name='new_password']").first().val();
        let error            = $("#message_login_error");
        event.preventDefault();

        if (email.trim() && new_password.trim()) {
            $(".login[name='email']").parent().removeClass("error");
            $(".login[name='new_password']").parent().removeClass("error");
            error.removeClass("visible");
            console.log("yooooooh");
            
            $.ajax({
                type: "POST",
                url: "component/backend/account.php",
                data: { 
                    email : email,
                    new_password : new_password
                    },
                success: (data) => {
                    console.log(data);
                    if (data === "error") {
                        error.html("<p>Email or password are no match.</p>");
                        error.addClass("visible");
                    } else {
                        location.reload();
                    }
                }
            });            
        } else {
            $(".login[name='email']").parent().addClass("error");
            $(".login[name='new_password']").parent().addClass("error");
            error.html("<p>Please fill all inputs.</p>");
            error.addClass("visible");
        }
    });
</script>