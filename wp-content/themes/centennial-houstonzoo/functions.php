<?php
define( 'CSS_JS_VERSION', 1.00);
define( 'TEMPLATE_PATH', get_bloginfo('stylesheet_directory'));
define( 'TEMPLATE_IMAGE_PATH', get_bloginfo('stylesheet_directory') . '/assets/img');

function pr($r) {
  echo '<pre>';
  print_r($r);
  echo '</pre>';
}

function pd($r) {
  echo '<pre>';
  print_r($r);
  echo '</pre>';
  die();
}

/**
 * Custom body classes.
 */
function centennial_houstonzoo_body_class($classes) {
  global $post;
  $post_slug = $post->post_name;
  if (is_front_page() == FALSE) {
    $classes[] = 'not-home';
  }
  $classes[] = sprintf('post-type-%s', $post->post_type);
  $classes[] = sprintf('page-%s', $post_slug);
  if (is_user_logged_in()) {
    $classes[] = 'logged-in';
  }
  $current_user = wp_get_current_user();
  if ($current_user && in_array('administrator', $current_user->roles)) {
    $classes[] = 'is-admin';
  }
  return $classes;
}
add_filter('body_class', 'centennial_houstonzoo_body_class');

// add css and javascript
function centennial_houstonzoo_css_js() {
  // wp_enqueue_script( 'flickity-js', 'https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', array(), '', true );
  wp_enqueue_script( 'flickity-js', 'https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', array());
  wp_enqueue_script( 'flickity-js-fade', 'https://unpkg.com/flickity-fade@1/flickity-fade.js', array());
  wp_enqueue_script( 'flickity-js-hash', 'https://unpkg.com/flickity-hash@1/hash.js', array());
  wp_enqueue_script( 'global', get_template_directory_uri() . '/assets/js/global.min.js', array(), CSS_JS_VERSION, true );
  wp_enqueue_script( 'pages', get_template_directory_uri() . '/assets/js/pages.min.js', array(), CSS_JS_VERSION, true );
  wp_enqueue_script( '100-years-page', get_template_directory_uri() . '/assets/js/page-100-years.min.js', array(), CSS_JS_VERSION, true );
  // css
  // wp_enqueue_style( 'flickity-css', 'https://unpkg.com/flickity@2/dist/flickity.min.css', array(), '', 'all' );
  wp_enqueue_style( 'flickity-css', 'https://unpkg.com/flickity@2/dist/flickity.min.css', array(), '', 'all' );
  wp_enqueue_style( 'app', get_template_directory_uri() . '/assets/css/app.css', array(), CSS_JS_VERSION, 'all' );
}
add_action('wp_enqueue_scripts', 'centennial_houstonzoo_css_js');

// disable emojis
function centennial_houstonzoo_disable_wp_emoji() {
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'centennial_houstonzoo_disable_emoji_tinymce' );
}

function centennial_houstonzoo_disable_emoji_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
add_action( 'init', 'centennial_houstonzoo_disable_wp_emoji' );

add_filter( 'emoji_svg_url', '__return_false' );

// add title tag
function centennial_houstonzoo_theme_support() {
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'centennial_houstonzoo_theme_support' );

add_theme_support('post-thumbnails');
// add_image_size( 'press_image', 610, 740, TRUE);
// add_image_size( 'person_image', 610, 480, TRUE);

add_theme_support( 'menus' );

// add acf global content page
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title'  => 'Global Content',
    'menu_title'  => 'Global Content',
  ));
}

function centennial_houstonzoo_zoo_connection() {
  return array(
    'member'    => 'Member', 
    'zoo_crew'  => 'Zoo Crew', 
    'volunteer' => 'Volunteer', 
    'staff'     => 'Staff',
    'zoo_guest' => 'Zoo Guest',
    'donor'     => 'Donor',
  );
}

add_filter( 'gform_pre_render_1', 'centennial_houstonzoo_zoo_connection_field' );
add_filter( 'gform_pre_validation_1', 'centennial_houstonzoo_zoo_connection_field' );
add_filter( 'gform_pre_submission_filter_1', 'centennial_houstonzoo_zoo_connection_field' );
add_filter( 'gform_admin_pre_render_1', 'centennial_houstonzoo_zoo_connection_field' );
function centennial_houstonzoo_zoo_connection_field( $form ) {

  foreach ($form['fields'] as &$field) {
		if ($field->inputName == 'zoo-connection-selection') {

      $zoo_connection = centennial_houstonzoo_zoo_connection();

			$choices = [];
			foreach ($zoo_connection as $key => $value) {
				$choices[] = ['text' => $value, 'value' => $key];
			}

			$field->choices = $choices;
    } elseif ($field->inputName == 'terms-and-condition') {
			$choices = [];

      $choices[] = [
        'text' => 'I accept and agree to the terms and conditions of the <a href="/">Houston Zoo Participant and Photo Release.</a> ', 
        'value' => 'yes'
      ];
			
      $field->choices = $choices;
    }
	}
	return $form;
}

function centennial_houstonzoo_acf_connection_choices( $field ) {
  $field['choices'] = array();
  $choices = centennial_houstonzoo_zoo_connection();
  if( is_array($choices) ) {
      foreach( $choices as $value => $label ) {
          $field['choices'][$value] = $label;
      }
  }
  return $field;
}
add_filter('acf/load_field/name=zoo_connection', 'centennial_houstonzoo_acf_connection_choices');


function centennial_houstonzoo_create_posttype() {
  register_post_type( 'your_story',
    array(
      'labels'        => array(
        'name'          => __( 'Your Stories' ),
        'singular_name' => __( 'Your Story' )
      ),
      'public'        => true,
      'has_archive'   => true,
      'rewrite'       => array('slug' => 'your_story'),
      'show_in_rest'  => true,
      'supports'      => array('story'),
      'menu_icon'     => 'dashicons-text',
    )
  );
}
add_action( 'init', 'centennial_houstonzoo_create_posttype' );

function centennial_houstonzoo_upload_file($file_url) {   
  $upload_dir = wp_upload_dir();    
  $file_data  = file_get_contents( $file_url );    
  $filename   = basename( $file_url );    
  
  if ( wp_mkdir_p( $upload_dir['path'] ) ) {
    $file = $upload_dir['path'] . '/' . $filename;
  } else {
    $file = $upload_dir['basedir'] . '/' . $filename;
  }    

  file_put_contents( $file, $file_data );
  $wp_filetype = wp_check_filetype( $filename, null );
  
  $attachment = array(
    'post_mime_type' => $wp_filetype['type'],
    'post_title' => sanitize_file_name( $filename ),
    'post_content' => '',
    'post_status' => 'inherit'
  );
  
  $attach_id = wp_insert_attachment( $attachment, $file );
  
  require_once( ABSPATH . 'wp-admin/includes/image.php' );

  $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
  wp_update_attachment_metadata( $attach_id, $attach_data );

  return $attach_id;
}

add_action( 'gform_after_submission_1', 'centennial_houstonzoo_set_post_content', 10, 2 );
function centennial_houstonzoo_set_post_content( $entry, $form ) { 
  $field_zoo_conn_id    = 5;
  $field_zoo_conn       = GFFormsModel::get_field( $form, $field_zoo_conn_id );
  $field_zoo_conn_value = is_object( $field_zoo_conn ) ? $field_zoo_conn->get_value_export( $entry, $field_zoo_conn_id, true ) : '';
  $arr_field_zoo_conn = explode(',', $field_zoo_conn_value);
  $arr_field_zoo_conn = array_map('trim', $arr_field_zoo_conn);

  $arr_result = [];
  foreach ($field_zoo_conn->choices as $item) {
    foreach ($arr_field_zoo_conn as $selected) {
      if ($selected == $item['text']) {
        $arr_result[] = $item['value'];
        continue;
      }
    }
  }


  $post_id = wp_insert_post(
    array (
      'post_type' => 'your_story',
      'post_title' => rgar( $entry, '16' ), 
      'post_status' => 'publish',
      'comment_status' => 'closed',   
      'ping_status' => 'closed',
      'meta_input' => array(
        'name'            => rgar( $entry, '16' ),
        'email'           => rgar( $entry, '3' ),
        'phone'           => rgar( $entry, '4' ),
        'zoo_connection'  => $arr_result,
        'zoo_memory'      => rgar( $entry, '6' ),
        'visit_since'       => '111',
        'visit_since_time'  => 'month'
      )      
    )
  );

  $row = array(
    'file'    => $attach_id,
    'year'    => rgar( $entry, '5' ),
    'caption' => rgar( $entry, '6' )
  );
  add_row('documents', $row, $post_id); 
  
  /*
  var_dump( $arr_field_zoo_conn ); 
  if ($post_id) {
    // insert post meta
    add_post_meta($post_id, '_your_custom_1', $custom1);
    add_post_meta($post_id, '_your_custom_2', $custom2);
    add_post_meta($post_id, '_your_custom_3', $custom3);
  }

  $row = array(
    'folder'      => rgar( $entry, '7' ),
    'file'        => $attach_id,
    'title'       => rgar( $entry, '5' ),
    'description' => rgar( $entry, '6' ),
    'upload_date' => $now
  );
  add_row('documents', $row);  
*/
    
  GFAPI::delete_entry( $entry['id'] );
}



require_once(__DIR__.'/shortcodes.php');
