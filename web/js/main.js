$(function() {
    // Init lazy load images
    lazyload();

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

    // Init rrssb on modal open to size sharing buttons
    $(".modal").on("shown.bs.modal", function(e) {
        rrssbInit();
    });

});
