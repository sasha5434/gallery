
<div class="auth">
{errors}
    <h3> Registration </h3>
    <form id="reg_form" method="POST">
        <div class="form-auth">
            <input id="login" name="login" type="text" class="form-auth-2" value="" placeholder="Login" required /> </div>
        <div class="form-auth">
            <input id="pass" name="password" type="password" class="form-auth-2" value="" placeholder="Password" required /> </div>
        <div class="form-auth">
            <input id="re_pass" name="password2" type="password" class="form-auth-2" value="" placeholder="Password again" required /> </div>
        <div id="mail" class="form-auth">
            <input name="email" type="email" class="form-auth-2" value="" placeholder="E-mail" required /> </div>
        <div>
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" /> </div>
        <div class="form-auth">
            <button name="submit" type="submit" class="btn-auth"> Register </button>
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
