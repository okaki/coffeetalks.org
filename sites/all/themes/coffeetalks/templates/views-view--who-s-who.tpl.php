<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */

// echo '<pre>'; print_r($view->result); echo '</pre>'; 
?>

<section class="profiles">

	<?php foreach($view->result as $profile): 
		$profile = array(
			'name' => (isset($profile->field_field_first_name[0]) ? $profile->field_field_first_name[0]['raw']['value'] : ''),
			'about' => (isset($profile->field_field_about_me[0]) ? $profile->field_field_about_me[0]['rendered']['#markup'] : ''),
			'img2' => (isset($profile->field_field_photo[0]) ? file_create_url($profile->field_field_photo[0]['raw']['uri']) : ''),
			'img' => ($profile->users_picture > 0 ? file_create_url($profile->_field_data['uid']['entity']->picture->uri) : ''),
			'hardware' => (isset($profile->field_field_hardware[0]) ? $profile->field_field_hardware[0]['raw']['value'] : '...'),
			'software' => (isset($profile->field_field_software[0]) ? $profile->field_field_software[0]['raw']['value'] : '...'),
			'twitter' => (isset($profile->field_field_twitter[0]) ? $profile->field_field_twitter[0]['raw']['value'] : ''),
			'facebook' => (isset($profile->field_field_facebook[0]) ? $profile->field_field_facebook[0]['raw']['value'] : ''),
			'linkedin' => (isset($profile->field_field_linkedin[0]) ? $profile->field_field_linkedin[0]['raw']['value'] : ''),
			'website' => (isset($profile->field_field_website[0]) ? $profile->field_field_website[0]['raw']['value'] : ''),
			'blog' => (isset($profile->field_field_blog[0]) ? $profile->field_field_blog[0]['raw']['value'] : ''),
		);
		$profile['social'] = ($profile['twitter'] || $profile['facebook'] || $profile['linkedin']);
		$profile['websites'] = array();
		if ($profile['website']) {
			$profile['websites'][] = l('website', $profile['website']);
		}
		if ($profile['blog']) {
			$profile['websites'][] = l('blog', $profile['blog']);
		}
	?>
	<div class="profile">
		<div class="left">
			<?php if (strlen($profile['img']) > 0): ?>
			<img src="<?=$profile['img']?>" alt="<?=$profile['name']?>">
			<?php endif; ?>
			<h3><?=$profile['name']?></h3>
			<p><strong>Articles: </strong> 0</p>
			<?php if ($profile['social']): ?>
			<ul class="social">
				<?php if ($profile['facebook']): ?><li><a href="<?=$profile['facebook']?>"><i class="icon-facebook"></i></a></li><?php endif; ?>
				<?php if ($profile['twitter']): ?><li><a href="<?=$profile['twitter']?>"><i class="icon-twitter"></i></a></li><?php endif; ?>
				<?php if ($profile['linkedin']): ?><li><a href="<?=$profile['linkedin']?>"><i class="icon-linkedin"></i></a></li><?php endif; ?>
			</ul>
			<?php endif; ?>
			<?php if (count($profile['websites']) > 0) {
				echo '<div>' . implode(' | ', $profile['websites']) . '</div>';
			} ?>
		</div>
		<div class="right">
			<h3>About <?=$profile['name']?></h3>
			<p><?=$profile['about']?></p>

			<h4>Hardware</h4>
			<p><?=$profile['hardware']?></p>

			<h4>Software</h4>
			<p><?=$profile['software']?></p>
		</div>
	</div>
	<?php endforeach; ?>	

</section>