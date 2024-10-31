<?php
/*
Plugin Name: scroll to top
Plugin URI: http://prowpexpert.com/
Description: This is scroll to top plugin really looking awesome top scroll. Everyone can use the top scroll plugin easily like other wordpress plugin. 
Author: Md sohel
Version: 1.0
Author URI: http://prowpexpert.com/
*/
function scroll_wp_latest_jquery_d() {
	wp_enqueue_script('jquery');
}
add_action('init', 'scroll_wp_latest_jquery_d');

/*Some Set-up*/
define('WP_CAROUSEL_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

function plugin_function_scroll() {
   // wp_enqueue_script( 'jeba-js-d', plugins_url( '/js/jquery.divas-1.1.min.js', __FILE__ ), true);
 // wp_enqueue_style( 'jebacss-d', plugins_url( 'style.css', __FILE__ ));
    wp_enqueue_style( 'fontello-css', WP_CAROUSEL_PLUGIN_PATH.'style/type/fontello.css');
}

add_action('init','plugin_function_scroll');


function scroll_script_function () {?>
	<script type="text/javascript">
		
/*-----------------------------------------------------------------------------------*/
/*	GO TO TOP
/*-----------------------------------------------------------------------------------*/
! function (a, b, c) {
    a.fn.scrollUp = function (b) {
        a.data(c.body, "scrollUp") || (a.data(c.body, "scrollUp", !0), a.fn.scrollUp.init(b))
    }, a.fn.scrollUp.init = function (d) {
        var e = a.fn.scrollUp.settings = a.extend({}, a.fn.scrollUp.defaults, d),
            f = e.scrollTitle ? e.scrollTitle : e.scrollText,
            g = a("<a/>", {
                id: e.scrollName,
                href: "#top",
                title: f
            }).appendTo("body");
        e.scrollImg || g.html(e.scrollText), g.css({
            display: "none",
            position: "fixed",
            zIndex: e.zIndex
        }), e.activeOverlay && a("<div/>", {
            id: e.scrollName + "-active"
        }).css({
            position: "absolute",
            top: e.scrollDistance + "px",
            width: "100%",
            borderTop: "1px dotted" + e.activeOverlay,
            zIndex: e.zIndex
        }).appendTo("body"), scrollEvent = a(b).scroll(function () {
            switch (scrollDis = "top" === e.scrollFrom ? e.scrollDistance : a(c).height() - a(b).height() - e.scrollDistance, e.animation) {
            case "fade":
                a(a(b).scrollTop() > scrollDis ? g.fadeIn(e.animationInSpeed) : g.fadeOut(e.animationOutSpeed));
                break;
            case "slide":
                a(a(b).scrollTop() > scrollDis ? g.slideDown(e.animationInSpeed) : g.slideUp(e.animationOutSpeed));
                break;
            default:
                a(a(b).scrollTop() > scrollDis ? g.show(0) : g.hide(0))
            }
        }), g.click(function (b) {
            b.preventDefault(), a("html, body").animate({
                scrollTop: 0
            }, e.topSpeed, e.easingType)
        })
    }, a.fn.scrollUp.defaults = {
        scrollName: "scrollUp",
        scrollDistance: 300,
        scrollFrom: "top",
        scrollSpeed: 300,
        easingType: "linear",
        animation: "fade",
        animationInSpeed: 200,
        animationOutSpeed: 200,
        scrollText: "Scroll to top",
        scrollTitle: !1,
        scrollImg: !1,
        activeOverlay: !1,
        zIndex: 2147483647
    }, a.fn.scrollUp.destroy = function (d) {
        a.removeData(c.body, "scrollUp"), a("#" + a.fn.scrollUp.settings.scrollName).remove(), a("#" + a.fn.scrollUp.settings.scrollName + "-active").remove(), a.fn.jquery.split(".")[1] >= 7 ? a(b).off("scroll", d) : a(b).unbind("scroll", d)
    }, a.scrollUp = a.fn.scrollUp
}(jQuery, window, document);

jQuery(document).ready(function () {
    jQuery.scrollUp({
        scrollName: 'scrollUp', // Element ID
        scrollDistance: 300, // Distance from top/bottom before showing element (px)
        scrollFrom: 'top', // 'top' or 'bottom'
        scrollSpeed: 300, // Speed back to top (ms)
        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
        animation: 'fade', // Fade, slide, none
        animationInSpeed: 200, // Animation in speed (ms)
        animationOutSpeed: 200, // Animation out speed (ms)
        scrollText: '<i class="icon-up-open"></i>', // Text for element, can contain HTML
        scrollTitle: false, // Set a custom <a> title if required. Defaults to scrollText
        scrollImg: false, // Set true to use image
        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        zIndex: 1001 // Z-Index for the overlay
    });
});
	</script>
	

<?php
}
add_action('wp_footer','scroll_script_function');





function add_scroll_top_options_framwrork()  
{  
	add_options_page('Scroll top settings', 'Scroll top settings', 'manage_options', 'scrolltop-settings','scroll_top_options_framwrork');  
}  
add_action('admin_menu', 'add_scroll_top_options_framwrork');


add_action( 'admin_enqueue_scripts', 'wp_add_color_picker' );
function wp_add_color_picker( $hook ) {
 
    if( is_admin() ) {
     
        // Add the color picker css file      
        wp_enqueue_style( 'wp-color-picker' );
         
        // Include our custom jQuery file with WordPress Color Picker dependency
        wp_enqueue_script( 'custom-script-handle', plugins_url( '/inc/color-pickr.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    }
}


if ( is_admin() ) : // Load only if we are viewing an admin page






function scroll_top_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'scroll_top_p_options', 'scroll_top_options', 'scroll_top_validate_options' );
}

add_action( 'admin_init', 'scroll_top_register_settings' );

// Default options values
$scroll_top_options = array(
	'scroll_bottom_bg' => ' rgba(0,0,0,0.3)',
	'scroll_icon_color' => '#fff'
);

// Function to generate options page
function scroll_top_options_framwrork() {
	global $scroll_top_options, $auto_hide_mode, $where_visible_scrollbar;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	
	<h2>Scroll to top Options</h2>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'scroll_top_options', $scroll_top_options ); ?>
	
	<?php settings_fields( 'scroll_top_p_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	
	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->
	
	


		<tr valign="top">
			<th scope="row"><label for="scroll_bottom_bg">Scroll top Background</label></th>
			<td>
				<input id="scroll_bottom_bg" type="text" name="scroll_top_options[scroll_bottom_bg]" value="<?php echo stripslashes($settings['scroll_bottom_bg']); ?>" class="color-field" /><p class="description">Select Scroll bottom color here. You can also add html HEX color code.</p>
			</td>
		</tr>	

		<tr valign="top">
			<th scope="row"><label for="scroll_icon_color">Scroll top icon color</label></th>
			<td>
				<input id="scroll_icon_color" type="text" name="scroll_top_options[scroll_icon_color]" value="<?php echo stripslashes($settings['scroll_icon_color']); ?>" class="color-field" /><p class="description">Select scroll top icon color here. You can also add html HEX color code.</p>
			</td>
		</tr>	

			
	</table>

	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}


function scroll_top_validate_options( $input ) {
	global $scroll_top_options;

	$settings = get_option( 'scroll_top_options', $scroll_top_options );
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS

	$input['scroll_bottom_bg'] = wp_filter_post_kses( $input['scroll_bottom_bg'] );
	$input['scroll_icon_color'] = wp_filter_post_kses( $input['scroll_icon_color'] );

		
		
	
	return $input;
}


endif;  // EndIf is_admin()



function get_scroll_top_data_form_plugin() {

?>

<?php global $scroll_top_options; $scroll_top_options_settings = get_option( 'scroll_top_options', $scroll_top_options ); ?>

<style type="text/css">
	
	/*-----------------------------------------------------------------------------------*/
	/*	GO TO TOP
	/*-----------------------------------------------------------------------------------*/
	#scrollUp {
		bottom: 20px;
		right: 20px;
		text-decoration: none;
		background: <?php echo $scroll_top_options_settings['scroll_bottom_bg']; ?>;
		color: <?php echo $scroll_top_options_settings['scroll_icon_color']; ?> ;
		-webkit-border-radius: 3px;
		border-radius: 3px;
		-webkit-transition: background 200ms linear;
		-moz-transition: background 200ms linear;
		transition: background 200ms linear;
		-webkit-backface-visibility: hidden;
		line-height: 1;
		font-size: 20px;
		padding: 9px 10px 10px 10px;
	}
	#scrollUp:hover {
		background: rgba(0,0,0,0.5)
	}
		
</style>

<?php

}

add_action('wp_head', 'get_scroll_top_data_form_plugin');









?>