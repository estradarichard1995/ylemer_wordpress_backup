<?php
/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
		<script src="https://kit.fontawesome.com/3703ef0c76.js" crossorigin="anonymous"></script>	
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php
		wp_body_open();
		?>

		<header id="site-header" role="banner">
			<div class="container" >
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/header-bar.png" alt="border-top-blue" />
				<div class="header-inner section-inner">

					<div class="header-titles-wrapper">

						<?php

						// Check whether the header search is activated in the customizer.
						$enable_header_search = get_theme_mod( 'enable_header_search', true );

						if ( true === $enable_header_search ) {

							?>

							<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
								<span class="toggle-inner">
									<span class="toggle-icon">
										<?php twentytwenty_the_theme_svg( 'search' ); ?>
									</span>
									<span class="toggle-text"><?php _ex( 'Search', 'toggle text', 'twentytwenty' ); ?></span>
								</span>
							</button><!-- .search-toggle -->

						<?php } ?>

						<div class="header-titles">
							<a class="navbar-brand" href="https://ylemer.io/">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/new-logo.svg" width="110" alt="Ylemer logo">
							</a>
						</div><!-- .header-titles -->

						<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
							<span class="toggle-inner">
								<span class="toggle-icon">
									<?php twentytwenty_the_theme_svg( 'ellipsis' ); ?>
								</span>
								<span class="toggle-text"><?php _e( 'Menu', 'twentytwenty' ); ?></span>
							</span>
						</button><!-- .nav-toggle -->

					</div><!-- .header-titles-wrapper -->

					<div class="header-navigation-wrapper">

						<?php
						if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
							?>

								<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x( 'Horizontal', 'menu', 'twentytwenty' ); ?>" role="navigation">

									<ul class="primary-menu reset-list-style">

									<?php
									if ( has_nav_menu( 'primary' ) ) {

										wp_nav_menu(
											array(
												'container'  => '',
												'items_wrap' => '%3$s',
												'theme_location' => 'primary',
											)
										);

									} elseif ( ! has_nav_menu( 'expanded' ) ) {

										wp_list_pages(
											array(
												'match_menu_classes' => true,
												'show_sub_menu_icons' => true,
												'title_li' => false,
												'walker'   => new TwentyTwenty_Walker_Page(),
											)
										);

									}
									?>
									</ul>

									
								</nav><!-- .primary-menu-wrapper -->

							<?php
						}

						?>

					</div><!-- .header-navigation-wrapper -->

				</div><!-- .header-inner -->
			</div>
		</header><!-- #site-header -->

		<?php
		//Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );
