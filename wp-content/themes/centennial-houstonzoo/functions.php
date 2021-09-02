<?php
define( 'CSS_JS_VERSION', '1.10.2');
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
  wp_enqueue_script( 'headroom-js', 'https://unpkg.com/headroom.js@0.12.0/dist/headroom.min.js', array(), '', true );
  wp_enqueue_script( 'global', get_template_directory_uri() . '/assets/js/global.min.js', array(), CSS_JS_VERSION, true );
  wp_enqueue_script( 'pages', get_template_directory_uri() . '/assets/js/pages.min.js', array(), CSS_JS_VERSION, true );
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
        'text' => 'I accept and agree to the terms and conditions of the <span data-open="terms-reveal"><u>Houston Zoo Participant and Photo Release</u>.</span> ', 
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

  //var_dump($_FILES);

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
        'visit_since'       => rgar( $entry, '13' ),
        'visit_since_time'  => rgar( $entry, '23' ),
      )      
    )
  );

  // handle for repeater of files
  $inputCapt = array_values(array_filter($_POST['input_caption']));
  $inputYr = array_values(array_filter($_POST['input_year']));

  $wordpress_upload_dir = wp_upload_dir();
  // $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
  // $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file

  $uploaded_files = $_FILES['file_upload'];
  $number_of_files = count($uploaded_files['name']);
  $any_file_uploaded = FALSE;

  for ($idx = 0; $idx < $number_of_files; $idx++) {

    $filename = $_POST['file_name'][$idx];
    $uploaded_filename = $uploaded_files['name'][$idx];
    $uploaded_tmpname = $uploaded_files['tmp_name'][$idx];

    // this script can be used also to handle non-named file upload such as profile image, so handle accordingly
    if (is_null($_POST['file_name'])) {
      if (empty($uploaded_filename)) continue;
    } else {
      if (!$filename || empty($uploaded_filename)) continue;
    }

    $any_file_uploaded = TRUE;

    $new_file_path = $wordpress_upload_dir['path'] . '/' . $uploaded_filename;
    $new_file_mime = mime_content_type($uploaded_tmpname);

    if ($uploaded_files['error'][$idx]) {
      switch ($uploaded_files['error'][$idx]) {
        case UPLOAD_ERR_INI_SIZE:
          $file_size = wp_max_upload_size() / 1024 / 1024;
          $error_message = 'Maximum file size of '.$file_size.'MB is exceeded. Please try smaller file.';
          break;
        case UPLOAD_ERR_CANT_WRITE:
          $error_message = 'There is an issue writing your file to our system. Please contact us.';
          break;
        default:
          $error_message = 'There is an uploading issue. Please try again later.';
      }
      generate_error($error_message);
    }

    if ($uploaded_files['size'][$idx] > wp_max_upload_size()) generate_error('Maximum file size of '.wp_max_upload_size().'is exceeded.');

    if (!in_array($new_file_mime, get_allowed_mime_types())) generate_error('We do not allow you to upload this kind of file.');

    $i = 1; // number of tries when the file with the same name is already exists
    while (file_exists($new_file_path)) {
      $i++;
      $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $uploaded_filename;
    }

    // looks like everything is OK
    if (move_uploaded_file($uploaded_tmpname, $new_file_path)) {

      $upload_id = wp_insert_attachment(array(
        'guid'           => $new_file_path,
        'post_mime_type' => $new_file_mime,
        'post_title'     => preg_replace('/\.[^.]+$/', '', $uploaded_filename),
        'post_content'   => '',
        'post_status'    => 'inherit'
      ), $new_file_path);

      // wp_generate_attachment_metadata() won't work if you do not include this file
      require_once(ABSPATH . 'wp-admin/includes/image.php');

      // Generate and save the attachment metas into the database
      wp_update_attachment_metadata($upload_id, wp_generate_attachment_metadata($upload_id, $new_file_path));
      
      $row = array(
        'file'    => $upload_id,
        'year'    => $inputYr[$idx],
        'caption' => $inputCapt[$idx]
      );
      add_row('photos_n_video', $row, $post_id); 

    }
  }
      
  GFAPI::delete_entry( $entry['id'] );
}

add_filter( 'gform_next_button', 'centennial_houstonzoo_form_next_button', 10, 2 );
function centennial_houstonzoo_form_next_button( $button, $form ) {
  $button = str_replace('<input', '<button', $button);
  $button .= '<span class="icon-arrow-right">Continue</span></button>';
  return $button;
}

add_filter( 'gform_previous_button', 'centennial_houstonzoo_form_previous_button', 10, 2 );
function centennial_houstonzoo_form_previous_button( $button, $form ) {
  $button = str_replace('<input', '<button', $button);
  $button .= '<span class="icon-arrow-left">Back</span></button>';
  return $button;
}

function centennial_houstonzoo_custom_phone_format($phone_formats) {
  $phone_formats['hzo'] = array(
    'label' => 'HZO custom format',
    'mask' => '999.999.9999',
    'regex' => '/^(\d{3})\.(\d{3})\.(\d{4})$/',
    'instruction' => '###.###.####',
  );
  return $phone_formats;
}
add_filter( 'gform_phone_formats', 'centennial_houstonzoo_custom_phone_format');

add_filter( 'gform_counter_script_1', 'set_counter_script', 10, 5 );
function set_counter_script( $script, $form_id, $input_id, $max_length, $field ) {
  $script = "jQuery('#{$input_id}').textareaCount(" .
              "    {" .
              "    'maxCharacterSize': {$max_length}," .
              "    'originalStyle': 'ginput_counter'," .
              "    'displayFormat' : '#input " . esc_js( __( 'of', 'gravityforms' ) ) . ' #max ' . esc_js( __( 'characters', 'gravityforms' ) ) . "'" .
              "    });";
  return $script;
}

require_once(__DIR__.'/shortcodes.php');
