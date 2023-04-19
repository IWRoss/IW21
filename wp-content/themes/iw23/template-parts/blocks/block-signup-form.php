<?php

global $post;

/**
 * 
 */

$download = get_field('download');

if (!$is_preview) : ?>

  <form action="<?php echo site_url('/signup'); ?>" class="signup--form" method="POST">

    <?php
    /**
     * Name fields
     */ ?>
    <div class="signup--form-group group-has-columns">
      <div class="signup--form-subgroup">
        <input type="text" id="<?php printf('%s--first-name', $block['id']); ?>" name="first_name" class="signup--field" required>
        <label for="<?php printf('%s--first-name', $block['id']); ?>" class="signup--field-label">
          First Name
        </label><!-- […]--field-label -->
      </div><!-- […]--form-subgroup -->

      <div class="signup--form-subgroup">
        <input type="text" id="<?php printf('%s--last-name', $block['id']); ?>" name="last_name" class="signup--field" required>
        <label for="<?php printf('%s--last-name', $block['id']); ?>" class="signup--field-label">
          Last Name
        </label><!-- […]--field-label -->
      </div><!-- […]--form-subgroup -->
    </div><!-- […]--form-group -->

    <?php
    /**
     * Email field
     */ ?>
    <div class="signup--form-group">
      <input type="email" id="<?php printf('%s--email', $block['id']); ?>" name="email" class="signup--field" required>
      <label for="<?php printf('%s--email', $block['id']); ?>" class="signup--field-label">
        Email Address
      </label><!-- […]--field-label -->
    </div><!-- […]--form-group -->

    <?php
    /**
     * Organisation field
     */ ?>
    <div class="signup--form-group">
      <input type="text" id="<?php printf('%s--organisation', $block['id']); ?>" name="organisation" class="signup--field" required>
      <label for="<?php printf('%s--organisation', $block['id']); ?>" class="signup--field-label">
        Organisation
      </label><!-- […]--field-label -->
    </div><!-- […]--form-group -->

    <?php if ($download) : ?>
      <input type="hidden" name="download" value="<?php echo iw23_encrypt($download->ID, IW_PASSPHRASE); ?>" required />
    <?php endif; ?>

    <input type="hidden" name="location" value="<?php echo iw23_encrypt($post->ID, IW_PASSPHRASE); ?>" required>

    <input type="hidden" id="token" name="token">

    <input type="submit" value="Sign me up" />
  </form>

  <script>
    var interval = setInterval(function() {

      if (window.grecaptcha) {

        grecaptcha.ready(function() {
          grecaptcha.execute('<?php echo IW_RECAPTCHA_SITE; ?>', {
            action: 'homepage'
          }).then(function(token) {
            document.getElementById("token").value = token;
          });
          // refresh token every minute to prevent expiration
          setInterval(function() {
            grecaptcha.execute('<?php echo IW_RECAPTCHA_SITE; ?>', {
              action: 'homepage'
            }).then(function(token) {
              document.getElementById("token").value = token;
            });
          }, 60000);
        });

        clearInterval(interval);
      }

    }, 100);
  </script>

<?php else : ?>

  <p style="padding:1em 2em;border:2px dashed grey;color:grey;cursor:pointer;text-align:center;"><?php echo $is_preview ? 'This form is only visible on the frontend.' : 'Form has not yet been set up.'; ?></p>

<?php endif; ?>