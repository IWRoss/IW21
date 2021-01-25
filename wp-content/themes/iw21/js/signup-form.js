/**
 * File signup-form.js.
 */

(function ($) {

    $(document).on('ready', function(){
        $('.select-all-week').html('<a href="#" class="select-all-week-link">Select All</a>');
        $('.select-all').html('<a href="#" class="select-all-link">Select All Sessions</a>');
    });

    $(document).on('click', '.select-all-week-link', function (e) {
        e.preventDefault();

        var checkboxes = $(this).parent().prev().find('input[type="checkbox"]');

        checkboxes.prop("checked", !checkboxes.prop("checked"));
    });

    $(document).on('click', '.select-all-link', function (e) {
        e.preventDefault();

        var checkboxes = $('input[type="checkbox"]');

        checkboxes.prop("checked", !checkboxes.prop("checked"));
    });

})(jQuery);
