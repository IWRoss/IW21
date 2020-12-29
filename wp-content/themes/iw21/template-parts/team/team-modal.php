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
            <h5 class="team-member--name"><?php echo $member['nickname']; ?></h5>
            
            <?php echo wpautop($member['user_description']); ?>

            <dl class="team-member--details">
                <div class="team-member--email">
                    <dt>Email:</dt>
                    <dd>
                        <a href="mailto:<?php echo $member['user_email'] ?>" target="_blank"><?php echo $member['user_email'] ?></a>
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