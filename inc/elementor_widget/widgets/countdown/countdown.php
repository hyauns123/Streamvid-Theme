<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * jws Countdown Widget
 *
 * jws Widget to display countdown.
 *
 * @since 1.0
 */

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use ELementor\Group_Control_Background;
use ELementor\Group_Control_Border;

class Jws_Countdown_Elementor_Widget extends Widget_Base {

	public function get_name() {
		return 'jws_widget_countdown';
	}

	public function get_title() {
		return esc_html__( 'Countdown', 'streamvid' );
	}

	public function get_icon() {
		return 'eicon-countdown';
	}

	public function get_categories() {
		return array( 'jws-elements' );
	}

	public function get_keywords() {
		return array( 'countdown', 'counter', 'timer' );
	}

	public function get_script_depends() {
		return array( 'jquery.countdown' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_countdown',
			array(
				'label' => esc_html__( 'Countdown', 'streamvid' ),
			)
		);
		$this->add_control(
			'date',
			array(
				'label'       => esc_html__( 'Target Date', 'streamvid' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => '',
				'description' => esc_html__(
					'Set the certain date the countdown element will count down to.',
					'streamvid'
				),
			)
		);
		$this->add_control(
			'timezone',
			array(
				'label'       => esc_html__( 'Timezone', 'streamvid' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''              => esc_html__( 'WordPress Defined Timezone', 'streamvid' ),
					'user_timezone' => esc_html__( 'User System Timezone', 'streamvid' ),
				),
				'description' => esc_html__(
					'Allows you to specify which timezone is used, the sites or the viewer timezone.',
					'streamvid'
				),
			)
		);
		$this->add_control(
			'label',
			array(
				'label'     => esc_html__( 'Label', 'streamvid' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Offer Ends In',
				'condition' => array(
					'type' => 'inline',
				),
			)
		);
		$this->add_control(
			'label_type',
			array(
				'label'       => esc_html__( 'Unit Type', 'streamvid' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''      => esc_html__( 'Full', 'streamvid' ),
					'short' => esc_html__( 'Short', 'streamvid' ),
				),
				'condition'   => array(
					'type' => 'block',
				),
				'description' => esc_html__(
					'Select time unit type from full and short. The default type is the full type.',
					'streamvid'
				),
			)
		);
		$this->add_control(
			'label_pos',
			array(
				'label'       => esc_html__( 'Unit Position', 'streamvid' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '',
				'options'     => array(
					''       => esc_html__( 'Inner', 'streamvid' ),
					'outer'  => esc_html__( 'Outer', 'streamvid' ),
					'custom' => esc_html__( 'Custom', 'streamvid' ),
				),
				'condition'   => array(
					'type' => 'block',
				),
				'description' => esc_html__(
					'Select unit position from inner, outer and custom. The default position is inner.',
					'streamvid'
				),
			)
		);

		$this->add_responsive_control(
			'label_dimension',
			array(
				'label'      => esc_html__( 'Label Position', 'streamvid' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px',
					'%',
				),
				'range'      => array(
					'px' => array(
						'step' => 1,
						'min'  => -50,
						'max'  => 50,
					),
					'%'  => array(
						'step' => 1,
						'min'  => 0,
						'max'  => 100,
					),
				),
				'selectors'  => array(
					'.elementor-element-{{ID}} .countdown .countdown-period' => 'bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'label_pos' => 'custom',
				),
			)
		);

		$this->add_control(
			'date_format',
			array(
				'label'       => esc_html__( 'Units', 'streamvid' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'default'     => array(
					'D',
					'H',
					'M',
					'S',
				),
				'options'     => array(
					'Y' => esc_html__( 'Year', 'streamvid' ),
					'O' => esc_html__( 'Month', 'streamvid' ),
					'W' => esc_html__( 'Week', 'streamvid' ),
					'D' => esc_html__( 'Day', 'streamvid' ),
					'H' => esc_html__( 'Hour', 'streamvid' ),
					'M' => esc_html__( 'Minute', 'streamvid' ),
					'S' => esc_html__( 'Second', 'streamvid' ),
				),
				'description' => esc_html__(
					'Allows to show or hide the amount of time aspects used in the countdown element.',
					'streamvid'
				),
			)
		);
		$this->add_control(
			'hide_split',
			array(
				'label'       => esc_html__( 'Hide Spliter?', 'streamvid' ),
				'type'        => Controls_Manager::SWITCHER,
				'condition'   => array(
					'type' => 'block',
				),
				'description' => esc_html__(
					'Allows you to show or hide the splitters between time amounts.​',
					'streamvid'
				),
			)
		);
		$this->add_control(
			'type',
			array(
				'label'       => esc_html__( 'Type', 'streamvid' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'block',
				'options'     => array(
					'block'  => esc_html__( 'Block', 'streamvid' ),
					'inline' => esc_html__( 'Inline', 'streamvid' ),
				),
				'description' => esc_html__(
					'Select countdown type from block and inline types.​',
					'streamvid'
				),
			)
		);
		$this->add_control(
			'enable_grid',
			array(
				'label'       => esc_html__( 'Enabel Grid', 'streamvid' ),
				'description' => esc_html__( 'Enables to configure your countdown with the grid mode.', 'streamvid' ),
				'type'        => Controls_Manager::SWITCHER,
				'default'     => 'no',
				'condition'   => array(
					'type' => 'block',
				),
			)
		);
		$this->add_responsive_control(
			'grid_cols',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Columns', 'streamvid' ),
				'description' => esc_html__( 'Type a certain number for the grid columns.', 'streamvid' ),
				'default'     => array(
					'size' => 2,
					'unit' => 'px',
				),
				'size_units'  => array(
					'px',
				),
				'range'       => array(
					'px' => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 60,
					),
				),
				'condition'   => array(
					'type'        => 'block',
					'enable_grid' => 'yes',
				),
				'selectors'   => array(
					'.elementor-element-{{ID}} .countdown-row' => 'display: grid; grid-template-columns: repeat({{SIZE}}, calc(100% / {{SIZE}})); grid-template-rows: auto;',
				),
			)
		);
		$this->add_control(
			'align',
			array(
				'label'       => esc_html__( 'Alignment', 'streamvid' ),
				'type'        => Controls_Manager::CHOOSE,
				'default'     => 'flex-start',
				'options'     => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'streamvid' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'streamvid' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'streamvid' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors'   => array(
					'.elementor-element-{{ID}} .countdown-container' => 'justify-content: {{VALUE}}',
				),
				'description' => esc_html__(
					'Determine where the countdown is located, left, center or right.​',
					'streamvid'
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'countdown_dimension',
			array(
				'label' => esc_html__( 'Dimension', 'streamvid' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'item_width',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Item Width', 'streamvid' ),
				'description' => esc_html__( 'Controls the width of each countdown section.', 'streamvid' ),
				'default'     => array(
					'unit' => 'px',
				),
				'size_units'  => array(
					'px',
					'rem',
				),
				'range'       => array(
					'px'  => array(
						'step' => 1,
						'min'  => 73,
						'max'  => 500,
					),
					'rem' => array(
						'step' => 0.1,
						'min'  => 7.3,
						'max'  => 50,
					),
				),
				'condition'   => array(
					'type' => 'block',
				),
				'selectors'   => array(
					'.elementor-element-{{ID}} .countdown-section' => 'min-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; max-width: 100%;',
				),
			)
		);

		$this->add_responsive_control(
			'item_padding',
			array(
				'label'       => esc_html__( 'Item Padding', 'streamvid' ),
				'description' => esc_html__(
					'Controls the padding of each countdown section.',
					'streamvid'
				),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array(
					'px',
					'%',
				),
				'selectors'   => array(
					'.elementor-element-{{ID}} .countdown-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'item_margin',
			array(
				'label'       => esc_html__( 'Item Margin', 'streamvid' ),
				'description' => esc_html__(
					'Controls the margin of each countdown section.',
					'streamvid'
				),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array(
					'px',
					'%',
				),
				'selectors'   => array(
					'.elementor-element-{{ID}} .countdown-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'label_margin',
			array(
				'label'       => esc_html__( 'Label Margin', 'streamvid' ),
				'description' => esc_html__(
					'Controls the margin of each countdown section in the inline type.',
					'streamvid'
				),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array(
					'px',
					'rem',
				),
				'selectors'   => array(
					'.elementor-element-{{ID}} .countdown-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'   => array(
					'type' => 'inline',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'countdown_typography',
			array(
				'label' => esc_html__( 'Typography', 'streamvid' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'        => 'countdown_amount',
				'label'       => esc_html__( 'Amount', 'streamvid' ),
				'description' => esc_html__(
					'Controls the typography of the countdown amount.',
					'streamvid'
				),
				'selector'    => '.elementor-element-{{ID}} .countdown-container .countdown-amount',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'        => 'countdown_label',
				'label'       => esc_html__( 'Unit, Label', 'streamvid' ),
				'description' => esc_html__(
					'Controls the typography of the countdown label.',
					'streamvid'
				),
				'selector'    => '.elementor-element-{{ID}} .countdown-period, .elementor-element-{{ID}} .countdown-label',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'countdown_color',
			array(
				'label' => esc_html__( 'Color', 'streamvid' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'countdown_section_color',
			array(
				'label'       => esc_html__( 'Section Background', 'streamvid' ),
				'description' => esc_html__(
					'Controls the backgorund color of the countdown section.',
					'streamvid'
				),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => array(
					'.elementor-element-{{ID}} .countdown-section' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'countdown_amount_color',
			array(
				'label'       => esc_html__( 'Amount', 'streamvid' ),
				'description' => esc_html__(
					'Controls the color of the countdown amount.',
					'streamvid'
				),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => array(
					'.elementor-element-{{ID}} .countdown-amount' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'countdown_label_color',
			array(
				'label'       => esc_html__( 'Unit, Label', 'streamvid' ),
				'description' => esc_html__(
					'Controls the color of the countdown label.',
					'streamvid'
				),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => array(
					'.elementor-element-{{ID}} .countdown-period' => 'color: {{VALUE}};',
					'.elementor-element-{{ID}} .countdown-label'  => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'countdown_separator_color',
			array(
				'label'       => esc_html__( 'Seperator', 'streamvid' ),
				'description' => esc_html__(
					'Controls the color of the countdown separator.',
					'streamvid'
				),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => array(
					'.elementor-element-{{ID}} .countdown-section:after' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'countdown_border',
			array(
				'label'     => esc_html__( 'Border', 'streamvid' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'type' => 'block',
				),
			)
		);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'        => 'border',
					'description' => esc_html__(
						'Controls the border of the countdown section.',
						'streamvid'
					),
					'selector'    => '.elementor-element-{{ID}} .countdown-section',
				)
			);

			$this->add_control(
				'border-radius',
				array(
					'type'        => Controls_Manager::SLIDER,
					'label'       => esc_html__( 'Border-radius', 'streamvid' ),
					'description' => esc_html__(
						'Controls the border radius of the countdown section.',
						'streamvid'
					),
					'size_units'  => array(
						'px',
						'%',
					),
					'range'       => array(
						'%'  => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
						'px' => array(
							'step' => 1,
							'min'  => 0,
							'max'  => 100,
						),
					),
					'selectors'   => array(
						'.elementor-element-{{ID}} .countdown-section' => 'border-radius: {{SIZE}}{{UNIT}};',
					),
				)
			);

		$this->end_controls_section();
	}

	protected function render() {
		$atts = $this->get_settings_for_display();

		include 'content.php';
	}
}
