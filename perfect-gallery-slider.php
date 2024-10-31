<?php
/*
Plugin Name: Perfect Gallery Slider
Plugin URL: http://beautiful-module.com/demo/perfect-gallery-slider-2/
Description: A simple Responsive Perfect Gallery Slider
Version: 1.0
Author: module.express
Author URI: http://beautiful-module.com
Contributors: module.express
*/
/*
 * Register CPT sp_responsivegallery
 *
 */
if(!class_exists('Perfect_Gallery_Slider')) {
	class Perfect_Gallery_Slider {

		function __construct() {
		    if(!function_exists('add_shortcode')) {
		            return;
		    }		    

			add_action ( 'init' , array( $this , 'pgs_responsive_gallery_setup_post_types' ));

			/* Include style and script */
			add_action ( 'wp_enqueue_scripts' , array( $this , 'pgs_register_css_script' ));
			/* Register Taxonomy */
			add_action ( 'init' , array( $this , 'pgs_responsive_gallery_taxonomies' ));
			add_action ( 'add_meta_boxes' , array( $this , 'pgs_rsris_add_meta_box' ));
			add_action ( 'save_post' , array( $this , 'pgs_rsris_save_meta_box_data' ));
			register_activation_hook( __FILE__, 'pgs_responsive_gallery_rewrite_flush' );


			// Manage Category Shortcode Columns
			add_filter ( 'manage_responsive_slider-category_custom_column' , array( $this , 'pgs_responsive_gallery_category_columns' ), 10, 3);
			add_filter ( 'manage_edit-responsive_slider-category_columns' , array( $this , 'pgs_responsive_gallery_category_manage_columns' ));
			require_once( 'pgs_gallery_admin_settings_center.php' );
			add_shortcode ( 'sp_responsivegallery' , array( $this , 'pgs_gallery_shortcode' ));
		}

		function pgs_responsive_gallery_setup_post_types() {

			$responsive_gallery_labels =  apply_filters( 'sp_responsivegallery_labels', array(
				'name'                => 'Responsive header image gallery',
				'singular_name'       => 'Responsive header image gallery',
				'add_new'             => __('Add New', 'sp_responsivegallery'),
				'add_new_item'        => __('Add New Image', 'sp_responsivegallery'),
				'edit_item'           => __('Edit Image', 'sp_responsivegallery'),
				'new_item'            => __('New Image', 'sp_responsivegallery'),
				'all_items'           => __('All Images', 'sp_responsivegallery'),
				'view_item'           => __('View Image', 'sp_responsivegallery'),
				'search_items'        => __('Search Image', 'sp_responsivegallery'),
				'not_found'           => __('No Image found', 'sp_responsivegallery'),
				'not_found_in_trash'  => __('No Image found in Trash', 'sp_responsivegallery'),
				'parent_item_colon'   => '',
				'menu_name'           => __('Perfect gallery slider', 'sp_responsivegallery'),
				'exclude_from_search' => true
			) );


			$responsiveslider_args = array(
				'labels' 			=> $responsive_gallery_labels,
				'public' 			=> true,
				'publicly_queryable'		=> true,
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'query_var' 		=> true,
				'capability_type' 	=> 'post',
				'has_archive' 		=> true,
				'hierarchical' 		=> false,
				'menu_icon'   => 'dashicons-format-gallery',
				'supports' => array('title','editor','thumbnail')
				
			);
			register_post_type( 'sp_responsivegallery', apply_filters( 'sp_faq_post_type_args', $responsiveslider_args ) );

		}
		
		function pgs_register_css_script() {
		    wp_enqueue_style( 'css_responsiveimgslider',  plugin_dir_url( __FILE__ ). 'css/responsiveimgslider.css' );
		    wp_enqueue_script( 'js_slides.min', plugin_dir_url( __FILE__ ) . 'js/slides.min.js', array( 'jquery' ));
			/*   REGISTER ALL CSS FOR SITE */
			wp_enqueue_style( 'css_unite-gallery',  plugin_dir_url( __FILE__ ). 'css/unite-gallery.css' );
			wp_enqueue_style( 'css_ug-theme-default',  plugin_dir_url( __FILE__ ). 'themes/default/ug-theme-default.css' );
			
			/*   REGISTER ALL JS FOR SITE */
			wp_enqueue_script( 'js_ug-common-libraries', plugin_dir_url( __FILE__ ) . 'js/ug-common-libraries.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-functions', plugin_dir_url( __FILE__ ) . 'js/ug-functions.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-thumbsgeneral', plugin_dir_url( __FILE__ ) . 'js/ug-thumbsgeneral.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-thumbsstrip', plugin_dir_url( __FILE__ ) . 'js/ug-thumbsstrip.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-touchthumbs', plugin_dir_url( __FILE__ ) . 'js/ug-touchthumbs.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-panelsbase', plugin_dir_url( __FILE__ ) . 'js/ug-panelsbase.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-strippanel', plugin_dir_url( __FILE__ ) . 'js/ug-strippanel.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-gridpanel', plugin_dir_url( __FILE__ ) . 'js/ug-gridpanel.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-thumbsgrid', plugin_dir_url( __FILE__ ) . 'js/ug-thumbsgrid.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-tiles', plugin_dir_url( __FILE__ ) . 'js/ug-tiles.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-tiledesign', plugin_dir_url( __FILE__ ) . 'js/ug-tiledesign.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-avia', plugin_dir_url( __FILE__ ) . 'js/ug-avia.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-slider', plugin_dir_url( __FILE__ ) . 'js/ug-slider.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-sliderassets', plugin_dir_url( __FILE__ ) . 'js/ug-sliderassets.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-touchslider', plugin_dir_url( __FILE__ ) . 'js/ug-touchslider.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-zoomslider', plugin_dir_url( __FILE__ ) . 'js/ug-zoomslider.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-video', plugin_dir_url( __FILE__ ) . 'js/ug-video.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-gallery', plugin_dir_url( __FILE__ ) . 'js/ug-gallery.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-lightbox', plugin_dir_url( __FILE__ ) . 'js/ug-lightbox.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-carousel', plugin_dir_url( __FILE__ ) . 'js/ug-carousel.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-api', plugin_dir_url( __FILE__ ) . 'js/ug-api.js', array( 'jquery' ));
			wp_enqueue_script( 'js_ug-theme-default', plugin_dir_url( __FILE__ ) . 'themes/default/ug-theme-default.js', array( 'jquery' ));
		}
		
		function pgs_responsive_gallery_taxonomies() {
		    $labels = array(
		        'name'              => _x( 'Category', 'taxonomy general name' ),
		        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
		        'search_items'      => __( 'Search Category' ),
		        'all_items'         => __( 'All Category' ),
		        'parent_item'       => __( 'Parent Category' ),
		        'parent_item_colon' => __( 'Parent Category:' ),
		        'edit_item'         => __( 'Edit Category' ),
		        'update_item'       => __( 'Update Category' ),
		        'add_new_item'      => __( 'Add New Gallery Category' ),
		        'new_item_name'     => __( 'New Category Name' ),
		        'menu_name'         => __( 'Gallery Category' ),
		    );

		    $args = array(
		        'hierarchical'      => true,
		        'labels'            => $labels,
		        'show_ui'           => true,
		        'show_admin_column' => true,
		        'query_var'         => true,
		        'rewrite'           => array( 'slug' => 'responsive_slider-category' ),
		    );

		    register_taxonomy( 'responsive_slider-category', array( 'sp_responsivegallery' ), $args );
		}

		function pgs_responsive_gallery_rewrite_flush() {  
				pgs_responsive_gallery_setup_post_types();
		    flush_rewrite_rules();
		}
		
		function pgs_responsive_gallery_category_manage_columns($theme_columns) {
		    $new_columns = array(
		            'cb' => '<input type="checkbox" />',
		            'name' => __('Name'),
		            'slider_shortcode' => __( 'Gallery Category Shortcode', 'slick_slider' ),
		            'slug' => __('Slug'),
		            'posts' => __('Posts')
					);

		    return $new_columns;
		}

		function pgs_responsive_gallery_category_columns($out, $column_name, $theme_id) {
		    $theme = get_term($theme_id, 'responsive_slider-category');
		    switch ($column_name) {      
		        case 'title':
		            echo get_the_title();
		        break;
		        case 'slider_shortcode':
					echo '[sp_responsivegallery cat_id="' . $theme_id. '"]';			  	  

		        break;
		        default:
		            break;
		    }
		    return $out;   

		}

		/* Custom meta box for slider link */
		function pgs_rsris_add_meta_box() {
				add_meta_box('custom-metabox',__( 'LINK URL', 'link_textdomain' ),array( $this , 'pgs_rsris_box_callback' ),'sp_responsivegallery');			
		}
		
		function pgs_rsris_box_callback( $post ) {
			wp_nonce_field( 'pgs_rsris_save_meta_box_data', 'rsris_meta_box_nonce' );
			$value = get_post_meta( $post->ID, 'rsris_slide_link', true );
			echo '<input type="url" id="rsris_slide_link" name="rsris_slide_link" value="' . esc_attr( $value ) . '" size="25" /><br />';
			echo 'ie http://www.google.com';
		}
		function pgs_rsris_save_meta_box_data( $post_id ) {
			if ( ! isset( $_POST['rsris_meta_box_nonce'] ) ) {
				return;
			}
			if ( ! wp_verify_nonce( $_POST['rsris_meta_box_nonce'], 'pgs_rsris_save_meta_box_data' ) ) {
				return;
			}
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			if ( isset( $_POST['post_type'] ) && 'sp_responsivegallery' == $_POST['post_type'] ) {

				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return;
				}
			} else {

				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				}
			}
			if ( ! isset( $_POST['rsris_slide_link'] ) ) {
				return;
			}
			$link_data = sanitize_text_field( $_POST['rsris_slide_link'] );
			update_post_meta( $post_id, 'rsris_slide_link', $link_data );
		}
		
		/*
		 * Add [sp_responsivegallery] shortcode
		 *
		 */
		function pgs_gallery_shortcode( $atts, $content = null ) {
			
			extract(shortcode_atts(array(
				"limit"  => '',
				"cat_id" => '',
				"design" => '',
				"slider_transition" => '',
				"slider_transition_speed" => '',
				"gallery_autoplay" => '',
				"gallery_play_interval" => '',
				"gallery_height" => '',
				"gallery_width" => '',
				"enable_fullscreen_button"=>'',
				"enable_play_button"=>''
			), $atts));
			
			if( $limit ) { 
				$posts_per_page = $limit; 
			} else {
				$posts_per_page = '-1';
			}
			if( $cat_id ) { 
				$cat = $cat_id; 
			} else {
				$cat = '';
			}	
			
			if( $design ) { 
				$slidercdesign = $design; 
			} else {
				$slidercdesign = 'design-1';
			}	
			
			if( $gallery_width ) { 
				$widthslider = $gallery_width; 
			} else {
				$widthslider = '100%';
			}	
			
			if( $gallery_height ) { 
				$heightslider = $gallery_height; 
			} else {
				$heightslider = '450';
			}			
			
			if( $slider_transition ) { 
				$navigationslider = $slider_transition; 
			} else {
				$navigationslider = 'slide';
			}

			if( $slider_transition_speed ) { 
				$speedslider = $slider_transition_speed; 
			} else {
				$speedslider = '300';
			}	

			if( $gallery_autoplay ) { 
				$autoplayslider = $gallery_autoplay; 
			} else {
				$autoplayslider = 'false';
			}	 	
			
			if( $gallery_play_interval ) { 
				$autoplay_intervalslider = $gallery_play_interval; 
			} else {
				$autoplay_intervalslider = '2000';
			}
			
			if( $enable_fullscreen_button ) { 
				$fullscreen_button_slider = $enable_fullscreen_button; 
			} else {
				$fullscreen_button_slider = 'false';
			}
			
			if( $enable_play_button ) { 
				$play_button_slider = $enable_play_button; 
			} else {
				$play_button_slider = 'false';
			}
			
			ob_start();
			// Create the Query
			$post_type 		= 'sp_responsivegallery';
			$orderby 		= 'post_date';
			$order 			= 'DESC';
						
			 $args = array ( 
		            'post_type'      => $post_type, 
		            'orderby'        => $orderby, 
		            'order'          => $order,
		            'posts_per_page' => $posts_per_page,  
		           
		            );
			if($cat != ""){
		            	$args['tax_query'] = array( array( 'taxonomy' => 'responsive_slider-category', 'field' => 'id', 'terms' => $cat) );
		            }        
		      $query = new WP_Query($args);
			  //print_r( $args);
			$post_count = $query->post_count;
			$i = 1;
			if( $post_count > 0) :
			?>
			  <div id="gallery" class="<?php echo $slidercdesign; ?>">
			<?php	
				// Loop 
				
				while ($query->have_posts()) : $query->the_post();
					
					switch ($slidercdesign) {
						 case "design-1":
							include('designs/design-1.php');
							break;
						 case "design-2":
							include('designs/design-2.php');
							break;
						 case "design-3":
							include('designs/design-3.php');
							break;	
						
						 default:		 

								include('designs/design-1.php');

					}
					
				$i++;
				endwhile; 
				
				?>
				</div>
			<?php
			endif;
			// Reset query to prevent conflicts
			wp_reset_query();
			?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#gallery.<?php echo $slidercdesign; ?>").unitegallery({
						
						//gallery width
						gallery_width:"<?php echo $widthslider; ?>",	

						//gallery height
						gallery_height:"<?php echo $heightslider; ?>",
						
						//fade, slide - the transition of the slide change
						slider_transition: "<?php echo $navigationslider; ?>",
						
						//transition duration of slide change
						slider_transition_speed: <?php echo $speedslider; ?>,											
						
						//all - load all the images first time.
						gallery_images_preload_type:"minimal",

						//true / false - begin slideshow autoplay on start
						gallery_autoplay:<?php if($autoplayslider == "false") { echo 'false';} else { echo 'true'; } ?>,

						//play interval of the slideshow
						gallery_play_interval: <?php echo $autoplay_intervalslider; ?>,
						
						theme_enable_fullscreen_button:<?php if($fullscreen_button_slider == "false") { echo 'false';} else { echo 'true'; } ?>, 
							
						theme_enable_play_button: <?php if($play_button_slider == "false") { echo 'false';} else { echo 'true'; } ?>, 
						
					});

				});
			</script>
			
			<?php
			return ob_get_clean();
		}
	
	}
}

function pgs_perfect_gallery_slider_load() {
        global $mfpd;
        $mfpd = new Perfect_Gallery_Slider();
}
add_action( 'plugins_loaded', 'pgs_perfect_gallery_slider_load' );