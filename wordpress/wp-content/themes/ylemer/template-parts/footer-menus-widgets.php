<?php
/**
 * Displays the menus and widgets at the end of the main element.
 * Visually, this output is presented as part of the footer element.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$has_footer_menu = has_nav_menu( 'footer' );
$has_social_menu = has_nav_menu( 'social' );

$has_sidebar_1 = is_active_sidebar( 'sidebar-1' );
$has_sidebar_2 = is_active_sidebar( 'sidebar-2' );

// Only output the container if there are elements to display.
if ( $has_footer_menu || $has_social_menu || $has_sidebar_1 || $has_sidebar_2 ) {
	?>

	<div class="footer-nav-widgets-wrapper header-footer-group">

		<div class="footer-inner section-inner">
			
			<section class="container" id="footer-cta">
                <h2>Ylemer brings real transformation to businesses.</h2>
                <p class="quote">
                    Ylemer aims to create an ultimate online community, empowering startups to collaborate, 
                    share, grow, and learn on their entrepreneurial journey. We bring together individuals 
                    and businesses that share a similar vision.
                </p>
                <a href="https://ylemer.io/" target="__blank" class="btn btn-warning join-now">Join Us Now!</a>
            </section>

			<?php

			$footer_top_classes = '';

			$footer_top_classes .= $has_footer_menu ? ' has-footer-menu' : '';

			if ( $has_footer_menu || $has_social_menu ) {
				?>
				<div class="footer-top<?php echo $footer_top_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
					<?php if ( $has_footer_menu ) { ?>

						<nav aria-label="<?php esc_attr_e( 'Footer', 'twentytwenty' ); ?>" role="navigation" class="footer-menu-wrapper">

							<ul class="footer-menu reset-list-style">
								<?php
								wp_nav_menu(
									array(
										'container'      => '',
										'depth'          => 1,
										'items_wrap'     => '%3$s',
										'theme_location' => 'footer',
									)
								);
								?>
							</ul>

						</nav><!-- .site-nav -->

					<?php } ?>
				</div><!-- .footer-top -->

			<?php } ?>


            <section class="address-details">
                <div class="container social-links">
                	<div class="row">
                		<div class="col-6 with-z-index col-6-footer">
                			<div class="footer-logo">
                				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/default.png" alt="logo"/>
                			</div>
                		</div>
                		<div class="col-4 follow-us-links with-z-index">
                			<b>Follow us</b>
                                <ul class="footer-social-links">
                                    <li class="ml-0">
                                        <a href='https://www.facebook.com/Ylemer.corp/' target='blank' class="facebook-icon">
                                            <span class="fa fa-facebook"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href='https://twitter.com/ylemercorp' target='blank'>
                                            <span class="fa fa-twitter"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href='https://www.linkedin.com/company/ylemer' target='blank'>
                                            <span class="fa fa-linkedin"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href='https://medium.com/@Ylemer.corp' target='blank'>
                                            <span class="fa fa-medium"></span>
                                        </a>
                                    </li>
                                </ul>
                		</div>
                		<div class="col connect-to-us-links with-z-index">
                			<b>Connect to us</b>
                            <ul class="footer-social-links justify-content-center mt-1">
                                <li class="ml-0">
                                    <a href='https://bit.ly/YlemerCommunity' target='blank'>
                                        <span class="fa fa-slack"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href='mailto:info@ylemer.com'>
                                        <span class="fa fa-envelope"></span>
                                    </a>
                                </li>
                            </ul>
                		</div>
                	</div>

                	<div class="row contact-details">
                		<div class="col-8">
                			<p>
                                <span class="fa fa-map-marker mr-3"></span>
                                <b>Auchenflower, QLD, 4066, Australia</b>
                            </p>
                            <p class="phone-number">
                                <span class="fa fa-phone mr-3"></span>
                                <b> <a href="tel: +61 7370 310 91"> +61 7370 310 91</a></b>
                            </p>
                		</div>
                		<div class="col-4">
                			<p class="contact-p">
                                <b>
                                    Copyright 2020 &copy; Ylemer PTY LTD All right reserved.
                                </b><br/>
                                <span><a href="https://ylemer.io/terms-and-conditions"> Terms and Conditions</a></span>
                                <span><a href="https://ylemer.io/privacy-policy"> | Privacy Policy</a></span>
                        	</p>
                		</div>
                	</div>

                    <div class="mt-2">
                        <div>
                            
                        </div>
                        
                    </div>
                </div>
                </section>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/footer-bar.png" alt="border-top-blue" />

		</div><!-- .footer-inner -->

	</div><!-- .footer-nav-widgets-wrapper -->
      <span class="border-separator"> </span>
<?php } ?>
