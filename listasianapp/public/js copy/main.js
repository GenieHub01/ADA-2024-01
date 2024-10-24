$(document).ready(function(){
    $('.list-tree li').click(function(){
        $(this).toggleClass('open');
    });
    $('.mob-menu-toggle').click(function(){
        $('header').toggleClass('open');
        $('body').toggleClass('mobile-menu-open');
    });
    $('.adv-toggle').click(function(){
        $('.adv-advanced').toggleClass('open');
    });

    function backToTop() {
        var scrollTrigger = 400; // px
        var scrollTop = $(window).scrollTop();
        if (scrollTop > scrollTrigger) {
            $('#back-to-top').addClass('show');
            
        } else {
            $('#back-to-top').removeClass('show');
            
        }
    }

    backToTop();

    $(window).on('scroll', backToTop);

    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
});