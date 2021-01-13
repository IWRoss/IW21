/**
 * File modal-block.js.
 */

(function ($) {

    $(document).on('ready', function () {

        $('.iw-modal--content[data-insert]').each(function(){

            var contentBlock = $('#' + $(this).data('insert'));

            $(this).append(contentBlock.html());

        });

    });

})(jQuery);
