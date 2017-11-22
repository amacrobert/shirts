$(function() {

    var popupCenter = function(url, title, w, h) {
        // Fixes dual-screen position                         Most browsers      Firefox
        var dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop !== undefined ? window.screenTop : screen.top;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 3) - (h / 3)) + dualScreenTop;

        var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        // Puts focus on the newWindow
        if (newWindow && newWindow.focus) {
            newWindow.focus();
        }
    };

    // popups
    try {
        $(document).on('click', 'a.popup', {}, function popUp(e) {
            var self = $(this);
            popupCenter(self.attr('href'), self.find('.rrssb-text').html(), 580, 470);
            e.preventDefault();
        });
    }
    catch (e) { // catching this adds partial support for jQuery 1.3
    }

    // Product filters
    $('.filter button').click(function() {

        if ($(this).hasClass('active')) {
            return;
        }

        $(this).parent().find('.active').removeClass('active');
        $(this).addClass('active');

        var filterSex = $('#filter-sex .active').data('filter');
        var filterType = $('#filter-type .active').data('filter');
        var filterSelector = '.product' + (filterSex ? '.' + filterSex : '') + (filterType ? '.' + filterType : '');

        $('.product').fadeOut(200);
        window.setTimeout(function() {
            $(filterSelector).fadeIn(200);
        }, 200);
    });

    $(".modal").on("show.bs.modal", function(e) {
        // Load images in modal
        var modalId = $(this).attr('id');
        $('#' + modalId + ' img.lazyload').each(function(index) {
            $(this).attr('src', $(this).data('original'));
        })
    });

    $(".modal").on("shown.bs.modal", function(e) {
        rrssbInit();
    });
});
