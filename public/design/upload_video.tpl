				<h2>Загрузка видео (mp4, avi, mkv, wmv)</h2>
				<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
				<form id="uploadvideo" name="uploadvideo" action="/?do=upl&method=video" method="post" enctype="multipart/form-data">
				<div class="example-1">
				  <div class="form-group">
				    <label class="label">
				      <i class="material-icons">attach_file</i>
				      <span class="title">Добавить файл</span>
				      <input type="file" name="video">
				    </label>
				  </div>
				</div>
				<br>
				<input type="submit" value="Загрузить" class="btn-auth">
				<br>
				</form>
				<div id="progress" class="progress" style="display:none;">
				    <progress id="prog1" max="100" value="0"></progress>
				    <div class="progress-value"> Загружено</div>
				    <div class="progress-bg"><div class="progress-bar"></div></div>
				</div>
				<div id="result"></div>
				<div id="progress2" class="progress" style="display:none;">
				    <progress id="prog2" max="100" value="0"></progress>
				    <div class="progress-value"> Обработано</div>
				    <div class="progress-bg"><div class="progress-bar"></div></div>
				</div>
				<div id="result2" style="display:none;">Обработка видео завершена!<br/><br/>
					<ul>
					<li> <a href="/">Главная стпаница сайта</a> </li>
					<li> <a href="/?do=upload">Загрузить изображение</a> </li>
					<li> <a href="/?do=upload&amp;method=video">Загрузить ещё одно видео</a> </li>
				</ul>
				</div>
				<script type="text/javascript">
				var convStatusUpdate;
				function readTextFile(file)
				{
				    var rawFile = new XMLHttpRequest();
				    rawFile.open("GET", file, false);
				    rawFile.onreadystatechange = function ()
				    {
				        if(rawFile.readyState === 4)
				        {
				            if(rawFile.status === 200 || rawFile.status == 0)
				            {
				                var allText = rawFile.responseText;
				                document.getElementById('prog2').value = allText;
				                if (allText > 1) {
									document.getElementById('progress2').style.display = 'block';
								}
								if (allText == 100) {
									clearInterval(convStatusUpdate);
									document.getElementById('result2').style.display = 'block';
								}
				            }
				        }
				    }
				    rawFile.send(null);
				}
				document.forms.uploadvideo.onsubmit = function() {
				    var file = this.elements.video.files[0];
				    if (file) {
				        upload(file);
				    }
				    return false;
				}

				function upload(file) {
					var xhr = new XMLHttpRequest();
					xhr.upload.onprogress = function(event) {
						var percentComplete = Math.round(event.loaded / event.total * 100);
						document.getElementById('prog1').value = percentComplete;
						if (event.loaded > 1) {
							document.getElementById('progress').style.display = 'block';
							document.getElementById('uploadvideo').style.display = 'none';
						}
				    }
				    xhr.open("POST", "/?do=upl&method=video", true);
				    var formData = new FormData();
				    formData.append("video", file);
				    xhr.send(formData);
				    xhr.onload = function () { 
						var response = xhr.responseText;
				  		document.getElementById('result').innerHTML = response;
				  		var randomName = response.split('%@').pop();
				  		randomName = randomName.split('@%').shift();
						var convStatusURL = "/?do=upl&method=status&file=" + randomName;
						convStatusUpdate = setInterval(readTextFile, 5000, convStatusURL);
					};
				}
				</script>