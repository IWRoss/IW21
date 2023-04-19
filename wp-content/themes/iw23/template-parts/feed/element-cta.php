<?php if (is_plugin_active('contact-form-7/wp-contact-form-7.php') && $contact_form = get_field('contact_form')) : ?>
    <?php iw23_floating_action_button('contact-form'); ?>

    <div id="contact-form" class="iw-modal">
        <div class="iw-modal-window">
            <span class="close" data-iw-modal="close">&times;</span>

            <div class="iw-modal--content">
                <?php echo do_shortcode('[contact-form-7 id="' . $contact_form . '" title="Contact"]'); ?>

                <h3 style="text-align:center;">Or call us: +44 (0) 203 318 5753</h3>
                <p style="text-align:center;">More contact details available <a href="<?php echo get_permalink(get_page_by_title('Get in touch')); ?>">here</a>.</p>
            </div>
        </div>
    </div>
<?php endif; ?>