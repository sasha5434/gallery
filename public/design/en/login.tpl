
<div class="auth">
{errors}
<h3> Enter your username and password </h3>
    <form method="POST">
        <div class="form-auth">
            <input name="login" type="text" class="form-auth-2" value="" placeholder="Login" required /> </div>
        <div class="form-auth">
            <input name="password" type="password" class="form-auth-2" value="" placeholder="Password" required /> </div>
        <div>
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" /> </div>
        <div class="form-auth">
            <button name="submit" type="submit" class="btn-auth"> Login </button>
        </div>
    </form>
	<script src="https://www.google.com/recaptcha/api.js?render={reSiteKey}"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{reSiteKey}', {action: 'homepage'}).then(function(token) {
                console.log(token);
                document.getElementById('g-recaptcha-response').value=token;
            });
        });
    </script>
</div>
