$(document).ready(function () {
    $('#nav-toggle').click(function () {
        $('.re-menu').toggleClass('open');
    });

    $('#btn-wrapper').click(function (e) {
        e.preventDefault();
        let btn = $(this).children('#submit-btn');
        let target = btn.closest('form');
        btn.prop('disabled', true);
        btn.addClass('loading');
        $('#send-icon').addClass('loading').hide();
        $('#send-check-icon').addClass('loading').show();
        target.submit();
    });
});