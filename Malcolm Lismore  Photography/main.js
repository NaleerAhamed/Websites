$(document).ready(function() {
    $(window).scroll(function() {
        if (this.scrollY > 20) {
            $('.navbar').addClass("sticky");
        } else {
            $('.navbar').removeClass("sticky");
        }
    });

    // Navigation click function
    $('.menu-btn').click(function() {
        $('.navbar .menu').toggleClass("active");
        $(this).find('i').toggleClass("active");
    });
});
