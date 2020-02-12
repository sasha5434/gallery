<div class="view-block">
    <video id="movie" width="640" height="360" style="max-width:100%;" poster="{prev}" preload="none" controls playsinline webkit-playsinline>
        <source src="{link}" type="video/mp4">
        <object width="640" height="360" type="application/x-shockwave-flash" data="/design/player/player.swf">
            <param name="movie" value="/design/player/player.swf" />
            <param name="flashvars" value="autostart=true&amp;controlbar=over&amp;image=/{prev}&amp;file=/{link}" />
            <img src="/{prev}" width="640" height="360" title="No video playback capabilities" />
            Тег video не поддерживается вашим браузером. <a href="{link}">Скачайте видео</a>.
        </object>
    </video>
    <br />
    <div class="block-left"><time datetime="{date}">{date}</time></div>
    <div class="block-right"> {Links} загрузил: <a href="{userlink}">{user}</a></div>
    <br />
</div>
<br />
<div class="page-block"> <a href="/#" onclick="javascript:history.back();
                                        return false;">Назад</a> </div>
<script src="/design/player/lang/ru.js"></script>
<script>
    mejs.i18n.language('ru'); 
    $('video:not(.mep-playlist)').mediaelementplayer({
        "features": ['playpause', 'current', 'progress', 'duration', 'tracks', 'volume', 'fullscreen'],
    });
</script>
