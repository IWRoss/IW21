<?php
/**
 * Team member in a grid
 */

$member = $args['member'];

?>

<div class="toast__col toast__col--1-of-4 toast__col--m-1-of-3 toast__col--s-1-of-2">

    <?php do_action('iw21_team_member_image', $member); ?>

    <h5 class="team-member--name">
        <?php echo $member['nickname']; ?>
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

</div>