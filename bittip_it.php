<?php
/*
Plugin Name: Bittip.It - Bitcoin Donation Button
Plugin URI: http://bittip.it/
Description: Adds a Bitcoin Donation Button to your posts. Start accepting Bitcoin now!
Author: Ben Jones
Author URI: http://benjaminpeterjones.com/
License: GPL2
Version: 1.0.1
*/

/*
 * Yup
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * -------------------------------------------
 
 * --------Beyond the Plugin--------
 * If you are interested in adding to the BBM plugin, please contact me first (ben.p.js@gmail.com).
 * If you are looking for something beyond the scope of this plugin, I am available for hire as a 
 * developer.
 * */

add_action('admin_init', 'bittipit_options_init' );
add_action('admin_menu', 'bittipit_options_add_page');



// Init plugin options to white list our options
function bittipit_options_init(){
	register_setting( 'bittipit_options_options', 'bittipit_options', 'bittipit_options_validate' );
}

// Add menu page
function bittipit_options_add_page() {
	add_options_page('Bittip.It Options', 'Bittip.It Options', 'manage_options', 'bittipit_options', 'bittipit_options_do_page');
}


// Draw the menu page itself
function bittipit_options_do_page() {
	
	wp_enqueue_media();
	
	?>
	<div class="wrap">
		<h2>Bittip.It Button Options</h2>
		<form method="post" action="options.php">
			<?php settings_fields('bittipit_options_options'); ?>
			<?php $options = get_option('bittipit_options'); ?>
			
			<table class="form-table">
			
				<tr valign="top"><th scope="row">Bitcoin Address</th>
					<td><input style="width:400px" type="text" name="bittipit_options[bitcoinAddress]" value="<?php echo $options['bitcoinAddress']; ?>" /></td>
				</tr>
				
				<tr valign="top"><th scope="row">Default Donation Amount (BTC)</th>
					<td><input style="width:400px" type="number"  step="any" name="bittipit_options[defaultDonation]" value="<?php echo $options['defaultDonation']; ?>" /></td>
				</tr>
				
				<?php 
				
				if ($options['counter'] == 'total-btc'){
				
					$select = 'selected="selected"';
				
				} else {
				
					$select = '';
				}
				
				?>
				
				<tr valign="top"><th scope="row">Counter</th>
					<td>
					<select style="width:400px" type="number" name="bittipit_options[counter]">
						<option value="counter">Number of donations</option>
						<option <?php echo $select; ?> value="total-btc">Total BTC received</option>
					</select>
					</td>
				</tr>
				
				<?php
				
				if ($options['posts']){
				
					$checked = 'checked="checked"';
				
				} else {
				
					$checked = '';
				}
				
				?>
				
				<tr valign="top"><th scope="row">Display on posts</th>
					<td><input type="checkbox" name="bittipit_options[posts]" <?php echo $checked; ?> value="posts"></td>
				</tr>
				
				<?php
				
				if ($options['pages']){
				
					$checked = 'checked="checked"';
				
				} else {
				
					$checked = '';
				}
				
				?>
				
				
				<tr valign="top"><th scope="row">Display on pages</th>
					<td><input type="checkbox" name="bittipit_options[pages]"  <?php echo $checked; ?> value="pages"></td>
				</tr>
				
				
			</table>
			
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
            <input type="submit" class="button-primary" id="hidden-submit" style="
            position: fixed;
            bottom: 30px;
            display: none;
            z-index: 20;
            right: 38px;" value="<?php _e('Save Changes') ?>" />    
		</form>
		
		<h3>Tip me!</h3>
		<p>
			Say thanks by tipping me!
		</p>
		<p>
			<a href="http://bittip.it/" class="bittip-button" default-amount="0.01" request="count" url="" donation-message="" donation-address="1LVc9bCWTSvGeLg7ssUxERjN9MP9AUx3AC"></a>
			<script>(function() {var s = document.createElement('script');var t = document.getElementsByTagName('script')[0];s.type = 'text/javascript';s.async = true;var url; if (window.location.protocol == 'https:'){url = 'https://bitcoinsberlin.com/wp-content/uploads/2013/01/button-loader.js'} else { url = 'http://bittip.it/cdn/button-loader.js';};s.src = url;t.parentNode.insertBefore(s, t);})();<\/script>
		</p>
		
		<p>Full support can be found <a href="http://bittip.it/wordpress-plugin/" target="_blank" title="Bitcoin Donation Button Support">here</a>.
		</p>
	</div>
	
	
	<?php	
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function bittipit_options_validate($input) {
	// Our first value is either 0 or 1
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );
	
	// Say our second option must be safe text with no HTML tags
	$input['sometext'] =  wp_filter_nohtml_kses($input['sometext']);
	
	return $input;
}




register_activation_hook(__FILE__, 'my_plugin_activate');
add_action('admin_init', 'my_plugin_redirect');

function my_plugin_activate() {
    add_option('my_plugin_do_activation_redirect', true);
}

function my_plugin_redirect() {
    if (get_option('my_plugin_do_activation_redirect', false)) {
		delete_option('my_plugin_do_activation_redirect' );
		
			echo '<div class="updated">
			   <h2>Add your Bitcoin Address</h2>
			   <p>To start accepting Bitcoin, you have to enter your Bitcoin address.</p>
			   <a href="'.home_url().'/wp-admin/options-general.php?page=bittipit_options" class="button button-primary button-large" style="
					margin-bottom: 10px;
				">Configure Settings</a>
			</div>';
    }
}

function add_after_content($content) {

	$options = get_option('bittipit_options');

	$defaultDonation = $options['defaultDonation'];
	$bitcoinAddress = $options['bitcoinAddress'];
	$counter = $options['counter'];

	if ($counter == 'total-btc'){
		$request = 'amount';
	} else {
		$request = 'count';
	}
	
	$posts = $options['posts'];
	$pages = $options['pages'];
	

	$button = '<p><a href="http://bittip.it/" class="bittip-button" default-amount="'.$defaultDonation.'" request="'.$request.'" url="" donation-message="" donation-address="'.$bitcoinAddress.'"></a></p>';
	$button .= "<script>(function() {var s = document.createElement('script');var t = document.getElementsByTagName('script')[0];s.type = 'text/javascript';s.async = true;var url; if (window.location.protocol == 'https:'){url = 'https://bitcoinsberlin.com/wp-content/uploads/2013/01/button-loader.js'} else { url = 'http://bittip.it/cdn/button-loader.js';};s.src = url;t.parentNode.insertBefore(s, t);})();</script>";

	if ( ((strlen($bitcoinAddress) >34) || (strlen($bitcoinAddress) < 27)) && is_admin_bar_showing()){

		return $content.'<p>There\'s a problem with your Bitcoin Address. Check it <a href="'.home_url().'/wp-admin/options-general.php?page=bittipit_options">here</a></p>';
		
	} else if ( ((strlen($bitcoinAddress) >34) || (strlen($bitcoinAddress) < 27)) && !(is_admin_bar_showing())) {

	
		return $content;
		
	
	} else {

		if (  (get_post_type( $post ) == "post")   &&   ($posts == 'posts')  ){
		
			return $content.$button;
		
		} else if (   (get_post_type( $post ) == "page")      &&   ($pages == 'pages') ){
		
			return $content.$button;
		
		} else {
		
			//Settings ok. Now returning if content not a stub
		
			if (strlen($content) > 500){
			
				return $content;
				
			}
			
		}
	
	}
}

add_filter('the_content', add_after_content);
?>
