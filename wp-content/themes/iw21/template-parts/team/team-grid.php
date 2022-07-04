<?php

/**
 * Team member in a grid
 */

$member = $args['member'];

?>

<?php do_action('iw21_team_member_image', $member); ?>

<h5 class="team-member--name">
    <?php echo $member['display_name']; ?>
</h5>

<?php if ($role = get_field('role', 'user_' . $member['ID'])) : ?>
    <p class="team-member--role"><?php echo $role; ?></p>
<?php endif; ?>

<?php
/**
 * Create a modal for team member
 */
get_template_part('template-parts/team/team', 'modal', array(
    'member' => $member
));

?>