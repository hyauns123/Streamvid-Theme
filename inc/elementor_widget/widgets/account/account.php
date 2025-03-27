<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Account extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'jws_account';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Jws Account Popup', 'streamvid' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-lock-user';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'jws-elements' ];
	}


	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_account_setting',
			[
				'label' => esc_html__( 'Toggle', 'streamvid' ),
			]
		);

        $this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'streamvid' ),
					'type' => \Elementor\Controls_Manager::ICONS,
				]
		);
        
        $this->add_control(
            'show_dropdown',
            [
                'label'         => esc_html__( 'Show Dropdown Menu', 'streamvid' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'streamvid' ),
                'label_off'     => esc_html__( 'No', 'streamvid' ),
                'default'   => 'yes',
            ]
        );

        
		$this->add_control(
            'show_text',
            [
                'label'         => esc_html__( 'Show Text(Name User)', 'streamvid' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'streamvid' ),
                'label_off'     => esc_html__( 'No', 'streamvid' ),
                'default'   => 'yes',
            ]
        );


        $this->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'streamvid' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'Login / Register', 'streamvid' ),
                'condition'	=> [
						'show_text' => 'yes',
				],
			]
          
		);
        $this->add_control(
			'text_after_login',
			[
				'label' => esc_html__( 'Text After Login', 'streamvid' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'My Accounts', 'streamvid' ),
                'condition'	=> [
						'show_text' => 'yes',
				],
			]
          
		);
  
		$this->end_controls_section();
  
		$this->start_controls_section(
			'toggle_style',
			[
				'label' => esc_html__( 'Toggle Style', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
				'align',
				[
					'label' 		=> esc_html__( 'Align', 'streamvid' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'default' 		=> 'left',
					'options' 		=> [
						'left'    		=> [
							'title' 	=> esc_html__( 'Left', 'streamvid' ),
							'icon' 		=> 'eicon-h-align-left',
						],
						'center' 		=> [
							'title' 	=> esc_html__( 'Center', 'streamvid' ),
							'icon' 		=> 'eicon-h-align-center',
						],
						'right' 		=> [
							'title' 	=> esc_html__( 'Right', 'streamvid' ),
							'icon' 		=> 'eicon-h-align-right',
						],
					],
                    'selectors' => [
							'{{WRAPPER}} .jws_account' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
         $this->add_control(
					'icon_color',
					[
						'label' 	=> esc_html__( 'Icon Color', 'streamvid' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_a_icon' => 'color: {{VALUE}};',
						],
					]
		);
        $this->add_control(
				'icon_size',
				[
					'label' 		=> esc_html__( 'Icon Size', 'streamvid' ),
					'type' 			=> Controls_Manager::SLIDER,
					'range' 		=> [
						'px' 		=> [
							'min' => 1,
							'max' => 100,
							'step' => 1,
						],
					],
					'selectors' 	=> [
						'{{WRAPPER}} .jws_a_icon' => 'font-size: {{SIZE}}px;',
					],
				]
		);
        $this->add_responsive_control(
					'icon_margin',
					[
						'label' 		=> esc_html__( 'Icon Margin', 'streamvid' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws_account a .jws_a_icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->add_control(
					'text_color',
					[
						'label' 	=> esc_html__( 'Text Color', 'streamvid' ),
						'type' 		=> Controls_Manager::COLOR,
						'default' 	=> '',
						'selectors' => [
							'{{WRAPPER}} .jws_account_text' => 'color: {{VALUE}};',
						],
                        'condition'	=> [
						'show_text' => 'yes',
				        ],
					]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'streamvid'),
				'selector' => '{{WRAPPER}} .jws_account_text',
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'popup_style',
			[
				'label' => esc_html__( 'Popup Style', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background Overlay', 'streamvid' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .jws_account_overlay',
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        $show_text = $settings['show_text'];
        $text = $settings['text'];
        $text_after_login = $settings['text_after_login'];
   
        include( 'content.php' );

	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {}
}