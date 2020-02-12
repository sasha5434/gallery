<!DOCTYPE html>
<html lang="ru">

    <head>
        <title>{title}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" href="/design/image/favicon.ico" type="image/x-icon">
        <link href="/design/css/style.css" type="text/css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="module" async="async" src="/design/js/main.js"></script>
        <link href="/design/player/mediaelementplayer.min.css" type="text/css" rel="stylesheet">
        <script src="/design/player/mediaelement-and-player.min.js"></script>
    </head>
    <body>
        <div class="wrapper">
            <!-- button -->
            <div class="button"> <span class="line"></span> <span class="line"></span> <span class="line"></span> </div>
            <header>
                <div class="left-block">
                    <a href="/"><img src="/design/image/home.png" alt="Home" /></a>
                </div>
                <div class="right-block">
                    <p> {login} </p>
                </div>
            </header>
            <div class="lie-header"> </div>
            <div class="midle">
                <!-- navbar menu -->
                <div class="menu">
                    <nav>
                        <ul>
                            <li> <a href="/">Home</a> </li>
                            <li> <a href="/?type=image">Images</a> </li>
                            <li> <a href="/?type=video">Video</a> </li>
                            <li> <a href="/?do=upload">Upload Image</a> </li>
                            <li> <a href="/?do=upload&amp;method=video">Upload Video</a> </li>
                                {admLink}
                        </ul>
                    </nav>
                </div>
                <br />
                <br />
                <div class="content">
                    {content} 
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="left-block">
                <form method="POST">
                    <p>Language: <select name="setlang" onchange="this.form.submit()">
                            <option value="ru"> Russian </option>
                            <option selected="selected" value="en"> English </option>
                        </select></p>
                </form>
            </div>
            <div class="right-block">
                <p>© Aleksandr Modenov - 2018</p>
            </div>
        </div>
    </body>
</html>