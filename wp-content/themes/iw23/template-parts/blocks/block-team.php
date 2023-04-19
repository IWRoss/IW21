<?php


[$classes, $styles] = iw23_block_styles($block);

$team_members = get_field('team_members');

?>

<div id="<?php echo $block['id']; ?>" class="block-team alignfull <?php echo implode(' ', $classes); ?>" style="<?php echo implode(' ', $styles); ?>">

    <?php if ($team_members) : ?>

        <div class="block-team-inner">
            <?php foreach ($team_members as $team_member) : ?>

                <div class="block-team-member">

                    <div class="block-team-member-photo">
                        <img src="<?php echo get_field('author_image', 'user_' . $team_member['ID']); ?>" alt="<?php echo $team_member['display_name']; ?>">
                    </div>

                    <div class="block-team-member-meta">
                        <h5 class="block-team-member-name"><?php echo $team_member['display_name']; ?></h5>
                        <p class="block-team-member-role"><?php echo get_field('role', 'user_' . $team_member['ID']); ?></p>
                        <a href="#" rel="team-<?php echo $team_member['ID']; ?>" data-iw-modal="open" class="btn btn-xsmall btn-inline">View Bio</a>
                    </div>
                </div>

                <?php
                /**
                 * Create a modal for team member
                 */
                get_template_part('template-parts/team/team', 'modal', array(
                    'member' => $team_member
                ));

                ?>

            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>

<?php if ($animation = get_field('animation')) iw23_setup_animations($animation, $block['id']); ?>