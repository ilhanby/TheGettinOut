$(window).on("load", function (e) {
    $(".preLoader").fadeOut(500);
    $(".preDiv").delay(500).fadeIn(1000);
});

$(document).ready(function () {
    $sidebar = $('.sidebar');

    $sidebar_img_container = $sidebar.find('.sidebar-background');

    $full_page = $('.full-page');

    $sidebar_responsive = $('body > .navbar-collapse');

    window_width = $(window).width();

    $('.fixed-plugin a').click(function (event) {
        if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
                event.stopPropagation();
            } else if (window.event) {
                window.event.cancelBubble = true;
            }
        }
    });

    $('.fixed-plugin .active-color span').click(function () {
        $full_page_background = $('.full-page-background');

        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
        }

        if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
        }

        if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
        }
    });

    $('.fixed-plugin .background-color .badge').click(function () {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('background-color');

        if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
        }
    });

    $('.fixed-plugin .img-holder').click(function () {
        $full_page_background = $('.full-page-background');

        $(this).parent('li').siblings().removeClass('active');
        $(this).parent('li').addClass('active');


        var new_image = $(this).find("img").attr('src');

        if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function () {
                $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                $sidebar_img_container.fadeIn('fast');
            });
        }

        if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function () {
                $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                $full_page_background.fadeIn('fast');
            });
        }

        if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
        }

        if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
        }
    });

    $('.switch-sidebar-image input').change(function () {
        $full_page_background = $('.full-page-background');

        $input = $(this);

        if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
                $sidebar_img_container.fadeIn('fast');
                $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
                $full_page_background.fadeIn('fast');
                $full_page.attr('data-image', '#');
            }

            background_image = true;
        } else {
            if ($sidebar_img_container.length != 0) {
                $sidebar.removeAttr('data-image');
                $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
                $full_page.removeAttr('data-image', '#');
                $full_page_background.fadeOut('fast');
            }

            background_image = false;
        }
    });

    $('.switch-sidebar-mini input').change(function () {
        $body = $('body');

        $input = $(this);

        if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .jumbotron').perfectScrollbar();

        } else {

            $('.sidebar .sidebar-wrapper, .jumbotron').perfectScrollbar('destroy');

            setTimeout(function () {
                $('body').addClass('sidebar-mini');

                md.misc.sidebar_mini_active = true;
            }, 300);
        }

        var simulateWindowResize = setInterval(function () {
            window.dispatchEvent(new Event('resize'));
        }, 180);

        setTimeout(function () {
            clearInterval(simulateWindowResize);
        }, 1000);

    })

    var sidewidth = $("#sidebar").width();
    $("#navigation-example").css("margin-left", sidewidth);

    var appURL = 'http://the.localhost/';
    //var appURL = 'https://www.thegettinout.com/';

    $(".categoryLink").on("click", function () {
        $(".categoryLink").parent().removeClass("active");
        $(this).parent().addClass("active");
        $(".itemList").fadeToggle("fast");

        var formData = {};
        formData['Id'] = $(this).data("value");
        formData['action'] = "evList";
        $.ajax({
            url: appURL + 'includes/_ajax.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                $(".itemList").html(data);
                $(".itemList").fadeToggle("fast");
                $(".main-panel").scrollTop(0);
            }
        });
    });

    $(".fixed-item").mouseenter(function () {
        $(this).css("margin-right", "20px");
    }).mouseleave(function () {
        $(".fixed-item").css("margin-right", "0");
    });

    $("#mailGonder").on("click", function () {
        var formData = {};
        formData['mailisim'] = $("#mailisim").val();
        formData['mailAdres'] = $("#mailAdres").val();
        formData['mailKonu'] = $("#mailKonu").val();
        formData['mailMesaj'] = $("#mailMesaj").val();
        $("#mailForm").submit(function (e) {
            $.ajax({
                url: appURL + 'includes/_mail.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    alert("Gönderildi");
                    $("#darkModalForm").click();
                    $("#mailForm")[0].reset()
                }
            });
        });
        $(".main-panel").scrollTop(0);
    });

    $("#searchBtn").click(function () {
        var inp = $("#searchInput");
        if (inp.val() === "" || inp.val().length < 1)
            inp.focus();
        else {
            $(".itemList").fadeToggle("fast");
            var formData = {};
            formData['action'] = "searchList";
            formData['search'] = inp.val();
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $(".itemList").html(data);
                    $(".itemList").fadeToggle("fast");
                    $(".main-panel").scrollTop(0);
                }
            });
        }
    });

    $(".anaLogo").click(function () {
        $(".categoryLink").parent().removeClass("active");
        $(".itemList").fadeToggle("fast");
        var formData = {};
        formData['action'] = "dashboardShow";
        $.ajax({
            url: appURL + 'includes/_ajax.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                $(".itemList").html(data);
                $(".itemList").fadeToggle("fast");
                $(".main-panel").scrollTop(0);
            }
        });
    });
    $(".anaLogo").click();

    $(window).resize(function () {
        var width = document.body.clientWidth;
        if (width < 992) {
            $("#searchBtn , #searchInput").hide();
        } else {
            $("#searchBtn , #searchInput").show();
        }
    });
});

var input = document.getElementById("searchInput");
input.addEventListener("keyup", function (event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("searchBtn").click();
    }
});

