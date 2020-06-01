$(window).load(function () {
    $("#preloader").fadeOut("slow");
});

$(document).ready(function () {
    new WOW().init();

    $('#top-nav').onePageNav({
        currentClass: 'current',
        changeHash: true,
        scrollSpeed: 1000
    });

    //animated header class
    $(window).scroll(function () {
        $('#navbarResponsive ul li').removeClass('current');
        var scroll = $(window).scrollTop();
        if (scroll > 200) {
            $('#logChangeWhite').slideUp(0);
            $('#logChangeBlack').slideDown(250);
            $(".navigation").addClass("animated");
        } else {
            $('#logChangeBlack').slideUp(0);
            $('#logChangeWhite').slideDown(250);
            $(".navigation").removeClass("animated");
        }
    });

    $(".about-slider").owlCarousel(
        {
            singleItem: true,
            pagination: true,
            autoPlay: 3000,
        }
    );

    $('.carousel-testimony').owlCarousel({
        // Most important owl features
        items:3,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [980,2],
        itemsTablet: [768,2],
        itemsTabletSmall: false,
        itemsMobile : [479,1],
        singleItem : false,

        //Basic Speeds
        slideSpeed : 250,
        paginationSpeed : 800,
        rewindSpeed : 1000,

        //Autoplay
        autoPlay : 2000,
        stopOnHover : true,

        // Navigation
        navigation : false,
        navigationText : ["prev","next"],
        rewindNav : true,
        scrollPerPage : false,

        //Pagination
        pagination : false,
        paginationNumbers: false,

        // Responsive
        responsive: true,
        responsiveRefreshRate : 200,
        responsiveBaseWidth: window,

        // CSS Styles
        baseClass : "owl-carousel",
        theme : "owl-theme",

        //Lazy load
        lazyLoad : false,
        lazyFollow : true,

        //Auto height
        autoHeight : true,

        //Mouse Events
        mouseDrag : true,
        touchDrag : true,
    });

    $('.menu li .nav-link').on('click', function () {
        if ($(document).width() < 975) {
            setTimeout(function () {
                $("#mobileBtn").click();
            }, 1100);
        }
    });


    $("#contact-form").validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            message: {
                required: true,
                minlength: 10
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            name: {
                required: "Lütfen İsminiz Giriniz.",
                minlength: "Minimum 3 Karakter Giriniz."
            },
            message: {
                required: "Lütfen Mesajınızı Giriniz.",
                minlength: "Minimum 10 Karakter Giriniz."
            },
            email: "Lütfen Geçerli Bir E-mail Adresi Giriniz."
        },
        submitHandler: function (form) {
            $(form).ajaxSubmit({
                type: "POST",
                data: $(form).serialize(),
                url: "includes/_mail.php",
                success: function () {
                    $('#contact-form :input').attr('disabled', 'disabled');
                    $('#contact-form').fadeTo("slow", 0.15, function () {
                        $(this).find(':input').attr('disabled', 'disabled');
                        $(this).find('label').css('cursor', 'default');
                        $('#success').fadeIn();
                    });
                },
                error: function () {
                    $('#contact-form').fadeTo("slow", 0.15, function () {
                        $('#error').fadeIn();
                    });
                }
            });
        }
    });

});