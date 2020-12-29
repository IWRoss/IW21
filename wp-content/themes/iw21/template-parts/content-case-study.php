<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Interactive_Workshops_2021
 */

/**
 * Get custom fields
 */
$fields = array(
	'headline' 		 => get_field('headline'),
	'lead' 			 => get_field('lead'),
	'the_challenge'  => get_field('the_challenge'),
	'how_we_helped'  => get_field('how_we_helped'),
	'the_results'    => get_field('the_results'),
	'call_to_action' => get_field('call_to_action')
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<div class="industry-meta">
			Case Study //
			<?php echo get_the_term_list($post->ID, 'industry', 'Industry: <ul class="industry-list"><li class="industry">', ',</li><li>', '</li></ul>'); ?>
		</div>

		<?php iw21_render_post_title($fields['headline']); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<section class="entry-section entry-section--lead">
			<?php echo $fields['lead']['content']; ?>

			<?php if ($fields['call_to_action']['signup']) : ?>
				<a href="<?php echo $fields['call_to_action']['signup']; ?>" target="_blank" class="btn"><?php echo $fields['call_to_action']['top_button']; ?></a>
			<?php endif; ?>
		</section>

		<section class="entry-section entry-section--the_challenge">
			<h3 class="section-title">The Challenge</h3>

			<div class="entry-section--content">
				<div class="entry-section--col">
					<?php echo $fields['the_challenge']['content']; ?>
				</div>

				<div class="entry-section--col">
					<ul class="entry-section--list">
						<?php foreach ($fields['the_challenge']['bullet_points'] as $bullet_point) : ?>

							<?php if ($bullet_point['icon']) : ?>
								<li class="entry-section--list-item entry-section--list-item--has-icon">
									<img src="<?php echo $bullet_point['icon']['sizes']['thumbnail']; ?>" alt="<?php $bullet_point['icon']['title'] ?>" class="entry-section--list-item--icon">
									<h5 class="entry-section--list-item--heading"><?php echo $bullet_point['heading']; ?></h5>
									<p class="entry-section--list-item--content"><?php echo $bullet_point['content']; ?></p>
								</li>
							<?php else : ?>
								<li class="entry-section--list-item">
									<h5 class="entry-section--list-item--heading"><?php echo $bullet_point['heading']; ?></h5>
									<p class="entry-section--list-item--content"><?php echo $bullet_point['content']; ?></p>
								</li>
							<?php endif; ?>

						<?php endforeach; ?>
					</ul>
				</div>

				<?php if ($fields['the_challenge']['image']) : ?>
					<img src="<?php echo $fields['the_challenge']['image']['sizes']['large'] ?>" alt="<?php echo $fields['the_challenge']['image']['alt']; ?>">
				<?php endif; ?>

			</div>
		</section>

		<section class="entry-section entry-section--how_we_helped">
			<h3 class="section-title">How We Helped</h3>

			<div class="entry-section--content">

				<div class="entry-section--col">
					<?php echo $fields['how_we_helped']['content']; ?>
				</div>
				<div class="entry-section--col">
					<ul class="entry-section--list entry-section--skills">
						<?php

						$skills = get_terms('work_type', array(
							'hide_empty' => false,
							'orderby'	 => 'term_id'
						));

						foreach ($skills as $skill) : ?>

							<?php
							// Get icon
							$icon = get_field('icon', 'work_type_' . $skill->term_id);
							?>

							<li class="entry-section--list-item entry-section--list-item--skill <?php echo in_array($skill->term_id, $fields['how_we_helped']['skills_deployed']) ? 'skill-deployed' : ''; ?>">
								<img src="<?php echo $icon['sizes']['thumbnail']; ?>" alt="" class="entry-section--list-item--skill-icon">
								<?php echo $skill->name; ?>
							</li>

						<?php endforeach; ?>
					</ul>
				</div>

				<?php if ($fields['how_we_helped']['image']) : ?>
					<img src="<?php echo $fields['how_we_helped']['image']['sizes']['large'] ?>" alt="<?php echo $fields['how_we_helped']['image']['alt']; ?>">
				<?php endif; ?>

			</div>
		</section>

		<section class="entry-section entry-section--the_results">
			<h3 class="section-title">The Results</h3>

			<div class="entry-section--content">
				<?php if ($fields['the_results']['graph'] !== null) : ?>
					<div class="entry-section--col">
						<?php echo $fields['the_results']['content']; ?>
					</div>
					<div class="entry-section--col">
						<?php echo $fields['the_results']['graph']; ?>
					</div>
				<?php else : ?>
					<?php echo $fields['the_results']['content']; ?>
				<?php endif; ?>
			</div>
		</section>

		<section class="entry-section entry-section--call_to_action">
			<div class="entry-section--content">
				<h4><?php echo $fields['call_to_action']['content']; ?></h4>

				<div class="entry-section--contacts">
					<?php foreach ($fields['call_to_action']['contacts'] as $contact) : ?>
						<?php $thumb = get_field('team_image', 'user_' . $contact['ID']); ?>

						<img src="<?php echo $thumb['sizes']['thumbnail']; ?>" alt="<?php echo $contact['nickname']; ?>" class="contact-image">
						<h5 class="contact-name"><?php echo $contact['nickname']; ?></h5>
						<p class="contact-email"><a href="mailto:<?php echo $contact['user_email']; ?>"><?php echo $contact['user_email']; ?></a> // <a href="tel:<?php echo get_field('phone', 'user_' . $contact['ID']); ?>"><?php echo get_field('phone', 'user_' . $contact['ID']); ?></a></p>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="entry-section entry-section--download">
			<div class="entry-section--content">
				<h5><?php echo $fields['call_to_action']['headline']; ?></h5>
				<?php if ($fields['call_to_action']['signup']) : ?>
					<a href="<?php echo $fields['call_to_action']['signup']; ?>" target="_blank" class="btn"><?php echo $fields['call_to_action']['bottom_button']; ?></a>
				<?php endif; ?>
			</div>
		</section>

		<?php
		wp_link_pages(array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'iw21'),
			'after'  => '</div>',
		));
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php do_action('iw21_content_footer'); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->