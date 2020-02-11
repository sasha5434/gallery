/**
 * меню
 */
        $(function () {
            /*--------- show and hide the menu  ---*/
            $('.button').on("click", function () {
                if ($('.menu').hasClass('nav_is_visible') == true) {
                    $('.menu').removeClass('nav_is_visible');
                    $('.button').removeClass('close');
                } else {
                    $('.menu').addClass('nav_is_visible');
                    $('.button').addClass('close');
                }
            });

            $('.menu').addClass('home_is_visible');


            function removeClasses() {
                $(".menu ul li").each(function () {
                    var custom_class = $(this).find('a').data('class');
                    $('.menu').removeClass(custom_class);
                });
            }
        });

$(document).ready(function () {

    $('input[type="file"]').change(function () {
        var value = $("input[type='file']").val();
        $('.js-value').text(value);
    });

});
