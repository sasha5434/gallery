<div id="config">
    <h2>Редактирование конфигурации.</h2>
    <form method="POST">
        <h3>Настрока соединения с БД:</h3>
        <p><b>* MySQL Host:</b>	<input type="text" name="mysqlHost" size="30" required="required" value="{mysqlHost}"></p>
        <p><b>* MySQL Login:</b>	<input type="text" name="mysqlUser" size="30" required="required" value="{mysqlUser}"></p>
        <p><b>* MySQL Pass:</b>	<input type="text" name="mysqlPassword" size="30" required="required" value="{mysqlPassword}"></p>
        <p><b>* MySQL Base:</b>	<input type="text" name="mysqlBase" size="30" required="required" value="{mysqlBase}"></p>
        <hr>
        <h3>Администрирование:</h3>
        <p><b>* Учётка админа:</b>	<input type="text" name="adminLogin" size="30" required="required" value="{adminLogin}"></p>
        <hr>
        <h3>Настроки отображения:</h3>
        <p><b>* Название сайта:</b>	<input type="text" name="title" size="30" required="required" value="{title}"></p>
        <p><b>* Блоков в выводе:</b>	<input type="text" name="perPage" size="30" required="required" value="{perPage}"></p>
        <p><b>* Язык:</b>
            <select name="lang">
                <option value="{lang}" hidden=""></option>
                <option selected="selected" value="ru">Русский</option>
                <option value="en">English</option>
            </select></p>
        <p><b>* Ширина миниатюры:</b>	<input type="text" name="thumbWidth" size="30" required="required" value="{thumbWidth}"></p>
        <p><b>* Высота миниатюры:</b>	<input type="text" name="thumbHeight" size="30" required="required" value="{thumbHeight}"></p>
        <hr>
        <h3>Аватары:</h3>
        <p><b>* Папка с аватарами:</b>	<input type="text" name="avatarDir" size="30" required="required" value="{avatarDir}"></p>
        <p><b>* Ширина аватаров:</b>	<input type="text" name="avatarWidth" size="30" required="required" value="{avatarWidth}"></p>
        <p><b>* Высота аватаров:</b>	<input type="text" name="avatarHeight" size="30" required="required" value="{avatarHeight}"></p>
        <hr>
        <h3>Конвертация видео:</h3>
        <p><b>* Ширина видео:</b>	<input type="text" name="videoWidth" size="30" required="required" value="{videoWidth}"></p>
        <p><b>* Высота видео:</b>	<input type="text" name="videoHeight" size="30" required="required" value="{videoHeight}"></p>
        <p><b>* Битрейт видео:</b>	<input type="text" name="videoBitrate" size="30" required="required" value="{videoBitrate}"></p>
        <p><b>* Кол-во аудио каналов:</b>	<input type="text" name="audioChannels" size="30" required="required" value="{audioChannels}"></p>
        <p><b>* Битрейт аудио:</b>	<input type="text" name="audioBitrate" size="30" required="required" value="{audioBitrate}"></p>
        <p><b>* Аудио кодек:</b>	<input type="text" name="audioCodec" size="30" required="required" value="{audioCodec}"></p>
        <hr>
        <h3>Пути к папкам на сервере:</h3>
        <p><b>* Корень сайта:</b>	<input type="text" name="siteDir" size="30" required="required" value="{siteDir}"></p>
        <p><b>* Временные файлы тут:</b>	<input type="text" name="tmpDir" size="30" required="required" value="{tmpDir}"></p>
        <p><b>* Тут картинки:</b>	<input type="text" name="uploadDir" size="30" required="required" value="{uploadDir}"></p>
        <p><b>* Тут их миниатюры:</b>	<input type="text" name="thumbDir" size="30" required="required" value="{thumbDir}"></p>
        <p><b>* Тут видео:</b>	<input type="text" name="uploadVideoDir" size="30" required="required" value="{uploadVideoDir}"></p>
        <p><b>* Папка стоп кадров:</b>	<input type="text" name="uploadVideoPrevDir" size="30" required="required" value="{uploadVideoPrevDir}"></p>
        <p><b>* Тут их миниатюры:</b>	<input type="text" name="uploadVideoPrevThumbDir" size="30" required="required" value="{uploadVideoPrevThumbDir}"></p>
        <hr>
        <h3>reCAPCHA:</h3>
        <p><b>Публичный ключ:</b>	<input type="text" name="reSiteKey" size="30" value="{reSiteKey}"></p>
        <p><b>Секретный ключ:</b>	<input type="text" name="reSecretKey" size="30" value="{reSecretKey}"></p>
        <hr>
        <p><button  name="submit" type="submit" class="btn-auth">Отправить</button></p>
    </form>
    <small>* Поля, отмеченные звёздочкой, являются обязательными для заполнения</small>
</div>
<br/><br/><br/>