<?php
// financial-calculators.com savings calculator plugin
//
// Copyright (c) 2017 financial-calculators.com
// https://financial-calculators.com
//
// This is an add-on for WordPress
// http://wordpress.org/
//
// **********************************************************************
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// The copyright and this notice must remain intact with any derivations
// of this plugin.
// **********************************************************************
/*
Plugin Name: FC Savings Calculator
Plugin URI: https://financial-calculators.com/calculator-plugins/savings-calculator-plugin
Description: A responsive savings calculator with cumulative schedule and charts. Rebrand with your brand name. Supports multiple currency and date conventions.
Version: 1.1.2
Author: financial-calculators.com
Author URI: https://financial-calculators.com
License: GPL2
*/


/*
	Prefixes:
	fc or fc_ : financial calculators
	op_ : option, set via plugin's admin panel or passed in options object
	sc_ : a shortcode parameter

	Function call:
	<?php show_fcsavings_plugin(<option array>); ?>

	Option array:
	array('op_size' => "large",
		'op_custom_style' => "No",
		'op_add_link' => "No",
		'op_brand_name' => "",
		'op_hide_resize' => "No",
		'op_save_amt' => "950.0",
		'op_n_months' => "180",
		'op_rate' => "5.5")

	Shortcode - all options:
	[fcsavingsplugin sc_size="medium" sc_custom_style="No" sc_add_link="No" sc_brand_name="" sc_hide_resize="No" sc_save_amt="1200.0" sc_n_months="240" sc_rate="5.5"]

*/


/* Function: activate_fcsavings_plugin
	** activation hook
	** Initializes the options in the WordPress database when
	** plugin is activated
	**
	** args: none
	** returns: nothing
*/
function activate_fcsavings_plugin() {

	/* activation code here */
	/* as options are added to widget, this array must be updated to update db */
	update_option('fcsavingscalc_plugin', array(
		'op_size' => null,
		'op_custom_style' => "No",
		'op_add_link' => "No",
		'op_brand_name' => "",
		'op_hide_resize' => "No",
		'op_save_amt' => "1200.0",
		'op_n_months' => "240",
		'op_rate' => "5.5"
		));

}
register_activation_hook( __FILE__, 'activate_fcsavings_plugin' );


/* Function: show_fcsavings_widget
** Shows the plugin in a WordPress widget area / sidebar
**
** args: $args (environment variables handled automatically by the hook)
** returns: nothing
*/
function show_fcsavings_widget( $args ) {
	extract( $args );
	$options = get_option( 'fcsavingscalc_plugin' );
	$title = null;

	//production
	echo $before_widget;
	echo $before_title . $title . $after_title;

	show_fcsavings_plugin($options);

	echo $after_widget;

} // show_fcsavings_widget



/* Function: show_fcsavings_plugin
** Show the plugin's GUI, not in sidebar
**
** args: $options
** returns: nothing
*/
function show_fcsavings_plugin($options = array(), $content = null, $code = "") {

	$shortcode = null;  // The actual shortcode : fcsavingsplugin

	$language = "en";

	$WL_DIR_PREFIX = $language."/";

	$size = null; // tiny, small, medium, null default large
	$custom_style = null;
	$add_link = null;
	$brand_name = null;
	$hide_resize = null;


	$WL_DIR_PREFIX = $language."/";


	// array_key_exists (0, $options) true only if shortcode is used
	if (!empty($code) || (!empty($options) && array_key_exists (0, $options) && (strtolower($options[0]) == 'fcsavingsplugin'))){
		$shortcode = true;

		//[fcsavingsplugin sc_size="medium" sc_custom_style="No" sc_add_link="No" sc_brand_name="" sc_hide_resize="No" sc_save_amt="1050.0" sc_n_months="360" sc_rate="5.5"]
		extract( shortcode_atts( array(
			'sc_size' => null,
			'sc_custom_style' => "No",
			'sc_add_link' => "No",
			'sc_brand_name' => "",
			'sc_hide_resize' => "No",
			'sc_save_amt' => "1050.0",
			'sc_n_months' => "120",
			'sc_rate' => "5.5"
		), $options ) );

		$size = $sc_size;
		$custom_style = $sc_custom_style;
		$add_link = $sc_add_link;
		$brand_name = $sc_brand_name;
		$hide_resize = $sc_hide_resize;
		$save_amt= $sc_save_amt;
		$n_months = $sc_n_months;
		$rate = $sc_rate;

		if (!is_numeric($save_amt)) {
			$save_amt= '0';
			echo('Please enter a valid number for "sc_save_amt".'."<br>");
		}
		if (!is_numeric($n_months)) {
			$n_months = '0';
			echo('Please enter a valid number for "sc_n_months".'."<br>");
		}
		if (!is_numeric($rate)) {
			$rate = '0';
			echo('Please enter a valid number for "sc_rate".'."<br>");
		}
		if (strtolower($add_link) != 'yes') {
			$brand_name = '';
		}

	} else {
		$shortcode = false;

		// process any optional parameters that may have been passed in
		$size = empty( $options["op_size"] ) ? null : strip_tags(stripslashes($options["op_size"]));
		$custom_style = empty( $options['op_custom_style'] ) ? null : strip_tags(stripslashes($options['op_custom_style']));
		$hide_resize = empty( $options['op_hide_resize'] ) ? null : strip_tags(stripslashes($options['op_hide_resize']));
		$add_link = empty( $options['op_add_link'] ) ? null : strip_tags(stripslashes($options['op_add_link']));
		$brand_name = empty( $options['op_brand_name'] ) ? null : strip_tags(stripslashes($options['op_brand_name']));
		$brand_name = preg_replace("/[^\w#&'\- ]/", '', $brand_name);
		$save_amt= empty( $options['op_save_amt'] ) ? null : strip_tags(stripslashes($options['op_save_amt']));
		$n_months = empty( $options['op_n_months'] ) ? null : strip_tags(stripslashes($options['op_n_months']));
		$rate = empty( $options['op_rate'] ) ? null : strip_tags(stripslashes($options['op_rate']));

		// pickup plugin's stored settings and use only if not a function parameter
		$options = get_option( 'fcsavingscalc_plugin' );

		if ($size == null) {
			$size = empty( $options["op_size"] ) ? 'large' : $options["op_size"];
		}
		if ($custom_style == null) {
			$custom_style = empty( $options['op_custom_style'] ) ? __('No') : $options['op_custom_style'];
		}
		if ($hide_resize == null) {
			$hide_resize = empty( $options['op_hide_resize'] ) ? __('No') : $options['op_hide_resize'];
		}
		if ($add_link == null) {
			$add_link = empty( $options['op_add_link'] ) ? __('No') : $options['op_add_link'];
		}
		if ($brand_name == null) {
			$brand_name = empty( $options['op_brand_name'] ) ? null : $options['op_brand_name'];
		}
		if ($save_amt== null) {
			$save_amt= empty( $options['op_save_amt'] ) ? '32500.0' : $options['op_save_amt'];
		}
		if ($n_months == null) {
			$n_months = empty( $options['op_n_months'] ) ? '48' : $options['op_n_months'];
		}
		if ($rate == null) {
			$rate = empty( $options['op_rate'] ) ? '5.5' : $options['op_rate'];
		}
		if (!is_numeric($save_amt)) {
			$save_amt= '0';
			echo('Please enter a valid number for "op_save_amt".'."<br>");
		}
		if (!is_numeric($n_months)) {
			$n_months = '0';
			echo('Please enter a valid number for "op_n_months".'."<br>");
		}
		if (!is_numeric($rate)) {
			$rate = '0';
			echo('Please enter a valid number for "op_rate".'."<br>");
		}
		if (strtolower($add_link) != 'yes') {
			$brand_name = '';
		}

		//echo "<br>" . "not a shortcode";
		//echo "$size " . $size . "<br>";
		//echo $custom_style . "<br>";
		//echo $add_link . "<br>";
		//echo $brand_name . "<br>";
		//echo $hide_resize . "<br>";
		//echo $save_amt. "<br>";
		//echo $n_months . "<br>";
		//echo $rate . "<br>";

	} // $shortcode = false;


	//
	// REGISTER STYLES
	//


	wp_register_style( 'fc-featherlight', plugins_url('css/featherlight.min.css', __FILE__), array(), false, 'screen' );

	wp_register_style( 'fincalcs-style', plugins_url('css/fin-calc-widgets.min.css', __FILE__), array(), false, 'screen' );

	if (strtolower($custom_style) === 'yes') {
		wp_register_style( 'fincalcs-custom-style', plugins_url('css/fin-calc-widgets-custom.css', __FILE__), array(), false, 'screen' );
	} 


	wp_register_style( 'fc-printer-style', plugins_url('css/printer.widget.min.css', __FILE__), array(), false, 'print');


	wp_enqueue_style( 'fc-featherlight' );
	wp_enqueue_style( 'fc-printer-style' );
	wp_enqueue_style( 'fincalcs-style' );


	// load a custom stylesheet so defaults can be easily overridden
	if (strtolower($custom_style) === 'yes') {
		wp_enqueue_style( 'fincalcs-custom-style' );
	} 


	if($shortcode) ob_start();


	// displays the widget
	include($WL_DIR_PREFIX."calculator.gui.php");



	//
	// REGISTER SCRIPTS
	//

	// is jQuery enqueued?
	if (!wp_script_is( 'jquery')) {
		wp_enqueue_script( 'jquery' );
	}

	// register supporting JavaScript libraries and Bootstrap
	wp_register_script('fc-supporting', plugins_url('js/supporting.WIDGETS.min.js', __FILE__), array('jquery'), '', true);
	wp_register_script('fc-custom-bootstrap', plugins_url('js/bootstrap.custom.min.js', __FILE__), array( 'jquery' ), '', true);
	// load the JavaScript math library
	wp_register_script('fc-savings-interface', plugins_url('js/interface.SAVINGS-WIDGET.min.js', __FILE__), array( 'jquery', 'fc-custom-bootstrap', 'fc-supporting'), '', true);



	wp_enqueue_script( 'fc-savings-interface' );

	if($shortcode){
		$result = ob_get_contents();
		ob_end_clean();
		if(is_null($content)){
			return $result;
		} else {
			return $content . $result;
		}
	}

} // show_fcsavings_plugin



/* Function: fcsavingsplugin_options
**
** Show/process options on the Wordpress admin's widget page
**
** args: nothing
** returns: nothing
*/
function fcsavingsplugin_options() {

	// financial-calculators.com savings calculator widget options
	$options = $newoptions = get_option('fcsavingscalc_plugin');

	// in event admin updated plugin but did not deactivate / activate, pickup possible new options
	if (!array_key_exists('op_size', $options) || !array_key_exists('op_custom_style', $options) || !array_key_exists('op_add_link', $options) || !array_key_exists('op_brand_name', $options) || !array_key_exists('op_hide_resize', $options) || !array_key_exists('op_save_amt', $options) || !array_key_exists('op_n_months', $options) || !array_key_exists('op_rate', $options)) {
		// echo('Updated options'. implode(" ", $options));
		update_option('fcsavingscalc_plugin', array(
			'op_size' => null,
			'op_custom_style' => "No",
			'op_add_link' => "No",
			'op_brand_name' => "",
			'op_hide_resize' => "No",
			'op_save_amt' => "1200.0",
			'op_n_months' => "240",
			'op_rate' => "5.5"
			));
		$options = $newoptions = get_option('fcsavingscalc_plugin'); // keep everything in sync
	}


	// if widget's options have previously been set/saved in current session
	if (!empty($_POST['fcsavingscalc_opts'])) {
		$newoptions['op_size'] = strip_tags(stripslashes($_POST['fcsavingscalc-op_size']));
		if (strtolower($newoptions['op_size']) != 'tiny' && strtolower($newoptions['op_size']) != 'small' && strtolower($newoptions['op_size']) != 'medium') {
			$newoptions['op_size'] = 'large';
		}
		$newoptions['op_custom_style'] = strip_tags(stripslashes($_POST['fcsavingscalc-op_custom_style']));
		if (strtolower($newoptions['op_custom_style']) != 'yes') {
			$newoptions['op_custom_style'] = 'No';
		}
		$newoptions['op_add_link'] = strip_tags(stripslashes($_POST['fcsavingscalc-op_add_link']));
		if (strtolower($newoptions['op_add_link']) != 'yes') {
			$newoptions['op_add_link'] = 'no';
		}
		// allow word characters, numbers, ampersand, dash, apostrophe, space and number sign
		$newoptions['op_brand_name'] = preg_replace("/[^\w#&'\- ]/", '', $_POST['fcsavingscalc-op_brand_name']);
		if (strtolower($newoptions['op_add_link']) != 'yes') {
			$newoptions['op_brand_name'] = '';
		}
		$newoptions['op_hide_resize'] = strip_tags(stripslashes($_POST['fcsavingscalc-op_hide_resize']));
		if (strtolower($newoptions['op_hide_resize']) != 'yes') {
			$newoptions['op_hide_resize'] = 'no';
		}
		$newoptions['op_save_amt'] = strip_tags(stripslashes($_POST['fcsavingscalc-op_save_amt']));
		$newoptions['op_n_months'] = strip_tags(stripslashes($_POST['fcsavingscalc-op_n_months']));
		$newoptions['op_rate'] = strip_tags(stripslashes($_POST['fcsavingscalc-op_rate']));

		//////////ctype_digit
		//echo(is_numeric($newoptions['op_save_amt']));
		//echo(is_numeric($newoptions['op_n_months']));
		//echo(is_numeric($newoptions['op_rate']));
		if (!is_numeric($newoptions['op_save_amt'])) {
			$newoptions['op_save_amt'] = '0';
			echo('Please enter a valid number for "Default savings amount".'."<br>");
		}
		if (!is_numeric($newoptions['op_n_months'])) {
			$newoptions['op_n_months'] = '0';
			echo('Please enter a valid number for "Default number of months:".'."<br>");
		}
		if (!is_numeric($newoptions['op_rate'])) {
			$newoptions['op_rate'] = '0';
			echo('Please enter a valid number for "Default interest rate".'."<br>");
		}
	} 
	//debug
	//else {
	//	echo('Options not yet posted.');
	//}


	// 1st check if options changed and if valid session
	if ( $options != $newoptions && (wp_verify_nonce($_POST['fcsavingscalc_opts'], 'fc_options'))) {
		// 2nd check permissions
		if ( is_user_logged_in() && current_user_can('update_plugins') ) {
			$options = $newoptions;
			update_option('fcsavingscalc_plugin', $options);
		}
		//debug
		//else if (array_key_exists('fcsavingscalc_opts', $_POST) && (!wp_verify_nonce($_POST['fcsavingscalc_opts'], 'fc_options'))) {
		//	echo ('Update failed. Session expired. Please log in again.');
		//}
	}

	$brand_name = esc_attr($options['op_brand_name']);
	$save_amt = esc_attr($options['op_save_amt']);
	$n_months = esc_attr($options['op_n_months']);
	$rate = esc_attr($options['op_rate']);

	//echo empty( $options['op_size']) . "<br>";
	//echo empty( $options['op_custom_style']) . "<br>";
	//echo empty( $options['op_add_link']) . "<br>";
	//echo empty( $options['op_brand_name']) . "<br>";
	//
	//echo $options['op_size'] . "<br>";
	//echo $options['op_custom_style'] . "<br>";
	//echo $options['op_add_link'] . "<br>";
	//echo $options['op_brand_name'] . "<br>";

?>

		<!--HTML for widget's option page in WordPress' admin panel-->
		<p>
			<label for="fcsavingscalc-op_size"><?php _e( 'Widget\'s size?:' ); ?>
				<select name="fcsavingscalc-op_size" id="fcsavingscalc-op_size" class="widefat">
					<option value="tiny"<?php selected( $options['op_size'], 'tiny' ); ?>><?php _e('Tiny (max width = 150px)'); ?></option>
					<option value="small"<?php selected( $options['op_size'], 'small' ); ?>><?php _e('Small (max width = 290px)'); ?></option>
					<option value="medium"<?php selected( $options['op_size'], 'medium' ); ?>><?php _e('Medium (max width = 340px)'); ?></option>
					<option value="large"<?php selected( $options['op_size'], 'large' ); ?>><?php _e('Large (max width = 440px)'); ?></option>
				</select>
			</label>
		</p>

		<p>
			<label for="fcsavingscalc-op_custom_style"><?php _e( 'Load custom style sheet?:' ); ?>
				<select name="fcsavingscalc-op_custom_style" id="fcsavingscalc-op_custom_style" class="widefat">
					<option value="No"<?php selected( $options['op_custom_style'], 'No' ); ?>><?php _e('No'); ?></option>
					<option value="Yes"<?php selected( $options['op_custom_style'], 'Yes' ); ?>><?php _e('Yes'); ?></option>
				</select>
			</label>
		</p>
		<p>
			If &quot;Yes&quot; loads &lt;site&gt;\wp-content\plugins\fc-savings-calculator\css\fin-calc-widgets-custom.css. Entries in <b>fin-calc-widgets-custom.css</b> modify the widget's look. Editing the provided custom stylesheet is the best way to change colors.
		</p>


		<p>
			<label for="fcsavingscalc-op_hide_resize"><?php _e( 'Hide the resize buttons?:' ); ?>
				<select name="fcsavingscalc-op_hide_resize" id="fcsavingscalc-op_hide_resize" class="widefat">
					<option value="No"<?php selected( $options['op_hide_resize'], 'No' ); ?>><?php _e('No'); ?></option>
					<option value="Yes"<?php selected( $options['op_hide_resize'], 'Yes' ); ?>><?php _e('Yes'); ?></option>
				</select>
			</label>
		</p>


		<p>
			<label for="fcsavingscalc-op_add_link"><?php _e( 'Allow plugin to add links to financial-calculators.com?:' ); ?>
				<select name="fcsavingscalc-op_add_link" id="fcsavingscalc-op_add_link" class="widefat">
					<option value="No"<?php selected( $options['op_add_link'], 'No' ); ?>><?php _e('No'); ?></option>
					<option value="Yes"<?php selected( $options['op_add_link'], 'Yes' ); ?>><?php _e('Yes'); ?></option>
				</select>
			</label>
		</p>
		<p>
			If &quot;Yes&quot;, two very discreet follow links will be inserted in the calculator. If you allow the links, you can rebrand the calculator to include your name or that of your business. Resetting this option to &quot;No&quot; at any time will remove the links. See FAQ's for details.
		</p>



		<p><label for="fcsavingscalc-op_brand_name"><?php _e('Add Your Brand Name:'); ?> <input class="widefat" id="fcsavingscalc-op_brand_name" name="fcsavingscalc-op_brand_name" type="text" value="<?php echo $brand_name; ?>" /></label>
		</p>
		<p>
		You may brand this widget with your brand. <b>Example: &quot;<b>Ben's</b>&quot;</b> will be preappended to &quot;Savings Calculator&quot; For this to work, the above &quot;add links&quot; option must be set to &quot;Yes&quot;.
		</p>

		<div style="width:100%; float:left; clear:both;"><div style="width:45%; float:left; margin-right:4px;"><label for="fcsavingscalc-op_save_amt"><?php _e('Default savings amount:'); ?> <input class="widefat" id="fcsavingscalc-op_save_amt" name="fcsavingscalc-op_save_amt" type="text" value="<?php echo $save_amt; ?>" /></label></div>
			<div style="width:45%; float:left"><label for="fcsavingscalc-op_n_months"><?php _e('Default number of months:'); ?> <input class="widefat" id="fcsavingscalc-op_n_months" name="fcsavingscalc-op_n_months" type="text" value="<?php echo $n_months; ?>" /></label></div></div>
		<div style="width:100%; float:left; clear:both;"><div style="width:45%; float:left; margin-right:4px;"><label for="fcsavingscalc-op_rate"><?php _e('Default interest rate:'); ?> <input class="widefat" id="fcsavingscalc-op_rate" name="fcsavingscalc-op_rate" type="text" value="<?php echo $rate; ?>" /></label></div><div style="width:45%; float:left"><p style="text-align:center"><?php _e('Enter only digits.<br>No formatting.'); ?></p></div></div>
		

		<p><b>Note:</b> Your visitors will be able to select the date and currency conventions they need by clicking on &quot<b>$ : MM/DD/YYYY</b>&quot; in the calculator's lower right corner.</p>

		<input type="hidden" id="fcsavingscalc_opts" name="fcsavingscalc_opts" value="<?php echo wp_create_nonce('fc_options'); ?>" />


<?php

}



/* Function: fcsavingsplugin_register
**
** Registers the plugin to show in WordPress' admin's widget page.
**
** args: none
** returns: nothing
*/
function fcsavingsplugin_register() {
	$widget_ops = array('classname' => 'fcsavingscalc_plugin', 'description' => __('Savings Calculator by financial-calculators.com'));

	$name = __('Savings Calculator');

	// Register WordPress Widgets for use in your themes sidebars.
	// You can also modify your theme and start Customizing Your Sidebar. 
	// wp_register_sidebar_widget($id, $name, $output_callback, $options, $params, ... ); 
	wp_register_sidebar_widget( 'fcsavingsplugin', $name, 'show_fcsavings_widget', $widget_ops );


	// Draws the controls form on the WordPress's widget page in admin area
	// and saves the settings when the "Save" button is clicked
	// Registers widget control callback for customizing options.
	// wp_register_widget_control( int|string $id, string $name, callable $control_callback, array $options = array() )
	wp_register_widget_control( 'fcsavingsplugin', $name, 'fcsavingsplugin_options' );
} // fcsavingsplugin_register


// Hooks a function on to a specific action.
add_action( 'widgets_init', 'fcsavingsplugin_register' );

// Adds a hook for a shortcode tag.
add_shortcode( 'fcsavingsplugin', 'show_fcsavings_plugin' );


/* end of file */
