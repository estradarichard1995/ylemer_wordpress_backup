<?php
/*
Plugin Name: Block for Font Awesome
Plugin URI: https://getbutterfly.com/wordpress-plugins/block-for-font-awesome/
Description: Display a Font Awesome 5 icon in a Gutenberg block.
Version: 1.1.8
Author: Ciprian Popescu
Author URI: https://getbutterfly.com/
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Font Awesome Free (c) (https://fontawesome.com/license)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

if (!function_exists('add_filter')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');

    exit();
}

require_once 'block/index.php';

function getbutterfly_fa_enqueue() {
    wp_enqueue_script('fa5', 'https://use.fontawesome.com/releases/v5.15.2/js/all.js', [], '5.15.2', true);
}

if ((int) get_option('fa_enqueue_fe') === 1) {
    add_action('wp_enqueue_scripts', 'getbutterfly_fa_enqueue');
}

if ((int) get_option('fa_enqueue_be') === 1) {
    add_action('admin_enqueue_scripts', 'getbutterfly_fa_enqueue');
}

add_action('init', 'getbutterfly_fa_block_init');

add_filter('block_categories', 'getbutterfly_block_categories', 10, 2);
add_action('enqueue_block_editor_assets', 'getbutterfly_fa_block_enqueue');

add_shortcode('fa', 'getbutterfly_fa_block_render');



register_activation_hook(__FILE__, 'getbutterfly_fa_on_activation');

function getbutterfly_fa_on_activation() {
    add_option('fa_enqueue_fe', 1);
    add_option('fa_enqueue_be', 1);
}



function getbutterfly_fa_menu_links() {
    add_options_page('Font Awesome Settings', 'Font Awesome', 'manage_options', 'fa', 'getbutterfly_fa_build_admin_page');
}

add_action('admin_menu', 'getbutterfly_fa_menu_links', 10);

function getbutterfly_fa_build_admin_page() {
    $tab = (filter_has_var(INPUT_GET, 'tab')) ? filter_input(INPUT_GET, 'tab') : 'dashboard';
    $section = 'admin.php?page=fa&amp;tab=';
	?>
    <div class="wrap">
        <h1>Font Awesome Settings</h1>

        <h2 class="nav-tab-wrapper">
            <a href="<?php echo $section; ?>dashboard" class="nav-tab <?php echo $tab === 'dashboard' ? 'nav-tab-active' : ''; ?>">Dashboard</a>
            <a href="<?php echo $section; ?>help" class="nav-tab <?php echo $tab === 'help' ? 'nav-tab-active' : ''; ?>">Help</a>
        </h2>

        <?php if ($tab === 'dashboard') { ?>
            <h2><span class="dashicons dashicons-superhero"></span> Dashboard</h2>

            <?php
            if (isset($_POST['save_fa_settings'])) {
                update_option('fa_enqueue_fe', (int) $_POST['fa_enqueue_fe']);
                update_option('fa_enqueue_be', (int) $_POST['fa_enqueue_be']);

                echo '<div class="updated notice is-dismissible"><p>Settings updated successfully!</p></div>';
            }
            ?>

            <form method="post">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label>Font Awesome</label></th>
                            <td>
                                <p>
                                    <input type="checkbox" name="fa_enqueue_fe" value="1" <?php checked(1, (int) get_option('fa_enqueue_fe')); ?>> Enqueue on front-end
                                </p>
                                <p>
                                    <input type="checkbox" name="fa_enqueue_be" value="1" <?php checked(1, (int) get_option('fa_enqueue_be')); ?>> Enqueue on back-end
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><input type="submit" name="save_fa_settings" class="button button-primary" value="Save Changes"></th>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </form>

            <hr>
            <p>For support, feature requests and bug reporting, please visit the <a href="https://getbutterfly.com/" rel="external">official website</a>. If you enjoy this plugin, don't forget to rate it. Also, try our other WordPress plugins at <a href="https://getbutterfly.com/wordpress-plugins/" rel="external" target="_blank">getButterfly.com</a>.</p>
            <p>&copy;<?php echo date('Y'); ?> <a href="https://getbutterfly.com/" rel="external"><strong>getButterfly</strong>.com</a> &middot; <small>Code wrangling since 2005</small></p>
        <?php } else if ($tab === 'help') { ?>
            <h2><span class="dashicons dashicons-editor-help"></span> Help</h2>

            <p>This plugin allows you to display any Font Awesome 5 icon as an editor block (Gutenberg).</p>
            <p>You can also display inline icons by using the <code>[fa class="fas fa-fw fa-3x fa-phone"]</code> shortcode.</p>

            <p><a href="https://getbutterfly.com/wordpress-plugins/block-for-font-awesome/" class="button button-primary">Documentation</a></p>

            <hr>
            <p>For support, feature requests and bug reporting, please visit the <a href="https://getbutterfly.com/" rel="external">official website</a>. If you enjoy this plugin, don't forget to rate it. Also, try our other WordPress plugins at <a href="https://getbutterfly.com/wordpress-plugins/" rel="external" target="_blank">getButterfly.com</a>.</p>
            <p>&copy;<?php echo date('Y'); ?> <a href="https://getbutterfly.com/" rel="external"><strong>getButterfly</strong>.com</a> &middot; <small>Code wrangling since 2005</small></p>
        <?php } ?>
    </div>
	<?php
}
