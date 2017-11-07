$(function() {
    $('.filter button').click(function() {

        if ($(this).hasClass('active')) {
            return;
        }
        var filter = $(this).data('filter');
        $('.filter button:not(.' + filter + ')').attr('disabled', true);

        var fadeTime = 350;
        $('.filter button').removeClass('active');
        $(this).addClass('active')

        $('.product').animate({opacity: 0}, fadeTime, function() {
            if (filter == 'all') {
                $('.product').show();
            }
            else {
                $('.product').hide();
                $('.product.uni').show();
                $('.product.' + filter).show();
            }
            $('.product').animate({opacity: 1}, fadeTime, function() {
                $('.filter button').attr('disabled', false)
            });
        });
    });
});
