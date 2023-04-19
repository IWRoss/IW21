<?php

$dlid = !empty($_GET['dlid']) ? iw21_decrypt($_GET['dlid'], IW_PASSPHRASE) : false;

?>

<?php if ($is_preview) : ?>
  <p style="padding:1em 2em;border:2px dashed grey;color:grey;cursor:pointer;text-align:center;">This block is only visible on the frontend.</p>
<?php endif; ?>

<?php if (!$is_preview && $dlid) : ?>

  <div class="iw-block iw-block-signup-download">

    <?php if ($dlid && ($download = get_post($dlid))) : ?>

      <h3>Your download</h3>
      <p>You can bookmark this page or resubmit the form if you need to retrieve this download at any time.</p>

      <div class="download">
        <div class="download-header">
          <h5 class="download-title">
            <a href="<?php echo $download->guid; ?>" class="download-link" download><?php echo $download->post_title; ?></a>
          </h5>
        </div>
        <a href="<?php echo $download->guid; ?>" class="btn btn-xsmall" download>Download</a>
      </div>

      <div class="download-links">
        <?php if ($download->post_parent) : ?>
          <a href="<?php the_permalink($download->post_parent); ?>" class="btn">Return to Case Study</a>
        <?php endif; ?>
        <a href="<?php echo get_home_url(); ?>" class="btn">Return to Home</a>
      </div>


    <?php else : ?>

      <p>We had an issue finding your download. Please <a href="mailto:web@interactiveworkshops.com" target="_blank">contact us</a> quoting reference <?php echo urlencode($_GET['dlid']); ?> and we’ll help you out.</p>

      <a href="<?php echo get_home_url(); ?>" class="btn">Return to Home</a>

    <?php endif; ?>


  </div>
<?php endif; ?>