<div class="user">
	<img src="/{avatar}" alt="avatar">
	<p>Id: {id} </p>
	<p>Login: {login}</p>
	<p>Email: {email}</p>
	<p>Registered: {regdate}</p>
	<p>Files uploaded: <a href="/?id={id}">{uploadCount}</a></p>
	<form {hideUpload} enctype="multipart/form-data" method="post">
		<p><input name="avatar" type="file"></p>
		<input type="submit" value="Upload avatar" class="btn-auth">
	</form>
</div>