<div class="block-modal <?php echo $is_preview ? 'is-preview' : '' ?>">
    <div id="modal-<?php echo $block['id']; ?>" class="iw-modal">
        <div class="iw-modal-window">

            <?php if (!$is_preview) : ?>
                <span class="close" data-iw-modal="close">&times;</span>
            <?php endif; ?>

            <div class="iw-modal--content" data-insert="<?php the_field('modal_content'); ?>">
                <InnerBlocks />
            </div>
        </div>
    </div>
</div>

<?php if (!$is_preview) : ?>
    <script>
        (function($) {

            $(document).on('ready', function(){

                $('#modal-<?php echo $block['id']; ?>').appendTo('body');

                $('a[href="#modal-<?php echo $block['id']; ?>"]').each(function(){
                    
                    $(this)
                        .attr('data-iw-modal', "open")
                        .attr('rel', $(this).attr('href').substring(1))
                        .attr('href', '#');

                    $(this).on('click', function() {
                        $( '#' + $.attr( this, 'rel' ) ).fadeIn();
                    });

                });
                
            });
        })(jQuery);
    </script>
<?php endif; ?>