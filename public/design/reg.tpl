
<div class="auth">
{errors}
	<h3>Регистрация</h3>
	<form  id="reg_form" method="POST">
		<div class="form-auth">
			<input  id="login" name="login" type="text" class="form-auth-2" value="" placeholder="Логин" required />
		</div>
		<div class="form-auth">
            		<input id="pass" name="password" type="password" class="form-auth-2" value="" placeholder="Пароль" required />
         	</div>
		<div class="form-auth">
            		<input id="re_pass" name="password2" type="password" class="form-auth-2" value="" placeholder="Пароль ещё раз" required />
         	</div>
		<div id="mail" class="form-auth">
            		<input name="email" type="email" class="form-auth-2" value="" placeholder="E-mail" required />
         	</div>
     		<div class="form-auth">
            		<button  name="submit" type="submit" class="btn-auth">Зарегистрироваться</button>
		</div>
	</form>
</div>
