$(function() {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $(".wrapper").toggleClass("active");
    });

    $('.dashboard-nav ul li').on('click', function() {
        $('.dashboard-nav ul li').removeClass('active');
        $('section').addClass('hidden');
        $(this).addClass('active');
        
        if ($(this).hasClass('nav-account')) {
            $('section.account').removeClass('hidden');
        } else if ($(this).hasClass('nav-activity')) {
            $('section.activity').removeClass('hidden');
        } else if ($(this).hasClass('nav-admin')) {
            $('section.admin').removeClass('hidden');
        }
    });

    $('.add-comment').on('focus', function() {
        $(this).addClass('focus');
    });
});