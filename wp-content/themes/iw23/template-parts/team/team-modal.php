<?php

/**
 * Modal template for team page
 */

$member = $args['member'];

?>

<div id="team-<?php echo $member['ID']; ?>" class="iw-modal team-modal">

    <div class="iw-modal-window team-modal-window">
        <span class="close" data-iw-modal="close">&times;</span>

        <?php if ($bio_image = get_field('bio_image', 'user_' . $member['ID'])) : ?>
            <div class="team-modal--img" style="background-image:url('<?php echo $bio_image; ?>')"></div>
        <?php endif; ?>

        <div class="iw-modal--content team-modal--content">
            <h5 class="team-member--name"><?php echo $member['display_name']; ?></h5>

            <?php echo wpautop($member['user_description']); ?>

            <?php if ($linkedin = get_user_meta($member['ID'], 'linkedin', true)) : ?>
                <p>
                    <svg width="1.5em" height="1.5em" version="1.1" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" style="display: inline-block; vertical-align: -25%;">
                        <path d="m62.102 59.801c-3.6992 0-6.8984 1.6016-9.1016 4.1992l-17-8.8008c0.80078-1.6016 1.1992-3.3984 1.1992-5.3008 0-1.8984-0.5-3.6992-1.1992-5.3008l17-8.8008c2.1992 2.6016 5.5 4.1992 9.1016 4.1992 6.6016 0 12.102-5.3984 12.102-12.102 0-6.6016-5.3984-12.102-12.102-12.102-6.7031 0.007812-12.102 5.707-12.102 12.309 0 1.6016 0.30078 3 0.80078 4.3984l-17.301 8.8984c-2.1992-2.1992-5.1992-3.5-8.5-3.5-6.5 0-12 5.5-12 12.102s5.3984 12.102 12.102 12.102c3.3008 0 6.3008-1.3008 8.5-3.5l17.301 8.8984c-0.5 1.3984-0.80078 2.8008-0.80078 4.3984 0 6.6016 5.3984 12.102 12.102 12.102 6.6992 0 12.102-5.3984 12.102-12.102-0.003907-6.6992-5.6055-12.098-12.203-12.098zm0-39.699c4.3984 0 8.1016 3.6016 8.1016 8.1016 0 4.3984-3.6016 8.1016-8.1016 8.1016-4.5-0.003907-8.1016-3.7031-8.1016-8.2031 0-4.4023 3.6016-8 8.1016-8zm-37 38c-4.3984 0-8.1016-3.6016-8.1016-8.1016 0-4.3984 3.6016-8.1016 8.1016-8.1016 4.3984 0 8.1016 3.6016 8.1016 8.1016-0.003906 4.3984-3.7031 8.1016-8.1016 8.1016zm37 21.797c-4.3984 0-8.1016-3.6016-8.1016-8.1016s3.6016-8.1016 8.1016-8.1016 8.1016 3.6016 8.1016 8.1016c-0.003906 4.5039-3.7031 8.1016-8.1016 8.1016z" />
                    </svg>
                    <a href="<?php echo $linkedin; ?>" target="_blank">Find <?php echo $member['user_firstname']; ?> on Linkedin</a>
                </p>
            <?php endif; ?>

            <dl class="team-member--details">
                <div class="team-member--email">
                    <dt>Email:</dt>
                    <dd>
                        <a href="mailto:<?php echo $member['user_email'] ?>" target="_blank"><?php echo str_replace('@', '@<wbr>', $member['user_email']); ?></a>
                    </dd>
                </div>

                <?php if ($phone = get_field('phone', 'user_' . $member['ID'])) : ?>
                    <div class="team-member--phone">
                        <dt>Phone:</dt>
                        <dd>
                            <?php echo $phone; ?>
                        </dd>
                    </div>
                <?php endif; ?>
            </dl>
        </div>
    </div>
</div>