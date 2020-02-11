<!DOCTYPE html>
<html lang="ru">

    <head>
        <title>{title}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" href="/design/image/favicon.ico" type="image/x-icon">
        <link href="/design/css/style.css" type="text/css" rel="stylesheet">
        <script src="/design/js/jquery.min.js"></script>
        <script type="module" async="async" src="/design/js/main.js"></script>
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
                            <li> <a href="/">Главная</a> </li>
                            <li> <a href="/?type=image">Картинки</a> </li>
                            <li> <a href="/?type=video">Видео</a> </li>
                            <li> <a href="/?do=upload">Загрузить изображение</a> </li>
                            <li> <a href="/?do=upload&amp;method=video">Загрузить видео</a> </li>
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
                    <p>Язык: <select name="setlang" onchange="this.form.submit()">
                            <option selected="selected" value="ru">Русский</option>
                            <option value="en">English</option>
                        </select></p>
                </form>
            </div>
            <div class="right-block">
                <p>© Aleksandr Modenov - 2018</p>
            </div>
        </div>
    </body>

</html>