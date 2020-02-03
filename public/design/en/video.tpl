				<div class="view-block">
				<video id="movie" controls poster="{prev}" preload="none">
					<source src="{link}" type="video/mp4">
					The video tag is not supported by your browser. <a href="{link}">Download video</a>.
				</video>
					<br />
					<div class="block-left">{date}</div>
					<div class="block-right"> {Links} uploaded: <a href="{userlink}">{user}</a></div>
					<br />
				</div>
				<br />
				<div class="page-block"> <a href="/#" onclick="javascript:history.back(); return false;">Back</a> </div>
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