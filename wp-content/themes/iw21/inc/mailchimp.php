<?php

function iw21_mailchimp_html_form( $id ) { ?>

    <!-- Begin MailChimp Signup Form -->
    <div id="mc_embed_signup">
        <form action="https://interactiveworkshops.us5.list-manage.com/subscribe/post?u=2fcfbb365260cf634477a826b&amp;id=<?php echo $id; ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
                <div class="mc-field-group">
                    <label for="mce-EMAIL">Email Address</label>
                    <input type="email" value="" name="EMAIL" class="required email" placeholder="Your email address" id="mce-EMAIL">
                </div>
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>
                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_2fcfbb365260cf634477a826b_<?php echo $id; ?>" tabindex="-1" value=""></div>
                <div class="clear"><input type="submit" value="Register Interest" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                <p class="disclaimer">By providing us with your email, you give your consent for us to contact you via our mailing list. We will never spam you and you can unsubscribe at any time using the link in the footer of any emails you receive from us.</p>
            </div>
        </form>
    </div>

    <!--End mc_embed_signup-->

<?php }
