<?php

/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Interactive_Workshops_2021
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

		<?php if (is_user_logged_in()) : ?>

		<div class="marketing-dashboard marketing-dashboard-last-week">
			<div class="dashboard-header">
				<h1 class="dashboard-title">
					Last Week
				</h1>
			</div>
			<div class="dashboard-content">
				<div class="dashboard-card dashboard-delivered-this-week">
					<h3 class="dashboard-card-title">
						Delivered this week
					</h3>
					<div class="dashboard-card-content">
						<?php the_field('delivered_this_week'); ?>
					</div>
				</div>
				<div class="dashboard-card dashboard-next-event-signups">
					<h3 class="dashboard-card-title">
						Next event signups
					</h3>
					<div class="dashboard-card-content">
						<div class="dashboard-columns">
							<div class="dashboard-column dashboard-columns">
								<div class="dashboard-number">10</div>
								<div class="dashboard-number-label">
									<div class="dashboard-number-increase">+10</div>
									IW General<br />22 Jul
								</div>
							</div>
							<div class="dashboard-column dashboard-columns">
								<div class="dashboard-number">10</div>
								<div class="dashboard-number-label">
									<div class="dashboard-number-increase">+10</div>
									IW General<br />22 Jul
								</div>
							</div>
							<div class="dashboard-column dashboard-columns">
								<div class="dashboard-number">10</div>
								<div class="dashboard-number-label">
									<div class="dashboard-number-increase">+10</div>
									IW General<br />22 Jul
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="dashboard-card dashboard-new-leads">
					<h3 class="dashboard-card-title">
						New Leads
					</h3>
					<div class="dashboard-card-content">
						<div class="dashboard-columns">
							<div class="dashboard-column">
								<div class="dashboard-number"><?php the_field('hot_leads'); ?><img src="<?php echo get_template_directory_uri(); ?>/imgs/dashboard/hot.svg" alt="" class="dashboard-icon"></div>
								<div class="dashboard-number-label">
									Hot leads
								</div>
							</div>
							<div class="dashboard-column">
								<div class="dashboard-number"><?php the_field('warm_leads'); ?><img src="<?php echo get_template_directory_uri(); ?>/imgs/dashboard/warm.svg" alt="" class="dashboard-icon"></div> <div class="dashboard-number-label">
									Warm leads
								</div>
							</div>
							<div class="dashboard-column">
								<div class="dashboard-number"><?php the_field('meetings'); ?><img src="<?php echo get_template_directory_uri(); ?>/imgs/dashboard/meeting.svg" alt="" class="dashboard-icon"></div>
								<div class="dashboard-number-label">
									1st MTG Booked
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="dashboard-card dashboard-web-data">
					<h3 class="dashboard-card-title">
						Web Data
					</h3>
					<div class="dashboard-card-content">
						<?php

						$web_data = get_field('web_data');

						printf('<img src="%s" class="dashboard-web-data">', $web_data['sizes']['large']);
						?>
					</div>
				</div>
				<div class="dashboard-card dashboard-web-stalker-of-the-week">
					<h3 class="dashboard-card-title">
						Web Stalker of the Week
					</h3>
					<div class="dashboard-card-content">
						<div class="dashboard-columns">
							<div class="dashboard-column dashboard-column-thin">
								<?php

								$web_stalker_image = get_field('web_stalker_image');

								printf('<img src="%s" class="dashboard-web-stalker-image">', $web_stalker_image['sizes']['thumbnail']);
								?>
							</div>
							<div class="dashboard-column">
								<?php the_field('web_stalker_details'); ?>
							</div>
							<div class="dashboard-column dashboard-columns">
								<div class="dashboard-number"><?php the_field('web_stalker_pages_visited'); ?></div>
								<div class="dashboard-number-label">
									pages visited
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="marketing-dashboard marketing-dashboard-this-week">
			<div class="dashboard-header">
				<h1 class="dashboard-title">
					This Week
				</h1>
			</div>
			<div class="dashboard-content">
				<div class="dashboard-card dashboard-key-deliverables">
					<h3 class="dashboard-card-title">
						Key Deliverables
					</h3>
					<div class="dashboard-card-content">
						<?php the_field('key_deliverables'); ?>
					</div>
				</div>
				<div class="dashboard-card dashboard-web-features-launching">
					<h3 class="dashboard-card-title">
						Web Features launching
					</h3>
					<div class="dashboard-card-content">
						<?php the_field('web_features_launching'); ?>
					</div>
				</div>
				<div class="dashboard-card dashboard-key-actions">
					<h3 class="dashboard-card-title">
						Key actions required from IW Team
					</h3>
					<div class="dashboard-card-content">
						<?php the_field('key_actions_required_from_iw_team'); ?>
					</div>
				</div>
				<div class="dashboard-card dashboard-action-completion-rate">
					<h3 class="dashboard-card-title">
						Last week's marketing action completion rate
					</h3>
					<div class="dashboard-card-content">
						<div class="dashboard-columns">
							<div class="dashboard-column dashboard-column-thin dashboard-number">
								<?php printf('%d%%', get_field('marketing_action_completion_rate')); ?>
							</div>
							<div class="dashboard-column dashboard-number-label">
								<?php the_field('marketing_action_completion_rate_detail'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php else : ?>
			<p>Please log in to see the dashboard.</p>
		<?php endif; ?>


	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php do_action('iw21_content_footer'); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->