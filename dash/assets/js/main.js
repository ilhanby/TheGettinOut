$(window).on("load", function (e) {
    $(".preLoader").fadeOut(500);
    $(".preDiv").delay(500).fadeIn(1000);
});

$(document).ready(function () {
    //var appURL = 'http://thedash.localhost/';
    var appURL = 'https://www.dash.thegettinout.com/';

    $(".loginBtn").on("click", function () {
        var formData = {};
        formData['name'] = $("#loginName").val();
        formData['passw'] = $("#loginPassw").val();
        formData['action'] = 'loginCont';
        if (formData['name'] !== "" && formData['passw'] !== "") {
            $.ajax({
                url: appURL + 'pages/Others/login.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    if (data !== "hata") {
                        $.toast({
                            heading: 'Success',
                            hideAfter: 1000,
                            text: 'Giriş Başarılı',
                            position: 'top-right',
                            showHideTransition: 'slide',
                            icon: 'success',
                            afterHidden: function () {
                                location.replace(appURL + "pages/Dashboard/index.php/");
                            }
                        });
                    } else {
                        $.toast({
                            heading: 'Error',
                            hideAfter: 2000,
                            text: 'Kullanıcı Adı veya Şifre Hatalı',
                            position: 'top-right',
                            showHideTransition: 'slide',
                            icon: 'error'
                        });
                    }
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        hideAfter: 2000,
                        text: 'Kullanıcı Adı veya Şifre Hatalı',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'error'
                    });
                }
            });
        }
    });
    var i = 0;
    $(".component").toggle();
    $(".componentAdd").click(function () {
        if (i === 0) {
            i = 1;
            $(this).text("VAZGEÇ").removeClass("btn-inverse-primary").addClass("btn-gradient-secondary");
        } else {
            i = 0;
            $(this).text("YENİ").addClass("btn-gradient-primary").removeClass("btn-gradient-secondary");
        }
        $(".content").toggle("fast");
        $(".component").toggle("fast");
        $(".component input, .component textarea").each(function (index, element) {
            $(this).val("");
        });

        $("#radioAcik").val("1").click();
        $("#radioKapali, #userId, #catId, #anketId , #eventId , #logId").val("0");
    });

    $(".tableCheck").each(function (index, element) {
        if ($(this).val() === "1")
            $(this).prop('checked', true);
        else
            $(this).prop('checked', false);
    });

    $(".checkbox").each(function (index, element) {
        if ($(this).val() === "1")
            $(this).attr('checked', 'checked');
        else
            $(this).removeAttr('checked');
    });

    $(".btnAnketAdd").on("click", function () {
        var formData = {};
        formData['name'] = $("#anketName").val();
        formData['description'] = $("#anketDesc").val();
        formData['kod1'] = $("#secenek1").val();
        formData['kod2'] = $("#secenek2").val();
        formData['kod3'] = $("#secenek3").val();
        formData['kod4'] = $("#secenek4").val();
        formData['durum'] = $("input[class='anketDurum']:checked").val();
        if (formData['name'] !== '' && formData['description'] !== '' && $('#anketId').val() !== "0") {
            formData['Id'] = $('#anketId').val();
            formData['action'] = 'anketUpdate';
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $.toast({
                        heading: 'Success',
                        hideAfter: 1500,
                        text: 'Başarıyla Düzenlendi',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'success',
                        afterHidden: function () {
                            location.reload();
                        }
                    });
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        hideAfter: 1500,
                        text: 'Beklenmedik bir hata ile karşılaşıldı',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'error'
                    });
                }
            });
        } else if (formData['name'] !== '' && formData['description'] !== '' && $('#anketId').val() === "0") {
            formData['action'] = 'anketAdd';
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $.toast({
                        heading: 'Success',
                        hideAfter: 1500,
                        text: 'Başarıyla Eklendi',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'success',
                        afterHidden: function () {
                            location.reload();
                        }
                    });
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        hideAfter: 1500,
                        text: 'Beklenmedik bir hata ile karşılaşıldı',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'error'
                    });
                }
            });
        } else {
            $.toast({
                heading: 'Warning',
                text: 'Boş alanları doldurunuz',
                position: 'top-right',
                showHideTransition: 'slide',
                icon: 'warning'
            });
        }
    });

    $(".anketDelete").on("click", function () {
        var formData = {};
        formData['Id'] = $(this).data("value");
        formData['action'] = 'anketDelete';
        $.ajax({
            url: appURL + 'includes/_ajax.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                $.toast({
                    heading: 'Success',
                    hideAfter: 1500,
                    text: 'Başarıyla Silindi',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'success',
                    afterHidden: function () {
                        location.reload();
                    }
                });
            },
            error: function () {
                $.toast({
                    heading: 'Error',
                    hideAfter: 1500,
                    text: 'Beklenmedik bir hata ile karşılaşıldı',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'error'
                });
            }
        });
    });

    $(".anketEdit").on("click", function () {
        $(".componentAdd").click();
        $("#anketName").val($(this).data("name"));
        $("#secenek1").val($(this).data("kod1"));
        $("#secenek2").val($(this).data("kod2"));
        $("#secenek3").val($(this).data("kod3"));
        $("#secenek4").val($(this).data("kod4"));
        $("#anketDesc").val($(this).data("desc"));
        $("#anketId").val($(this).data("value"));
        if ($(this).data("durum") === 1)
            $("#radioAcik").click();
        else
            $("#radioKapali").click();
    });

    $(".btnCatAdd").on("click", function () {
        var formData = {};
        formData['name'] = $("#catName").val();
        formData['icon'] = $("#catIcon").val();
        formData['durum'] = $("input[class='catDurum']:checked").val();
        if (formData['name'] !== '' && formData['icon'] !== '' && $('#catId').val() !== "0") {
            formData['Id'] = $('#catId').val();
            formData['action'] = 'catUpdate';
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $.toast({
                        heading: 'Success',
                        hideAfter: 1500,
                        text: 'Başarıyla Düzenlendi',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'success',
                        afterHidden: function () {
                            location.reload();
                        }
                    });
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        hideAfter: 1500,
                        text: 'Beklenmedik bir hata ile karşılaşıldı',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'error'
                    });
                }
            });
        } else if (formData['name'] !== '' && formData['icon'] !== '' && $('#catId').val() === "0") {
            formData['action'] = 'catAdd';
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $.toast({
                        heading: 'Success',
                        hideAfter: 1500,
                        text: 'Başarıyla Eklendi',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'success',
                        afterHidden: function () {
                            location.reload();
                        }
                    });
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        hideAfter: 1500,
                        text: 'Beklenmedik bir hata ile karşılaşıldı',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'error'
                    });
                }
            });
        } else {
            $.toast({
                heading: 'Warning',
                text: 'Boş alanları doldurunuz',
                position: 'top-right',
                showHideTransition: 'slide',
                icon: 'warning'
            });
        }
    });

    $(".catDelete").on("click", function () {
        var formData = {};
        formData['Id'] = $(this).data("value");
        formData['action'] = 'catDelete';
        $.ajax({
            url: appURL + 'includes/_ajax.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                $.toast({
                    heading: 'Success',
                    hideAfter: 1500,
                    text: 'Başarıyla Silindi',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'success',
                    afterHidden: function () {
                        location.reload();
                    }
                });
            },
            error: function () {
                $.toast({
                    heading: 'Error',
                    hideAfter: 1500,
                    text: 'Beklenmedik bir hata ile karşılaşıldı',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'error'
                });
            }
        });
    });

    $(".catEdit").on("click", function () {
        $(".componentAdd").click();
        $("#catName").val($(this).data("name"));
        $("#catIcon").val($(this).data("image"));
        $("#catId").val($(this).data("value"));
        if ($(this).data("durum") === 1)
            $("#radioAcik").click();
        else
            $("#radioKapali").click();
    });


    $(".btnUserAdd").on("click", function () {
        var formData = {};
        formData['name'] = $("#userName").val();
        formData['passw'] = $("#userPassw").val();
        formData['position'] = $("#userPosition").val();
        formData['mail'] = $("#userMail").val();
        formData['durum'] = $("input[class='userDurum']:checked").val();
        if (formData['name'] !== '' && formData['mail'] !== '' && $('#userId').val() !== "0") {
            formData['Id'] = $('#userId').val();
            formData['action'] = 'userUpdate';
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $.toast({
                        heading: 'Success',
                        hideAfter: 1500,
                        text: 'Başarıyla Düzenlendi',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'success',
                        afterHidden: function () {
                            location.reload();
                        }
                    });
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        hideAfter: 1500,
                        text: 'Beklenmedik bir hata ile karşılaşıldı',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'error'
                    });
                }
            });
        } else if (formData['name'] !== '' && formData['mail'] !== '' && $('#userId').val() === "0") {
            formData['action'] = 'userAdd';
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $.toast({
                        heading: 'Success',
                        hideAfter: 1500,
                        text: 'Başarıyla Eklendi',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'success',
                        afterHidden: function () {
                            location.reload();
                        }
                    });
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        hideAfter: 1500,
                        text: 'Beklenmedik bir hata ile karşılaşıldı',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'error'
                    });
                }
            });
        } else {
            $.toast({
                heading: 'Warning',
                text: 'Boş alanları doldurunuz',
                position: 'top-right',
                showHideTransition: 'slide',
                icon: 'warning'
            });
        }
    });

    $(".userDelete").on("click", function () {
        var formData = {};
        formData['Id'] = $(this).data("value");
        formData['action'] = 'userDelete';
        $.ajax({
            url: appURL + 'includes/_ajax.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                $.toast({
                    heading: 'Success',
                    hideAfter: 1500,
                    text: 'Başarıyla Silindi',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'success',
                    afterHidden: function () {
                        location.reload();
                    }
                });
            },
            error: function () {
                $.toast({
                    heading: 'Error',
                    hideAfter: 1500,
                    text: 'Beklenmedik bir hata ile karşılaşıldı',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'error'
                });
            }
        });
    });

    $(".userEdit").on("click", function () {
        $(".componentAdd").click();
        $("#userName").val($(this).data("name"));
        $("#userId").val($(this).data("value"));
        $("#userMail").val($(this).data("mail"));
        $("#userPosition").val($(this).data("position"));
        if ($(this).data("durum") === 1)
            $("#radioAcik").click();
        else
            $("#radioKapali").click();
    });

    $(".btnLogAdd").on("click", function () {
        var formData = {};
        formData['name'] = $("#logName").val();
        formData['image'] = $("#logImage").val();
        formData['durum'] = $("input[class='logDurum']:checked").val();
        if ($('#logId').val() !== "0") {
            formData['Id'] = $('#logId').val();
            formData['action'] = 'logUpdate';
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $.toast({
                        heading: 'Success',
                        hideAfter: 1500,
                        text: 'Başarıyla Düzenlendi',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'success',
                        afterHidden: function () {
                            location.reload();
                        }
                    });
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        hideAfter: 1500,
                        text: 'Beklenmedik bir hata ile karşılaşıldı',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'error'
                    });
                }
            });
        } else if (formData['name'] !== '' && $('#logId').val() === "0") {
            formData['action'] = 'logAdd';
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $.toast({
                        heading: 'Success',
                        hideAfter: 1500,
                        text: 'Başarıyla Eklendi',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'success',
                        afterHidden: function () {
                            location.reload();
                        }
                    });
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        hideAfter: 1500,
                        text: 'Beklenmedik bir hata ile karşılaşıldı',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'error'
                    });
                }
            });
        } else {
            $.toast({
                heading: 'Warning',
                text: 'Boş alanları doldurunuz',
                position: 'top-right',
                showHideTransition: 'slide',
                icon: 'warning'
            });
        }
    });

    $(".logDelete").on("click", function () {
        var formData = {};
        formData['Id'] = $(this).data("value");
        formData['action'] = 'logDelete';
        $.ajax({
            url: appURL + 'includes/_ajax.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                $.toast({
                    heading: 'Success',
                    hideAfter: 1500,
                    text: 'Başarıyla Silindi',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'success',
                    afterHidden: function () {
                        location.reload();
                    }
                });
            },
            error: function () {
                $.toast({
                    heading: 'Error',
                    hideAfter: 1500,
                    text: 'Beklenmedik bir hata ile karşılaşıldı',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'error'
                });
            }
        });
    });

    $(".logEdit").on("click", function () {
        $(".componentAdd").click();
        $("#logId").val($(this).data("value"));
        $("#logName").val($(this).data("name"));
        $("#logImage").val($(this).data("image"));
        if ($(this).data("durum") === 1)
            $("#radioAcik").click();
        else
            $("#radioKapali").click();
    });

    $(".btnEventAdd").on("click", function () {
        var formData = {};
        formData['name'] = $("#eventName").val();
        formData['konum'] = $("#eventCord").val();
        formData['description'] = $("#eventDesc").val();
        formData['image1'] = $("#eventImage1").val();
        formData['image2'] = $("#eventImage2").val();
        formData['date'] = $("#eventDate").val();
        formData['time'] = $("#eventTime").val();
        formData['categoryId'] = $("#eventCategory").val();
        formData['durum'] = $("input[class='eventDurum']:checked").val();
        if (formData['name'] !== '' && $('#eventId').val() !== "0") {
            formData['Id'] = $('#eventId').val();
            formData['action'] = 'eventUpdate';
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $.toast({
                        heading: 'Success',
                        hideAfter: 1500,
                        text: 'Başarıyla Düzenlendi',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'success',
                        afterHidden: function () {
                            location.reload();
                        }
                    });
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        hideAfter: 1500,
                        text: 'Beklenmedik bir hata ile karşılaşıldı',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'error'
                    });
                }
            });
        } else if (formData['name'] !== '' && $('#eventId').val() === "0") {
            formData['action'] = 'eventAdd';
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    $.toast({
                        heading: 'Success',
                        hideAfter: 1500,
                        text: 'Başarıyla Eklendi',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'success',
                        afterHidden: function () {
                            location.reload();
                        }
                    });
                },
                error: function () {
                    $.toast({
                        heading: 'Error',
                        hideAfter: 1500,
                        text: 'Beklenmedik bir hata ile karşılaşıldı',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'error'
                    });
                }
            });
        } else {
            $.toast({
                heading: 'Warning',
                text: 'Boş alanları doldurunuz',
                position: 'top-right',
                showHideTransition: 'slide',
                icon: 'warning'
            });
        }
    });

    $(".eventDelete").on("click", function () {
        var formData = {};
        formData['Id'] = $(this).data("value");
        formData['action'] = 'eventDelete';
        $.ajax({
            url: appURL + 'includes/_ajax.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                $.toast({
                    heading: 'Success',
                    hideAfter: 1500,
                    text: 'Başarıyla Silindi',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'success',
                    afterHidden: function () {
                        location.reload();
                    }
                });
            },
            error: function () {
                $.toast({
                    heading: 'Error',
                    hideAfter: 1500,
                    text: 'Beklenmedik bir hata ile karşılaşıldı',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'error'
                });
            }
        });
    });

    $(".eventEdit").on("click", function () {
        $(".componentAdd").click();
        $("#eventId").val($(this).data("value"));
        $("#eventCord").val($(this).data("cord"));
        $("#eventName").val($(this).data("name"));
        $("#eventDesc").val($(this).data("desc"));
        $("#eventDate").val($(this).data("date"));
        $("#eventTime").val($(this).data("time"));
        $("#eventCategory").val($(this).data("category"));
        $("#eventImage1").val($(this).data("image1"));
        $("#eventImage2").val($(this).data("image2"));
        if ($(this).data("durum") === 1)
            $("#radioAcik").click();
        else
            $("#radioKapali").click();
    });

    $(".imageDelete").on("click", function () {
        var formData = {};
        formData['path'] = $(this).val();
        formData['action'] = 'imageDelete';
        $.ajax({
            url: appURL + 'includes/_ajax.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                if (data == 1) {
                    $.toast({
                        heading: 'Success',
                        hideAfter: 1000,
                        text: 'Başarıyla Silindi',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'success',
                        afterHidden: function () {
                            location.reload();
                        }
                    });
                } else {
                    $.toast({
                        heading: 'Error',
                        hideAfter: 1500,
                        text: 'Beklenmedik bir hata ile karşılaşıldı',
                        position: 'top-right',
                        showHideTransition: 'slide',
                        icon: 'error'
                    });
                }
            },
            error: function () {
                $.toast({
                    heading: 'Error',
                    hideAfter: 1500,
                    text: 'Beklenmedik bir hata ile karşılaşıldı',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'error'
                });
            }
        });
    });

    $('#eventDate').datepicker({
        showOtherMonths: true,
        format: 'dd-mm-yyyy'
    });

    $('.eventModal').on('click', function () {
        var image = $(this).data('value');
        var name = $(this).data('name');
        $('#modalName').text(name);
        $('#modalImageSrc').attr('src', 'https://dash.thegettinout.com/assets/images/uploadFile/' + image + '');
        $('#modalImage').toggle(250);
    });

    $('#modalImage').click(function () {
        $('#modalImage').toggle(250);
        setTimeout(function () {
            $('#modalName').text('');
            $('#modalImageSrc').attr('src', '');
        }, 250);
    });

    var initTinyMCE = function (e) {

        tinymce.init({
            selector: e,
            theme: 'modern',
            height: 300,
            relative_urls: false,
            remove_script_host: false,
            plugins: [
                'advlist autolink link image imagetools lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor responsivefilemanager'
            ],
            language: 'tr_TR',
            extended_valid_elements: "iptal,transfer,otobus,matrah_18,toplam_18",
            content_css: 'css/content.css',
            verify_html: false,
            toolbar1: 'insertfile undo redo | imageupload | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
            toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor | print preview code ",
            image_advtab: true,
            filemanager_title: "Responsive Filemanager",

        });


    }

    initTinyMCE('.wysiwgArea');

    $(".btnConfigHak").on("click", function () {
        tinyMCE.triggerSave();
        var config = $('#configHak');
        var formData = {};
        formData['Id'] = config.data('id');
        formData['value'] = config.val();
        formData['action'] = 'configUpdate';
        $.ajax({
            url: appURL + 'includes/_ajax.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                $.toast({
                    heading: 'Success',
                    hideAfter: 1500,
                    text: 'Başarıyla Düzenlendi',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'success'
                });
            },
            error: function () {
                $.toast({
                    heading: 'Error',
                    hideAfter: 1500,
                    text: 'Beklenmedik bir hata ile karşılaşıldı',
                    position: 'top-right',
                    showHideTransition: 'slide',
                    icon: 'error'
                });
            }
        });
    });

    $('#modalImage').toggle(0);

});
 