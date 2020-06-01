(function ($) {
    'use strict';
    //var appURL = 'http://thedash.localhost/';
    var appURL = 'https://www.dash.thegettinout.com/';

    $(function () {
        var todoListItem = $('.todo-list');
        var todoListInput = $('.todo-list-input');
        $('.todo-list-add-btn').on("click", function (event) {
            event.preventDefault();
            var formData = {};
            formData['note'] = $(".todo-list-input").val();
            formData['action'] = 'noteAdd';
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

        });

        todoListItem.on('change', '.checkbox', function () {
            var items = $(this);
            var formData = {};
            formData['Id'] = items.data("value");
            formData['durum'] = items.val();
            if (formData['durum'] === "1")
                formData['durum'] = "0";
            else
                formData['durum'] = "1";
            formData['action'] = 'noteUpdate';
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    if (items.attr('checked')) {
                        items.removeAttr('checked');
                        items.val("0");
                    } else {
                        items.attr('checked', 'checked');
                        items.val("1");
                    }
                    items.closest("li").toggleClass('completed');
                }
            });
        });

        todoListItem.on('click', '.remove', function () {
            var items = $(this);
            var formData = {};
            formData['Id'] = items.data("value");
            formData['action'] = 'noteDelete';
            $.ajax({
                url: appURL + 'includes/_ajax.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    items.parent().remove();
                }
            });
        });

    });
})(jQuery);