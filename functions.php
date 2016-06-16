<?php
/**
 * naked functions and definitions
 *
 * @package naked
 */

/**
  * Add extra form info for users
  */
function thshpr_show_extra_profile_fields( $user )
{
	?>
	<h3>Theme Special Information</h3>
	<table class="form-table">
		<tr>
			<th><label for="extrainfo">Extra Info</label></th>
			<td>
				<input type="text" name="extrainfo" id="extrainfo" value="<?php echo esc_attr( get_the_author_meta( 'extrainfo', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter extra info (this goes below the user name).</span>
			</td>
		</tr>
		<tr>
			<th><label for="twitter">Twitter URL</label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Twitter URL (enter entire URL).</span>
			</td>
		</tr>
		<tr>
			<th><label for="facebook">Facebook</label></th>
			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Facebook URL (enter entire URL).</span>
			</td>
		</tr>
		<tr>
			<th><label for="googleplus">Google Plus</label></th>
			<td>
				<input type="text" name="googleplus" id="googleplus" value="<?php echo esc_attr( get_the_author_meta( 'googleplus', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Google Plus URL (enter entire URL).</span>
			</td>
		</tr>
		<tr>
			<th><label for="linkedin">Linked In</label></th>
			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Linked In URL (enter entire URL).</span>
			</td>
		</tr>
		<tr>
			<th><label for="pinterest">Pinterest</label></th>
			<td>
				<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Pinterest URL (enter entire URL).</span>
			</td>
		</tr>

	</table>
	<?php
}
add_action( 'show_user_profile', 'thshpr_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'thshpr_show_extra_profile_fields' );

/**
  * Save extra form info for users
  */
function thshpr_save_extra_profile_fields( $user_id )
{
	if ( !current_user_can( 'edit_user', $user_id ) )
	return false;
	update_usermeta( $user_id, 'twitter', $_POST['twitter'] );
	update_usermeta( $user_id, 'facebook', $_POST['facebook'] );
	update_usermeta( $user_id, 'googleplus', $_POST['googleplus'] );
	update_usermeta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_usermeta( $user_id, 'pinterest', $_POST['pinterest'] );
	update_usermeta( $user_id, 'extrainfo', $_POST['extrainfo'] );

}
add_action( 'personal_options_update', 'thshpr_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'thshpr_save_extra_profile_fields' );

/**
  * Add placeholders to WordPress comment info fields
  */
function thshpr_update_fields($fields)
{
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');

	$fields['author'] =
	'<p class="comment-form-author">
	<input required minlength="3" maxlength="30" placeholder="' . __("Name*", "thshpr") . '" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
	'" size="30"' . $aria_req . ' />
	</p>';

	$fields['email'] =
	'<p class="comment-form-email">
	<input required placeholder="' . __("Email*", "thshpr") . '" id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) .
	'" size="30"' . $aria_req . ' />
	</p>';

	$fields['url'] =
	'<p class="comment-form-url">
	<input placeholder="' . __("Website", "thshpr") . '" id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) .
	'" size="30" />
	</p>';

	return $fields;
}
add_filter('comment_form_default_fields', 'thshpr_update_fields');

/**
  * Add placeholders to WordPress comment field
  */
function thshpr_comment_field($comment_field)
{
	$comment_field =
	'<p class="comment-form-comment">
	<textarea required placeholder="Enter Your Comment…" id="comment" name="comment" aria-required="true"></textarea>
	</p>';

	return $comment_field;
}
add_filter('comment_form_field_comment', 'thshpr_comment_field');

/**
  * Generates and outputs google fonts string
  */
function thshpr_load_fonts()
{
	$include_from_google = array();
	$google_fonts = fw_get_google_fonts();

	$h1 = fw_get_db_customizer_option('opt_h1');
	$h2 = fw_get_db_customizer_option('opt_h2');
	$h3 = fw_get_db_customizer_option('opt_h3');
	$h4 = fw_get_db_customizer_option('opt_h4');
	$h5 = fw_get_db_customizer_option('opt_h5');
	$h6 = fw_get_db_customizer_option('opt_h6');
	$body = fw_get_db_customizer_option('opt_body');
	$categories_tags = fw_get_db_customizer_option('opt_category_tag');
	$large_description = fw_get_db_customizer_option('opt_large_description');
	$other_meta = fw_get_db_customizer_option('opt_other_meta');

	/* gets google fonts and adds to the array */
	if( isset($google_fonts[$h1['family']]) ){
		$include_from_google[$h1['family']] = $google_fonts[$h1['family']];
	}
	if( isset($google_fonts[$h2['family']]) ){
		$include_from_google[$h2['family']] = $google_fonts[$h2['family']];
	}
	if( isset($google_fonts[$h3['family']]) ){
		$include_from_google[$h3['family']] = $google_fonts[$h3['family']];
	}
	if( isset($google_fonts[$h4['family']]) ){
		$include_from_google[$h4['family']] = $google_fonts[$h4['family']];
	}
	if( isset($google_fonts[$h5['family']]) ){
		$include_from_google[$h5['family']] = $google_fonts[$h5['family']];
	}
	if( isset($google_fonts[$h6['family']]) ){
		$include_from_google[$h6['family']] = $google_fonts[$h6['family']];
	}
	if( isset($google_fonts[$body['family']]) ){
		$include_from_google[$body['family']] = $google_fonts[$body['family']];
	}
	if( isset($google_fonts[$categories_tags['family']]) ){
		$include_from_google[$categories_tags['family']] = $google_fonts[$categories_tags['family']];
	}
	if( isset($google_fonts[$large_description['family']]) ){
		$include_from_google[$large_description['family']] = $google_fonts[$large_description['family']];
	}
	if( isset($google_fonts[$other_meta['family']]) ){
		$include_from_google[$other_meta['family']] = $google_fonts[$other_meta['family']];
	}
	if ( ! sizeof( $include_from_google ) ) {
		return '';
	}

	$font_string='http://fonts.googleapis.com/css?family=';
	foreach ( $include_from_google as $font => $styles )
	{
		$font_string .= str_replace( ' ', '+', $font ) . ':' . implode( ',', $styles['variants'] ) . '|';
	}

	$font_string = substr( $font_string, 0, - 1 );
	wp_register_style('thshpr-google-fonts',  esc_url( $font_string ));
	wp_enqueue_style( 'thshpr-google-fonts');
}

if (defined('FW'))
{
	add_action('wp_print_styles', 'thshpr_load_fonts');
}

/**
  * Separates Google fonts font-style and font-weight
  */
function thshpr_google_font_style_weight_split($field) {

    $output = '';

    if ( isset($field) ) {

        $pattern = '/(\d+)|(regular|italic)/i';

        preg_match_all($pattern, $field, $matches);

        foreach ($matches[0] as $value) {
            if ( $value == 'italic' ) {
                $output .= 'font-style:' . $value . ';';
            } else if ( $value == 'regular' ) {
                $output .= 'font-style:normal;';
            } else {
                $output .= 'font-weight:' . $value . ';';
            }
        }

    }

    if ( isset($field['family']) ) {
        $output .= 'font-family:' . $field['family'] . ';';
    }

    return $output;

}

/**
  * Generates and outputs google fonts string, enqueues styles
  */
function thshpr_print_styles()
{
	// load theme styles
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/static/css/normalize.css','', '', 'all');
	wp_enqueue_style( 'naked-style', get_stylesheet_uri(), array('normalize'), '', 'all');
	if (!defined('FW')) return;
	$h1 = fw_get_db_customizer_option('opt_h1');
	$h2 = fw_get_db_customizer_option('opt_h2');
	$h3 = fw_get_db_customizer_option('opt_h3');
	$h4 = fw_get_db_customizer_option('opt_h4');
	$h5 = fw_get_db_customizer_option('opt_h5');
	$h6 = fw_get_db_customizer_option('opt_h6');
	$body = fw_get_db_customizer_option('opt_body');
	$categories_tags = fw_get_db_customizer_option('opt_category_tag');
	$categories_tags_font_hover_color = fw_get_db_customizer_option('opt_category_tag_font_color_hover');
	$categories_tags_background = fw_get_db_customizer_option('opt_category_tag_background');
	$categories_tags_background_hover = fw_get_db_customizer_option('opt_category_tag_background_hover');
	$large_description = fw_get_db_customizer_option('opt_large_description');
	$small_description = fw_get_db_customizer_option('opt_small_description');
	$other_meta = fw_get_db_customizer_option('opt_other_meta');
	$other_meta_hover = fw_get_db_customizer_option('opt_other_meta_hover');

	$option_styles =
	'h1{ font-family:'.esc_html($h1['family']).';'. thshpr_google_font_style_weight_split($h1['variation']) . 'font-size:'.esc_html($h1['size']).'px;'. 'color:'.esc_html($h1['color']).';'. 'letter-spacing:'.esc_html($h1['letter-spacing']).'px;'. 'line-height:'.esc_html($h1['line-height']).'px; }'
	.'h2{ font-family:'.esc_html($h2['family']).';'. thshpr_google_font_style_weight_split($h2['variation']) . 'font-size:'.esc_html($h2['size']).'px;'. 'color:'.esc_html($h2['color']).';'. 'letter-spacing:'.esc_html($h2['letter-spacing']).'px;'. 'line-height:'.esc_html($h2['line-height']).'px; }'
	.'h3, .component-element h3{ font-family:'.esc_html($h3['family']).';'. thshpr_google_font_style_weight_split($h3['variation']) . 'font-size:'.esc_html($h3['size']).'px;'. 'color:'.esc_html($h3['color']).';'. 'letter-spacing:'.esc_html($h3['letter-spacing']).'px;'. 'line-height:'.esc_html($h3['line-height']).'px; }'
	.'h4, .component-element h4{ font-family:'.esc_html($h4['family']).';'. thshpr_google_font_style_weight_split($h4['variation']) . 'font-size:'.esc_html($h4['size']).'px;'. 'color:'.esc_html($h4['color']).';'. 'letter-spacing:'.esc_html($h4['letter-spacing']).'px;'. 'line-height:'.esc_html($h4['line-height']).'px; }'
	.'h5{ font-family:'.esc_html($h5['family']).';'. thshpr_google_font_style_weight_split($h5['variation']) . 'font-size:'.esc_html($h5['size']).'px;'. 'color:'.esc_html($h5['color']).';'. 'letter-spacing:'.esc_html($h5['letter-spacing']).'px;'. 'line-height:'.esc_html($h5['line-height']).'px; }'
	.'h6{ font-family:'.esc_html($h6['family']).';'. thshpr_google_font_style_weight_split($h6['variation']) . 'font-size:'.esc_html($h6['size']).'px;'. 'color:'.esc_html($h6['color']).';'. 'letter-spacing:'.esc_html($h6['letter-spacing']).'px;'. 'line-height:'.esc_html($h6['line-height']).'px; }'
	.'body,input,textarea{ font-family:'.esc_html($body['family']).';'. thshpr_google_font_style_weight_split($body['variation']) . 'font-size:'.esc_html($body['size']).'px;'. 'color:'.esc_html($body['color']).';'. 'letter-spacing:'.esc_html($body['letter-spacing']).'px;'. 'line-height:'.esc_html($body['line-height']).'px; }'
	.'.tags a{ font-family:'.esc_html($categories_tags['family']).';'. thshpr_google_font_style_weight_split($categories_tags['variation']) . 'font-size:'.esc_html($categories_tags['size']).'px;'. 'color:'.esc_html($categories_tags['color']).';'. 'letter-spacing:'.esc_html($categories_tags['letter-spacing']).'px;'. 'line-height:'.esc_html($categories_tags['line-height']).'px; }'
	.'.tags a{ background-color:'.esc_html($categories_tags_background).';}'
	.'.tags a:hover{ background-color:'.esc_html($categories_tags_font_hover_color).';}'
	.'.tags a:hover{ background-color:'.esc_html($categories_tags_background_hover).';}'
	.'.meta-excerpt, .meta-excerpt a{ font-family:'.esc_html($small_description['family']).';'. thshpr_google_font_style_weight_split($small_description['variation']) . 'font-size:'.esc_html($small_description['size']).'px;'. 'color:'.esc_html($small_description['color']).';'. 'letter-spacing:'.esc_html($small_description['letter-spacing']).'px;'. 'line-height:'.esc_html($small_description['line-height']).'px; }'
	.'.focus .meta-excerpt,.focus .meta-excerpt a{ font-family:'.esc_html($large_description['family']).';'. thshpr_google_font_style_weight_split($large_description['variation']) . 'font-size:'.esc_html($large_description['size']).'px;'. 'color:'.esc_html($large_description['color']).';'. 'letter-spacing:'.esc_html($large_description['letter-spacing']).'px;'. 'line-height:'.esc_html($large_description['line-height']).'px; }'
	.'.general-meta, .general-meta a{ font-family:'.esc_html($other_meta['family']).';'. thshpr_google_font_style_weight_split($other_meta['variation']) . 'font-size:'.esc_html($other_meta['size']).'px;'. 'color:'.esc_html($other_meta['color']).';'. 'letter-spacing:'.esc_html($other_meta['letter-spacing']).'px;'. 'line-height:'.esc_html($other_meta['line-height']).'px; }'
	.'.general-meta a:hover{ font-family:'.esc_html($other_meta_hover).';'. thshpr_google_font_style_weight_split($other_meta_hover) . 'font-size:'.esc_html($other_meta_hover).'px;'. 'color:'.esc_html($other_meta_hover).';'. 'letter-spacing:'.esc_html($other_meta_hover).'px;'. 'line-height:'.esc_html($other_meta_hover).'px; }';
	//remove_theme_mod('fw_options');

	wp_enqueue_style(
		'option-styles',
		get_template_directory_uri() . 'style.css'
	);
	wp_add_inline_style( 'option-styles', esc_html($option_styles) );
}
add_action('wp_enqueue_scripts', 'thshpr_print_styles');









/**
  * Generates hover string from the passed option array
  * @requires $opt_image_hover_item - multidimensional array containing user choice for hover
  */
function thshpr_get_image_hover_string($opt_image_hover_item)
{
	$hover_string='';
	if($opt_image_hover_item['template']=="1")//text
	{
		$hover_string=$opt_image_hover_item[1]['opt_image_hover_item_text'];
	}
	else if($opt_image_hover_item['template']=="2")//icon
	{
		$hover_string='<i class="'.$opt_image_hover_item[2]['opt_image_hover_item_icon'].'" data-value="'.$opt_image_hover_item['2']['opt_image_hover_item_icon'].'"></i>';
	}
	else if($opt_image_hover_item['template']=="3")//image
	{
		$hover_string='<img src="'.$opt_image_hover_item[3]['opt_image_hover_item_image']['url'].'">';
	}
	return $hover_string;
}

/**
 * Converts array of category id's into a comma delimited variable. Used when outputting category meta
 * @requires $post_categories - array containing category id's
 */
function thshpr_get_category_ids_string($post_categories)
{
	$strcats="";
	if(count($post_categories)>1)
	{
		foreach($post_categories as $value)
		{
			$strcats.=$value.",";
		}
	}
	else if(count($post_categories)==1)
	{
		$strcats=$post_categories[0];
	}
	else
	{
		$strcats=1;
	}
	return $strcats;
}

/**
 * Strips an excerpt to a desired length
 * @requires $limit - number of words maximum for the excerpt
 */
function thshpr_stripped_excerpt($limit)
{
	$excerpt = get_the_excerpt();
	$excerpt = strip_tags($excerpt);
	$excerpt = explode(' ', $excerpt, $limit);

	 if (count($excerpt)>=$limit) {
	 array_pop($excerpt);
	 $excerpt = implode(" ",$excerpt).'...';
	 } else {
	 $excerpt = implode(" ",$excerpt);
	 }
	 $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	 return $excerpt;
}

/**
 * Generates height given a width and aspect ratio
 * @requires $ratio,$width
 */
function thshpr_generate_aspect_height($ratio,$width)
{
	$height=round($ratio*$width);
	return $height;
}

/**
 * Generates an image given width, height and image id. If image already exists a new one won't be created
 * at those dimensions.
 * @requires $width,$height,$id
 */
function thshpr_generate_image($width,$height,$id)
{
	// Get upload directory info
	$upload_info = wp_upload_dir();
	$upload_dir  = $upload_info['basedir'];
	$upload_url  = $upload_info['baseurl'];

	// Get file path info
	$attachment_id = get_post_thumbnail_id($id);
	$path = get_attached_file( $attachment_id );
	$path_info = pathinfo( $path );
	$ext = $path_info['extension'];
	$rel_path  = str_replace( array( $upload_dir, ".$ext" ), '', $path );

	//large image
	$suffix    = "{$width}x{$height}";
	$dest_path = "{$upload_dir}{$rel_path}-{$suffix}.{$ext}";
	$image_url  = "{$upload_url}{$rel_path}-{$suffix}.{$ext}";

	if ( !file_exists( $dest_path ) )
	{
		// Generate thumbnail
		image_make_intermediate_size( $path, $width, $height, true );
	}

	$item_string='<img src="'.$image_url.'" width="'.$width.'" height="'.$height.'">';
	return($item_string);
}


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 880; /* pixels */




if ( ! function_exists( 'naked_setup' ) ) :
/**
 * Set up theme defaults and register support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function naked_setup() {
    global $cap, $content_width;

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();
    if ( function_exists( 'add_theme_support' ) )
    {
    	    /**
	 * Add default posts and comments RSS feed links to head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable support for Title Tag
	*/
	add_theme_support( "title-tag" );

	/**
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery','status',
	) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'naked_get_featured_posts',
		'max_posts' => 6,
	) );

	/**
	 * Setup the WordPress core custom background feature.
	*/
	add_theme_support( 'custom-background', apply_filters( 'naked_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    }

    /**
    * Set up image sizes
    */


  add_theme_support( 'post-thumbnails' );






    //featured thumbnail


    add_image_size( 'prevnext', 100, 100, true );
    /**
    * Make theme available for translation
    * Translations can be filed in the /languages/ directory
    * If you're building a theme based on naked, use a find and replace
    * to change 'naked' to the name of your theme in all the template files
    */
    load_theme_textdomain( 'naked', get_template_directory() . '/languages' );

    /**
    * This theme uses wp_nav_menu() in one location.
    */
    register_nav_menus( array(
        'primary'  => __( 'Header bottom menu', 'naked' ),
    ) );



}
endif; // naked_setup
add_action( 'after_setup_theme', 'naked_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function naked_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'naked' ),
		'id'            => 'right-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'naked' ),
		'id'            => 'left-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Above Content', 'naked' ),
		'id'            => 'above-content-sidebar',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => __( 'Below Content Sidebar', 'naked' ),
		'id'            => 'below-content-sidebar',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

	//register sidebar widgets if they have been activated from the options.

	if(function_exists( 'fw_get_db_settings_option' )) //check for options framework
	{
		//homepage
		$widget_components=fw_get_db_settings_option('opt_header_rows_frontpage');
		generate_user_widgets($widget_components);

	}
	else
	{
		//$sidebars=array("Single(1st)","1/2s","Single(2nd)");
	}

}

/**
 * Enqueue scripts
 */
function thshpr_scripts() {


	wp_enqueue_script( 'naked-fittext-js', get_template_directory_uri() . '/static/js/jquery.fittext.js', array('jquery'),'',true );

	// load theme js

	wp_enqueue_script( 'naked-ssm-breakpoints', get_template_directory_uri() . '/static/js/ssm.js', array('jquery'),'',true );
	wp_enqueue_script( 'naked-matchheights', get_template_directory_uri() . '/static/js/jquery.matchHeight-min.js', array('jquery'),'',true );
	wp_register_script( 'thshpr-stellar', get_template_directory_uri() . '/static/js/jquery.stellar.min.js', array('jquery'),'',true );
	wp_register_script( 'thshpr-stellar-init', get_template_directory_uri() . '/static/js/stellar-init.js', array('jquery','thshpr-stellar'),'',true );
	wp_register_script( 'thshpr-article-progress', get_template_directory_uri() . '/static/js/article-progress.js', array('jquery'),'',true );
	wp_enqueue_script( 'thshpr-comment-columns', get_template_directory_uri() . '/static/js/comment-columns.js', array('jquery'),'',true );
	//wp_enqueue_script( 'naked-theme-js', get_template_directory_uri() . '/static/js/theme.js', array('jquery','naked-fittext-js','naked-ssm-breakpoints','naked-matchheights'),'',true );
	//wp_enqueue_script( 'naked-skip-link-focus-fix', get_template_directory_uri() . '/static/js/skip-link-focus-fix.js', array(), '20130115', true );
	if (is_singular())
	{
		wp_enqueue_script('thshpr-stellar');
		wp_enqueue_script('thshpr-stellar-init');
		wp_enqueue_script('thshpr-article-progress');
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'naked-keyboard-image-navigation', get_template_directory_uri() . '/static/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'thshpr_scripts');



/**
 * Implement the Custom Header feature.
 */
/*require get_template_directory() . '/static/custom-header.php';*/

/**
 * Custom template tags for this theme.
 */
/*require get_template_directory() . '/static/template-tags.php';*/

/**
 * Custom functions that act independently of the theme templates.
 */
/*require get_template_directory() . '/static/extras.php';*/

/**
 * Customizer additions.
 */
/*require get_template_directory() . '/static/customizer.php';*/

/**
 * Load Jetpack compatibility file.
 */
/*require get_template_directory() . '/static/jetpack.php';*/

/**
 * Load modified nav walker for bootstrap
 */
/*require get_template_directory() . '/static/bootstrap-wp-navwalker.php';*/

/**
 * Load social icons
 */
//require get_template_directory() . '/static/widgets/social-icons.php';

/**
 * Load featured posts widgets
 */
//require get_template_directory() . '/static/widgets/featured-posts.php';

/**
 * Load popular posts widgets
 */
//require get_template_directory() . '/static/widgets/popular-posts.php';

/**
 * Load related posts widgets
 */
//require get_template_directory() . '/static/widgets/related-posts.php';

/**
 * Load recent posts widgets
 */
//require get_template_directory() . '/static/widgets/recent-posts.php';

/**
 * Load fullscreen search widget
 */
//require get_template_directory() . '/static/widgets/fullscreen-search.php';

/**
 * Load twitter widget
 */
//require get_template_directory() . '/static/widgets/twitter.php';

/**
 * Load ad 125
 */
//require get_template_directory() . '/static/widgets/ad-multiline.php';
