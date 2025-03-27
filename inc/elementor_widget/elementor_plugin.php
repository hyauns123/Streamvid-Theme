<?php
// direct load is not allowed
if ( ! defined( 'ABSPATH' ) ) {
	die();
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0
 */
class Plugin {
    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;
    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function enqueue_editor_scripts() {
        wp_register_script('jws-query-control', JWS_URI_PATH . '/inc/elementor_widget/control/js/query.js', array(), '', true);
        wp_enqueue_script( 'jquery-ui-sortable' );
    }
    public function enqueue_frontend_scripts() {
    	
    }
    public function get_scripts($name_js_ccs) {
        wp_enqueue_script($name_js_ccs);
    }
    /**
     * Include Control files
     *
     * Load controls files
     *
     * @since 1.2.0
     * @access private
     */
    private function include_control_files() {
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/control/query.php');

    }
    public function register_controls($controls_manager ) {
        // Its is now safe to include Control files
        $this->include_control_files();
    
        $controls_manager->register(new JwsElementor\Control\Query());
      
    }
    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets() {
        
        // Its is now safe to include Widgets files
        

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/title/title.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Heading_Elementor_Widget());

        

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/account/account.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Account());
            
            
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/menu_nav/menu_nav.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Nav_Menu());
        
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/video_popup/video_popup.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Video_popup());
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/info_box/info_box.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Info_Box());
  
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/testimonial_slider/testimonial_slider.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Testimonial_Slider());
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/blog/blog.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Blog());
        
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/team/team.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Team());
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/breadcrumbs/breadcrumbs.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Breadcrumbs());


        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/tab/tab.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_tab());

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/contact_form7/contact_form7.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_cf7());

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/map/map.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\GoogleMap());
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/search/search.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Search());

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/dropdown_text/dropdown_text.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Dropdown_Text());

        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/off_canvas/off_canvas.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Offcanvas());
        
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/login_form/login_form.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Login_form());
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/banner/banner.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Banner());

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/logo/logo.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Logo());
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/button/button.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Gradient_Button());
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/jws_gallery/jws_gallery.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Gallery());
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/menu_list/menu_list.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Menu_list());
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/demo_filter/demo_filter.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Demo());

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/instagram/instagram.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Instagram());
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/slider/slider.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Slider());
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/countdown/countdown.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Countdown_Elementor_Widget());

        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/template/template.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Template());
        
        require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/image_carousel/image_carousel.php');
        \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Image_Carousel());
        
         /**
         * Register Widgets Woocommerce
         */
        if (class_exists('Woocommerce')) {  
       
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/product_tabs/product_tab.php');
            \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\JwsProductAdvanced()); 
            
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/woocommerce/mini-cart/mini-cart.php');
            \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Menu_Cart());
            
            
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/widgets/woocommerce/category_tabs/category_tabs.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\JwsCategoryList());

        }

        if(class_exists('Jws_Streamvid')) {
            require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/slider_video/slider_video.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Slider_Video()); 
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/movies_advanced/movies_advanced.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Movies_Advanded()); 
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/playlist_trailer/playlist_trailer.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Playlist_Trailer());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/tv_shows_tabs/tv_shows_tabs.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Tv_Shows_Tabs());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/tv_shows_advanced/tv_shows_advanced.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Tv_Shows_Advanded());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/videos_advanced/videos_advanced.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Videos_Advanded());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/person_advanced/person_advanced.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Person_Advanded());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/video_special/video_special.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Video_Special());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/videos_category/videos_category.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Videos_Cat());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/episodes_advanced/episodes_advanced.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Episodes_Advanded());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/top_videos_advanced/top_videos_advanced.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Top_Videos());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/menu_header_side/menu_header_side.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Menu_Side());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/watchlist_button/watchlist_button.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_watchlist_button());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/post_category_filter/post_category_filter.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Post_Category_Filter());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/post_years_filter/post_years_filter.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Post_Years_Filter()); 
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/post_letter_filter/post_letter_filter.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Post_Letter_Filter()); 
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/pmpro_level/pmpro_level.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_Pmpro_Level()); 
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/history/history.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_History());
           
           require_once (JWS_ABS_PATH . '/inc/elementor_widget/video/my_list/my_list.php');
           \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Jws_My_List());  
                 
        }
        
        if (class_exists( 'YITH_WCWL' ) ) {
            \Elementor\Plugin::instance()->widgets_manager->register(new Elementor\Wishlist());
        }
        
    }
    public function register_categoris() {
        \Elementor\Plugin::$instance->elements_manager->add_category('jws-elements', ['title' => esc_html__('JWS Themes Widget', 'streamvid'), 'icon' => 'fa fa-plug', ], 1);

    }
    
    public function register_element() {
        include_once ('row-cutom.php');
		\Elementor\Plugin::$instance->elements_manager->unregister_element_type( 'section' );
		\Elementor\Plugin::$instance->elements_manager->register_element_type( new Jws_Section() );

	}
    
    public function load_styles() {
        wp_enqueue_style('jws-admin-styles', JWS_URI_PATH.'/assets/css/admin.css');
	}
    
    
    public function register_document_controls( $document ) { 
        
        $document->start_controls_section(
			'jws_custom_css_settings',
			array(
				'label' => esc_html__( 'Jws Custom CSS', 'streamvid' ),
				'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
			)
		);

		$document->add_control(
				'page_css',
				array(
					'type' => Elementor\Controls_Manager::TEXTAREA,
					'rows' => 40,
				)
		);

		$document->end_controls_section();
        
    }
    
    
    public function save_page_custom_css_js( $self, $data ) { 
        
        if ( empty( $data['settings'] ) || empty( $_REQUEST['editor_post_id'] ) ) {
			return;
		}
		$post_id = absint( $_REQUEST['editor_post_id'] );

		// save Riode elementor page CSS
		if ( ! empty( $data['settings']['page_css'] ) ) {
			update_post_meta( $post_id, 'page_css', wp_slash( $data['settings']['page_css'] ) );
		} else {
			delete_post_meta( $post_id, 'page_css' );
		}
        
    }
    
    public function save_elementor_page_css_js( $self, $data ) { 
       
       if ( current_user_can( 'unfiltered_html' ) || empty( $data['settings'] ) || empty( $_REQUEST['editor_post_id'] ) ) {
			return;
		}
		$post_id = absint( $_REQUEST['editor_post_id'] );
		if ( ! empty( $data['settings']['page_css'] ) ) {
			$elementor_settings = get_post_meta( $post_id, '_elementor_page_settings', true );
			if ( is_array( $elementor_settings ) ) {
				$elementor_settings['page_css'] =  get_post_meta( $post_id, 'page_css', true  );
				update_post_meta( $post_id, '_elementor_page_settings', $elementor_settings );
			}
		} 
        
    }
    
    
    public function jws_add_icon_library( $icons ) {
          

			$icons['jws-icons'] = array(
				'name'          => 'jws',
				'label'         => esc_html__( 'Jws Icons', 'streamvid' ),
				'prefix'        => 'jws-icon-',
				'displayPrefix' => ' ',
				'labelIcon'     => 'jws-icon',
			    'url'           => JWS_URI_PATH . '/assets/font/jws_icon/jwsicon.css',
				'native'        => false,
               'fetchJson'     =>  JWS_URI_PATH. '/assets/font/jws_icon/icon.json',
		        'ver'           => '1.0.0',
			);
	
		    return $icons;
	}
    
        
    	/**
	 * Get post by search
	 *
	 * @since 1.1.0
	 */
	public function jws_get_posts_by_query() {

		$search_string = isset( $_POST['q'] ) ? sanitize_text_field( $_POST['q'] ) : '';
		$req_post_type = isset( $_POST['post_type'] ) ? sanitize_text_field( $_POST['post_type'] ) : 'all';

		$data   = array();
		$result = array();

		$args = array(
			'public'   => true,
			'_builtin' => false,
		);

		$output   = 'names'; // names or objects, note names is the default.
		$operator = 'and'; // also supports 'or'.

		if ( 'all' === $req_post_type ) {
			$post_types = get_post_types( $args, $output, $operator );

			$post_types['Posts'] = 'post';
			$post_types['Pages'] = 'page';
		} else {
			$post_types[ $req_post_type ] = $req_post_type;
		}

		foreach ( $post_types as $key => $post_type ) {

			$data = array();


			$query = new \WP_Query(
				array(
					's'              => $search_string,
					'post_type'      => $post_type,
					'posts_per_page' => - 1,
				)
			);

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$title  = get_the_title();
					$title .= ( 0 != $query->post->post_parent ) ? ' (' . get_the_title( $query->post->post_parent ) . ')' : '';
					$id     = get_the_id();
					$data[] = array(
						'id'   => $id,
						'text' => $title,
					);
				}
			}

			if ( is_array( $data ) && ! empty( $data ) ) {
				$result[] = array(
					'text'     => $key,
					'children' => $data,
				);
			}
		}

		$data = array();

		wp_reset_postdata();

		// return the result in json.
		wp_send_json( $result );
	}  

    
    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct() {
        include_once ('shade_animation.php');
        include_once ('row-sticky.php');
        include_once ('font-custom.php');
        include_once ('css_js_custom.php');
        include_once ('tabs-name-custom.php');
        
        add_action('init', array($this, 'register_categoris'));
        // Register widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        // Register controls
        add_action('elementor/controls/register', [$this, 'register_controls']);
        // Editor Scripts
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_scripts']);
        // Frontend Scripts
        add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'enqueue_frontend_scripts' ]);
        
        add_action( 'elementor/elements/elements_registered', array( $this, 'register_element' ) );
        
        add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'load_styles' ) );
        
        add_action( 'elementor/documents/register_controls', array( $this, 'register_document_controls' ) );
        
        if ( wp_doing_ajax() ) {
			add_action( 'elementor/document/before_save', array( $this, 'save_page_custom_css_js' ), 10, 2 );
			add_action( 'elementor/document/after_save', array( $this, 'save_elementor_page_css_js' ), 10, 2 );
		}
        
        add_action(
			'elementor/editor/after_enqueue_scripts',
			function() {
                wp_enqueue_script( 'jws-elementor-admin-js', JWS_URI_PATH. '/assets/js/widget-js/elementor-admin.js', array( 'elementor-editor' ) , '', true );
			}
		);
        
        if(is_admin()) {
          add_filter( 'elementor/icons_manager/additional_tabs', array( $this, 'jws_add_icon_library' ) );  
          add_action( 'wp_ajax_jws_get_posts_by_query', array( $this, 'jws_get_posts_by_query' ));
        } 
         
    }
}
// Instantiate Plugin Class
Plugin::instance();

/**
* Custom Widget Default
*/

add_action( 'elementor/element/icon-box/section_icon/before_section_end', function( $element, $args ) {

     $element->add_control(
			'hover_select',
			[
				'label' =>  esc_html__( 'Hover Change All Content', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' =>  esc_html__( 'none', 'streamvid' ),
                    'all' =>  esc_html__( 'All Content', 'streamvid' ),
				],
				'default' => 'none',
                'prefix_class' => 'elementor_icon_hover_',
			]
	);
    
    $element->add_control(
			'hover_all',
			[
				'label' =>  esc_html__( 'Color Hover', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor_icon_hover_all:hover  .elementor-icon-box-content .elementor-icon-box-description , {{WRAPPER}}.elementor_icon_hover_all:hover  .elementor-icon-box-content .elementor-icon-box-title , {{WRAPPER}}.elementor_icon_hover_all:hover .elementor-icon' => 'color: {{VALUE}}',
				],
                'condition' => [
						  'hover_select' => 'all',
				],
			]
	);
  
	
}, 10, 2 );

add_action( 'elementor/element/icon-box/section_style_icon/before_section_end', function( $element, $args ) {

        $element->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' =>  esc_html__( 'Box Shadow', 'streamvid' ),
				'selector' => '{{WRAPPER}} .elementor-icon',
			]
		);

  
	
}, 10, 2 ); 

add_action( 'elementor/element/counter/section_number/before_section_end', function( $element, $args ) {

       $element->add_control(
			'jws_suffix',
			[
				'label' =>  esc_html__( 'Suffix Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-counter .elementor-counter-number-suffix' => 'color: {{VALUE}}',
				],
			]
	   );

  
	
}, 10, 2 ); 

add_action( 'elementor/element/accordion/section_title_style/before_section_end', function( $element, $args ) {

    $element->add_control(
			'spacing',
			[
				'label' =>  esc_html__( 'Spacing', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
	);
     $element->add_control(
			'radius',
			[
				'label' =>  esc_html__( 'Border Radius', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
    $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jws_ac_border',
				'label' =>  esc_html__( 'Border', 'streamvid' ),
				'selector' => '{{WRAPPER}} .elementor-accordion .elementor-accordion-item',
			]
		);

}, 10, 2 );

add_action( 'elementor/element/icon-box/section_style_icon/before_section_end', function( $element, $args ) {

        $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon-box-border',
				'label' =>  esc_html__( 'Border', 'streamvid' ),
				'selector' => '{{WRAPPER}} .elementor-icon',
			]
		);
  
	
}, 10, 2 );

add_action( 'elementor/element/accordion/section_toggle_style_icon/before_section_end', function( $element, $args ) {

        $element->add_control(
			'icon_size',
			[
				'label' =>  esc_html__( 'Icon Size', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
         $element->add_control(
			'icon_padding',
			[
				'label' =>  esc_html__( 'Padding', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
        $element->add_control(
			'icon_margin',
			[
				'label' =>  esc_html__( 'Margin', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
         $element->add_control(
			'icon_radius',
			[
				'label' =>  esc_html__( 'Border Radius', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
        $element->add_control(
			'icon_width_height',
			[
				'label' 		=> esc_html__( 'Icon Width Height', 'streamvid' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' 		=> [
						'min' => 40,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon' => 'height: {{SIZE}}px;line-height: {{SIZE}}px;width: {{SIZE}}px;text-align:center;',
				],
			]
	);
     $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' =>  esc_html__( 'Border', 'streamvid' ),
				'selector' => '{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon',
			]
		);
        $element->add_control(
			'icon_bg',
			[
				'label' =>  esc_html__( 'Background', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon' => 'background: {{VALUE}}',
				],
			]
	   );
       $element->add_control(
			'icon_bg_active',
			[
				'label' =>  esc_html__( 'Background Active', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active .elementor-accordion-icon' => 'background: {{VALUE}}',
				],
			]
	   );
  
	
}, 10, 2 );

add_action( 'elementor/element/accordion/section_toggle_style_title/before_section_end', function( $element, $args ) {

         $element->add_control(
			'toggle_radius',
			[
				'label' =>  esc_html__( 'Boder Radius', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
        $element->add_control(
			'toggle_background_active',
			[
				'label' =>  esc_html__( 'Background Active', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}}',
				],
			]
	   );
       $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'toggle_border',
				'label' =>  esc_html__( 'Border', 'streamvid' ),
				'selector' => 'body {{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title',
			]
		);

        
        $element->add_control(
			'toggle_border_active',
			[
				'label' =>  esc_html__( 'Border Color Active', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body {{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active' => 'border-color: {{VALUE}}',
				],
			]
	   );
        
        
        $element->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'toggle_box_shadow',
				'label' =>  esc_html__( 'Box Shadow Active', 'streamvid' ),
				'selector' => 'body {{WRAPPER}} .elementor-accordion .elementor-accordion-item .elementor-tab-title.elementor-active',
			]
		);
	
}, 10, 2 );

/* Count Down */

add_action( 'elementor/element/countdown/section_box_style/before_section_end', function( $element, $args ) {

    $element->add_responsive_control(
			'countdown_width',
			[
				'label' =>  esc_html__( 'Width', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .elementor-countdown-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
	);
    
    $element->add_responsive_control(
			'countdown_height',
			[
				'label' =>  esc_html__( 'Height', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .elementor-countdown-item' => 'height:{{SIZE}}{{UNIT}};line-height:{{SIZE}}{{UNIT}};',
				],
			]
	);

}, 10, 2 );

add_action( 'elementor/element/button/section_style/before_section_end', function( $element, $args ) {

        $element->add_control(
			'icon_size',
			[
				'label' =>  esc_html__( 'Icon Size', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
         $element->add_control(
			'icon_btn_margin',
			[
				'label' =>  esc_html__( 'Icon Margin', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-button-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
  
	
}, 10, 2 );

add_action( 'elementor/element/tabs/section_tabs_style/before_section_end', function( $element, $args ) {
        $element->add_responsive_control(
			'tabnav_padding',
			[
				'label' =>  esc_html__( 'Navigation Padding', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tabs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
	   );    
        $element->add_responsive_control(
			'tab_padding',
			[
				'label' =>  esc_html__( 'Title Padding', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
	   );
         $element->add_responsive_control(
			'tab_margin',
			[
				'label' =>  esc_html__( 'Title Margin', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
	   );
  
	
}, 10, 2 );

add_action( 'elementor/element/icon-list/section_icon_style/before_section_end', function( $element, $args ) {
         $element->add_responsive_control(
			'list-icon_margin',
			[
				'label' =>  esc_html__( 'Margin', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
	   );
	
}, 10, 2 );
add_action( 'elementor/element/icon-list/section_text_style/before_section_end', function( $element, $args ) {
        $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list-icon_border',
				'label' =>  esc_html__( 'Border', 'streamvid' ),
				'selector' => '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text',
			]
		);
        $element->add_control(
			'list-icon_border_hover',
			[
				'label' =>  esc_html__( 'Border Hover Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-element .elementor-icon-list-items .elementor-icon-list-item:hover .elementor-icon-list-text' => 'border-color: {{VALUE}}',
				],
			]
	   );
	
}, 10, 2 );
add_action( 'elementor/element/progress/section_progress_style/before_section_end', function( $element, $args ) {
       $element->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'              => 'progress_bg',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}} .elementor-progress-wrapper .elementor-progress-bar',
			]
	   );
         $element->add_control(
			'progress_bg_radius_render',
			[
				'label' =>  esc_html__( 'Border Radius Inner', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );
}, 10, 2 );
add_action( 'elementor/element/tabs/section_tabs_style/before_section_end', function( $element, $args ) {
        $element->add_responsive_control(
			'icon_size',
			[
				'label' =>  esc_html__( 'Content Width', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-tabs.elementor-tabs-view-vertical .elementor-tabs-content-wrapper' => 'width: {{SIZE}}%;',
				],
			]
	);
}, 10, 2 );
add_action( 'elementor/element/animated-headline/section_style_text/before_section_end', function( $element, $args ) {

       $element->add_control(
			'animated-headline-after-color',
			[
				'label' =>  esc_html__( 'Animated Clip After Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-headline-animation-type-clip .elementor-headline-dynamic-wrapper:after' => 'background-color: {{VALUE}}',
				],
			]
	   );

  
	
}, 10, 2 );    
add_action( 'elementor/element/post-info/section_text_style/before_section_end', function( $element, $args ) {

       $element->add_control(
			'post-info-color-hover',
			[
				'label' =>  esc_html__( 'Color Hover', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover .elementor-icon-list-text , {{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item a:hover' => 'color: {{VALUE}}',
				],
			]
	   );
        $element->add_control(
			'post-info-before-color',
			[
				'label' =>  esc_html__( 'Before Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text .elementor-post-info__item-prefix' => 'color: {{VALUE}}',
				],
			]
	   );

  
	
}, 10, 2 );   


add_action( 'elementor/element/accordion/section_toggle_style_content/before_section_end', function( $element, $args ) {
      $element->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' =>  esc_html__( 'Border', 'streamvid' ),
				'selector' => '{{WRAPPER}} .elementor-tab-content',
			]
		);  
      $element->add_control(
			'toggle_margin',
			[
				'label' =>  esc_html__( 'Margin', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
	   );

  
	
}, 10, 2 ); 





add_action( 'elementor/element/heading/section_title_style/before_section_end', function( $element, $args ) {
       
 
       $element->add_control(
			'heading_hover',
			[
				'label' =>  esc_html__( 'Color Hover', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-heading .elementor-heading-title:hover' => 'color: {{VALUE}}',
				],
                'condition' => [
						  'hover_select' => 'all',
				],                
			]
	   );

  
	
}, 10, 2 ); 



add_action( 'elementor/element/column/section_style/before_section_end', function( $element, $args ) {
        $element->add_control(
			'enable_bg_before',
			[
				'label' => esc_html__( 'Enable Before Background', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'streamvid' ),
				'label_off' => esc_html__( 'Hide', 'streamvid' ),
				'return_value' => 'yes',
                'prefix_class' => 'elementor-bg-before-',
			]
		); 
        $element->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'              => 'background_before',
				'types'             => [ 'classic', 'gradient' ],
				'selector'          => '{{WRAPPER}}.elementor-bg-before-yes:before',
                'condition' => [
						  'enable_bg_before' => 'yes',
				], 
			]
	   );
       $element->add_control(
			'bg_align',
			[
				'label' => esc_html__( 'Before Background Align', 'streamvid' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'streamvid' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'streamvid' ),
						'icon' => 'eicon-h-align-right',
					],
				],
                'default' => 'left',
                'condition' => [
						  'enable_bg_before' => 'yes',
				],
                'prefix_class' => 'elementor-bg-before-align-',
			]
		);
       $element->add_responsive_control(
			'bg_before_width',
			[
				'label' 		=> esc_html__( 'Width', 'streamvid' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' 		=> [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
                 'condition' => [
						  'enable_bg_before' => 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}}.elementor-bg-before-yes:before' => 'width: {{SIZE}}vw;',
				],
			]
	   );
  
	
}, 10, 2 ); 

add_action( 'elementor/element/image/section_style_image/before_section_end', function( $element, $args ) {
       
 
        $element->add_control(
			'enable_360_animation',
			[
				'label' => esc_html__( 'Enable 360 Anomation', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'streamvid' ),
				'label_off' => esc_html__( 'Off', 'streamvid' ),
				'return_value' => 'yes',
                'prefix_class' => 'elementor-image-animation-360-',
			]
		);

  
	
}, 10, 2 ); 




function jws_slider_elemetor_control() {
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}




