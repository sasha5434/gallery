				<div class="view-block">
				<video id="movie" controls poster="{prev}" preload="none">
					<source src="{link}" type="video/mp4">
					Тег video не поддерживается вашим браузером. <a href="{link}">Скачайте видео</a>.
				</video>
					<br />
					<div class="block-left"><time datetime="{date}">{date}</time></div>
					<div class="block-right"> {Links} загрузил: <a href="{userlink}">{user}</a></div>
					<br />
				</div>
				<br />
				<div class="page-block"> <a href="/#" onclick="javascript:history.back(); return false;">Назад</a> </div>
				<script>
					var v = document.getElementById("movie");
					document.getElementById("movie").volume = 0.5;
					v.onclick = function() {
					    if (v.paused) {
					        v.play();
					    } else {
					        v.pause();
					    }
					};
				</script>