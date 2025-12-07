$(document).ready(function () {
    $('#nav-toggle').click(function () {
        $('.re-menu').toggleClass('open');
    });

    $('#submit-btn').click(function (e) {
        e.preventDefault();
        let btn = $(this);
        let target = btn.closest('form');
        btn.prop('disabled', true);
        $('#send-icon').hide();
        $('#send-check-icon').show();
        target.submit();
    });
});