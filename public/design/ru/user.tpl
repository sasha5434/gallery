<div class="user">
	<img src="/{avatar}" alt="avatar">
	<p>Ид: {id} </p>
	<p>Логин: {login}</p>
	<p>Почта Email: {email}</p>
	<p>Зарегистрирован: {regdate}</p>
	<p>Загрузил файлов: <a href="/?user_id={id}">{uploadCount}</a></p>
	<form {hideUpload} enctype="multipart/form-data" method="post">
		<p><input name="avatar" type="file"></p>
		<input type="submit" value="Загрузить аватар" class="btn-auth">
	</form>
</div>