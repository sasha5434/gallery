<div id="config">
    <h2> Editing the configuration. </h2>
    <form method="POST">
        <h3> Setting up a database connection: </h3>
        <p> <b> * MySQL Host: </b>
            <input type="text" name="mysqlHost" size="30" required="required" value="{mysqlHost}"> </p>
        <p> <b> * MySQL Login: </b>
            <input type="text" name="mysqlUser" size="30" required="required" value="{mysqlUser}"> </p>
        <p> <b> * MySQL Pass: </b>
            <input type="text" name="mysqlPassword" size="30" required="required" value="{mysqlPassword}"> </p>
        <p> <b> * MySQL Base: </b>
            <input type="text" name="mysqlBase" size="30" required="required" value="{mysqlBase}"> </p>
        <hr>
        <h3> Administration: </h3>
        <p> <b> * Admin account: </b>
            <input type="text" name="adminLogin" size="30" required="required" value="{adminLogin}"> </p>
        <hr>
        <h3> Display Settings: </h3>
        <p> <b> * Site name: </b>
            <input type="text" name="title" size="30" required="required" value="{title}"> </p>
        <p> <b> * Blocks in output: </b>
            <input type="text" name="perPage" size="30" required="required" value="{perPage}"> </p>
        <p> <b> * Language: </b>
            <select name="lang">
                <option value="{lang}" hidden=""> </option>
                <option value="ru"> Russian </option>
                <option selected="selected" value="en"> English </option>
            </select>
        </p>
        <p> <b> * Thumbnail width: </b>
            <input type="text" name="thumbWidth" size="30" required="required" value="{thumbWidth}"> </p>
        <p> <b> * Thumbnail height: </b>
            <input type="text" name="thumbHeight" size="30" required="required" value="{thumbHeight}"> </p>
        <hr>
        <h3> Avatars: </h3>
        <p> <b> * Avatars here: </b>
            <input type="text" name="avatarDir" size="30" required="required" value="{avatarDir}"> </p>
        <p> <b> * Avatar width: </b>
            <input type="text" name="avatarWidth" size="30" required="required" value="{avatarWidth}"> </p>
        <p> <b> * Avatar height: </b>
            <input type="text" name="avatarHeight" size="30" required="required" value="{avatarHeight}"> </p>
        <hr>
        <h3> Video Conversion: </h3>
        <p> <b> * Video width: </b>
            <input type="text" name="videoWidth" size="30" required="required" value="{videoWidth}"> </p>
        <p> <b> * Video height: </b>
            <input type="text" name="videoHeight" size="30" required="required" value="{videoHeight}"> </p>
        <p> <b> * Video bitrate: </b>
            <input type="text" name="videoBitrate" size="30" required="required" value="{videoBitrate}"> </p>
        <p> <b> * Num of audio channels: </b>
            <input type="text" name="audioChannels" size="30" required="required" value="{audioChannels}"> </p>
        <p> <b> * Audio bitrate: </b>
            <input type="text" name="audioBitrate" size="30" required="required" value="{audioBitrate}"> </p>
        <p> <b> * Audio codec: </b>
            <input type="text" name="audioCodec" size="30" required="required" value="{audioCodec}"> </p>
        <hr>
        <h3> Paths to folders on the server: </h3>
        <p> <b> * Root of the site: </b>
            <input type="text" name="siteDir" size="30" required="required" value="{siteDir}"> </p>
        <p> <b> * Temporary files here: </b>
            <input type="text" name="tmpDir" size="30" required="required" value="{tmpDir}"> </p>
        <p> <b> * Here are the pictures: </b>
            <input type="text" name="uploadDir" size="30" required="required" value="{uploadDir}"> </p>
        <p> <b> * Their thumb are here: </b>
            <input type="text" name="thumbDir" size="30" required="required" value="{thumbDir}"> </p>
        <p> <b> * Video here: </b>
            <input type="text" name="uploadVideoDir" size="30" required="required" value="{uploadVideoDir}"> </p>
        <p> <b> * Still picture folder: </b>
            <input type="text" name="uploadVideoPrevDir" size="30" required="required" value="{uploadVideoPrevDir}"> </p>
        <p> <b> * Their thumb are here: </b>
            <input type="text" name="uploadVideoPrevThumbDir" size="30" required="required" value="{uploadVideoPrevThumbDir}"> </p>
        <hr>
        <h3> reCAPCHA: </h3>
        <p> <b> Public key: </b>
            <input type="text" name="reSiteKey" size="30" value="{reSiteKey}"> </p>
        <p> <b> Secret key: </b>
            <input type="text" name="reSecretKey" size="30" value="{reSecretKey}"> </p>
        <hr>
        <p>
            <button name="submit" type="submit" class="btn-auth"> Send </button>
        </p>
    </form> <small> * Fields marked with an asterisk are required </small> </div>
<br/>
<br/>
<br/>