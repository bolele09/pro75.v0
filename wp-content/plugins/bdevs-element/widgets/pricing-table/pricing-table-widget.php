<?php

namespace BdevsElement\Widget;

use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Repeater;
use \Elementor\Control_Media;
use \Elementor\Utils;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;

defined('ABSPATH') || die();

class Pricing_Table extends BDevs_El_Widget
{

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'pricing_table';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Pricing Table', 'bdevselement');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/pricing-table/';
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-table-of-contents';
    }

    public function get_keywords()
    {
        return ['pricing', 'price', 'table', 'package', 'product', 'plan'];
    }

    protected function register_content_controls()
    {

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Design Style', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'design_style',
            [
                'label' => __('Design Style', 'bdevselement'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevselement'),
                    'style_2' => __('Style 2', 'bdevselement'),
                    'style_3' => __('Style 3', 'bdevselement'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'active_price',
            [
                'label' => __('Active Price', 'bdevselement'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => false,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_media',
            [
                'label' => __('Icon / Image', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1']
                ]
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => __('Media Type', 'bdevselement'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => __('Icon', 'bdevselement'),
                        'icon' => 'fa fa-smile-o',
                    ],
                    'image' => [
                        'title' => __('Image', 'bdevselement'),
                        'icon' => 'fa fa-image',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Image', 'bdevselement'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'none',
                'exclude' => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        if (bdevs_element_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'icon',
                [
                    'label' => __('Icon', 'bdevselement'),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-smile-o',
                    'condition' => [
                        'type' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-smile-wink',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'type' => 'icon'
                    ]
                ]
            );
        }

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_header',
            [
                'label' => __('Header', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevselement'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Basic', 'bdevselement'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevselement'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Sub Title', 'bdevselement'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('MBPS', 'bdevselement'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('MBPS', 'bdevselement'),
                'dynamic' => [
                    'active' => true
                ],
                'condition' => [
                    'design_style' => ['style_1']
                ]
            ]
        );

        $this->end_controls_section();

                // Features
        $this->start_controls_section(
            '_section_devices',
            [
                'label' => __('Devices', 'bdevselement'),
                'condition' => [
                    'design_style' => ['style_2'],
                ]
            ]
        );


        $this->add_control(
            'devices_switch',
            [
                'label' => __('Show', 'bdevselement'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater = new Repeater();

        if (bdevs_element_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon_2',
                [
                    'label' => __('Icon', 'bdevselement'),
                    'type' => Controls_Manager::ICON,
                    'label_block' => false,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-check',
                    'include' => [
                        'fa fa-check',
                        'fa fa-close',
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'selected_icon_2',
                [
                    'label' => __('Icon', 'bdevselement'),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'fas fa-check',
                        'library' => 'fa-solid',
                    ],
                    'recommended' => [
                        'fa-regular' => [
                            'check-square',
                            'window-close',
                        ],
                        'fa-solid' => [
                            'check',
                        ]
                    ]
                ]
            );
        }

        $this->add_control(
            'devices',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_pricing',
            [
                'label' => __('Pricing', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => __('Currency', 'bdevselement'),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => __('None', 'bdevselement'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'bdevselement'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'bdevselement'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'bdevselement'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'bdevselement'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'bdevselement'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'bdevselement'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'bdevselement'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'bdevselement'),
                    'peseta' => '&#8359 ' . _x('Peseta', 'Currency Symbol', 'bdevselement'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'bdevselement'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'bdevselement'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'bdevselement'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'bdevselement'),
                    'rupee' => '&#8360; ' . _x('Rupee', 'Currency Symbol', 'bdevselement'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'bdevselement'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'bdevselement'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'bdevselement'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'bdevselement'),
                    'custom' => __('Custom', 'bdevselement'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'period_from',
            [
                'label' => __('Start From', 'bdevselement'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Start From', 'bdevselement'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => __('Custom Symbol', 'bdevselement'),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __('Price', 'bdevselement'),
                'type' => Controls_Manager::TEXT,
                'default' => '9.99',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => __('Period', 'bdevselement'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Per Month', 'bdevselement'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();

        // Features
        $this->start_controls_section(
            '_section_features',
            [
                'label' => __('Features', 'bdevselement'),
                'condition' => [
                    'design_style' => ['style_1', 'style_2']
                ]
            ]
        );

        $this->add_control(
            'features_switch',
            [
                'label' => __('Show', 'bdevselement'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => __('Text', 'bdevselement'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Exciting Feature', 'bdevselement'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        if (bdevs_element_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'icon',
                [
                    'label' => __('Icon', 'bdevselement'),
                    'type' => Controls_Manager::ICON,
                    'label_block' => false,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-check',
                    'include' => [
                        'fa fa-check',
                        'fa fa-close',
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'selected_icon',
                [
                    'label' => __('Icon', 'bdevselement'),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'fas fa-check',
                        'library' => 'fa-solid',
                    ],
                    'recommended' => [
                        'fa-regular' => [
                            'check-square',
                            'window-close',
                        ],
                        'fa-solid' => [
                            'check',
                        ]
                    ]
                ]
            );
        }

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => __('Standard Feature', 'bdevselement'),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => __('Another Great Feature', 'bdevselement'),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => __('Obsolete Feature', 'bdevselement'),
                        'icon' => 'fa fa-close',
                    ],
                    [
                        'text' => __('Exciting Feature', 'bdevselement'),
                        'icon' => 'fa fa-check',
                    ],
                ],
                'title_field' => '<# print(text); #>',
            ]
        );

        $this->end_controls_section();

        // Price Footer
        $this->start_controls_section(
            '_section_footer',
            [
                'label' => __('Price Footer', 'bdevselement'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'bdevselement'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Subscribe', 'bdevselement'),
                'placeholder' => __('Type button text here', 'bdevselement'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'bdevselement'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_badge',
            [
                'label' => __('Badge', 'bdevselement'),
                'condition' => [
                    'design_style' => ['style_10']
                ]
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label' => __('Show', 'bdevselement'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'badge_position',
            [
                'label' => __('Position', 'bdevselement'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevselement'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevselement'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => false,
                'default' => 'left',
                'style_transfer' => true,
                'condition' => [
                    'show_badge' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => __('Badge Text', 'bdevselement'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Recommended', 'bdevselement'),
                'placeholder' => __('Type badge text', 'bdevselement'),
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls()
    {

        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => __('General', 'bdevselement'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );



        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-title,'
                    . '{{WRAPPER}} .bdevselement-pricing-table-currency,'
                    . '{{WRAPPER}} .bdevselement-pricing-table-period,'
                    . '{{WRAPPER}} .bdevselement-pricing-table-features-title,'
                    . '{{WRAPPER}} .bdevselement-pricing-table-features-list li,'
                    . '{{WRAPPER}} .bdevselement-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'price_shape_color',
            [
                'label' => __('Shape Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price__shape' => 'border-color: transparent {{VALUE}} transparent transparent;',
                ],
            ]
        );        

        $this->add_control(
            'price_border_color',
            [
                'label' => __('Border Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price__item' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_header',
            [
                'label' => __('Header', 'bdevselement'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-title',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_pricing',
            [
                'label' => __('Pricing', 'bdevselement'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_price',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Price', 'bdevselement'),
            ]
        );

        $this->add_responsive_control(
            'price_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-price-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __('Text Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-price-text',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            '_heading_currency',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Currency', 'bdevselement'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'currency_spacing',
            [
                'label' => __('Side Spacing', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'currency_color',
            [
                'label' => __('Text Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'currency_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-currency',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            '_heading_period',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Period', 'bdevselement'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'period_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label' => __('Text Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-period' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-period',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_features',
            [
                'label' => __('Features', 'bdevselement'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'features_container_spacing',
            [
                'label' => __('Container Bottom Spacing', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-body' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_heading_features_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Title', 'bdevselement'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'features_title_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-features-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_title_color',
            [
                'label' => __('Text Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-features-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_title_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-features-title',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            '_heading_features_list',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('List', 'bdevselement'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'features_list_spacing',
            [
                'label' => __('Spacing Between', 'bdevselement'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-features-list > li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_list_color',
            [
                'label' => __('Text Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-features-list > li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-features-list > li',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_footer',
            [
                'label' => __('Footer', 'bdevselement'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_button',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('Button', 'bdevselement'),
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'bdevselement'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'bdevselement'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-btn',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs('_tabs_button');

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __('Normal', 'bdevselement'),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __('Text Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __('Background Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => __('Hover', 'bdevselement'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Text Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn:hover, {{WRAPPER}} .bdevselement-pricing-table-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __('Background Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn:hover, {{WRAPPER}} .bdevselement-pricing-table-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_before_bg_color',
            [
                'label' => __( 'Hover Before BG Color', 'bdevselement' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .s-btn.transparent-btn.bdevs-el-btn:hover:before, {{WRAPPER}} .s-btn.transparent-btn.bdevs-el-btn:focus:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __('Border Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-btn:hover, {{WRAPPER}} .bdevselement-pricing-table-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_badge',
            [
                'label' => __('Badge', 'bdevselement'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label' => __('Padding', 'bdevselement'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label' => __('Text Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label' => __('Background Color', 'bdevselement'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label' => __('Border Radius', 'bdevselement'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-pricing-table-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_box_shadow',
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'label' => __('Typography', 'bdevselement'),
                'selector' => '{{WRAPPER}} .bdevselement-pricing-table-badge',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();
    }

    private static function get_currency_symbol($symbol_name)
    {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'item_title');
        $this->add_render_attribute('sub_title', 'class', 'sub_title');

        $this->add_inline_editing_attributes('price', 'basic');
        $this->add_render_attribute('price', 'class', 'pricing_text');

        $this->add_inline_editing_attributes('period', 'basic');
        $this->add_render_attribute('period', 'class', 'price-period');

        $this->add_inline_editing_attributes('features_title', 'basic');
        $this->add_render_attribute('features_title', 'class', 'price-featured mb-20');

        if ($settings['currency'] === 'custom') {
            $currency = $settings['currency_custom'];
        } else {
            $currency = self::get_currency_symbol($settings['currency']);
        }

        ?>
        <?php if ($settings['design_style'] === 'style_3'): ?>


        <div class="pricing-two-item">
            <div class="pricing-two-content">

                <?php if ($settings['title']) : ?>
                <h3 class="title bdevselement-pricing-table-title"><?php echo bdevs_element_kses_basic($settings['title']); ?></h3>
                <?php endif; ?>
                <?php if ($settings['sub_title']) : ?>
                <p><?php echo bdevs_element_kses_basic($settings['sub_title']); ?></p>
                <?php endif; ?>

                <h3 class="price bdevselement-pricing-table-period">
                    <sup><?php echo esc_html($currency); ?></sup>
                    <?php echo bdevs_element_kses_basic($settings['price']); ?>
                    <span><?php echo bdevs_element_kses_basic($settings['period_from']); ?> <br> <?php echo bdevs_element_kses_basic($settings['period']); ?></span>
                </h3>
                <?php if( !empty($settings['button_text']) ) : ?>
                <div class="pricing-btn">
                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="btn s-btn btn-link bdevselement-pricing-table-btn"><?php echo bdevs_element_kses_basic($settings['button_text']); ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php elseif ($settings['design_style'] === 'style_2'): ?>

        <div class="pricing-three-item mb-30 <?php print esc_attr($class_name); ?>">
            <div class="pricing-three-head">
                <?php if ($settings['title']) : ?>
                <h4 class="title bdevselement-pricing-table-title"><?php echo bdevs_element_kses_basic($settings['title']); ?></h4>
                <?php endif; ?>
                
                <?php if ($settings['sub_title']) : ?>
                <span class="devices-support"><?php echo bdevs_element_kses_basic($settings['sub_title']); ?></span>
                <?php endif; ?>


                <ul class="devices-icon-wrap">
                    <?php foreach( $settings['devices'] as $device ) : ?>
                    <li><?php if (!empty($device['icon_2']) || !empty($device['selected_icon_2']['value'])) :
                                    bdevs_element_render_icon($device, 'icon_2', 'selected_icon_2');
                                endif; ?>     
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php if (!empty($settings['features_switch'])) : ?>
            <div class="pricing-three-list netfix_pricing_before_disable bdevselement-pricing-table-features-list">
                <ul>
                    <?php foreach ($settings['features_list'] as $index => $feature) : ?>
                    <li><?php if (!empty($feature['icon']) || !empty($feature['selected_icon']['value'])) :
                                    bdevs_element_render_icon($feature, 'icon', 'selected_icon');
                                endif; ?><?php echo bdevs_element_kses_intermediate($feature['text']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <h2 class="pricing-three-price bdevselement-pricing-table-period">
                <?php if( !empty($settings['period_from']) ) : ?>
                <span><?php echo bdevs_element_kses_basic($settings['period_from']); ?></span>
                <?php endif; ?>
                 <?php echo esc_html($currency); ?><?php echo bdevs_element_kses_basic($settings['price']); ?>
                 <span><?php echo bdevs_element_kses_basic($settings['period']); ?></span></h2>
            <?php if( !empty($settings['button_text']) ) : ?>
            <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="btn s-btn transparent-btn bdevselement-pricing-table-btn"><?php echo bdevs_element_kses_basic($settings['button_text']); ?></a>
            <?php endif; ?>
        </div>


    <?php else:
        $class_name = $settings['active_price'] ? 'active' : '';

        $this->add_inline_editing_attributes('button_footer', 'none');
        $this->add_render_attribute('button_footer', 'class', 'price-btn');
        $this->add_link_attributes('button_footer', $settings['button_link']);
        ?>
         <div class="pricing-item mb-30 <?php print esc_attr($class_name); ?>">
             <div class="pricing-thumb">

                <?php if (!empty($settings['image']['id']) && $settings['type'] === 'image') : ?>
                    <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image'); ?>
                <?php else: ?>
                    <?php bdevs_element_render_icon($settings, 'icon', 'selected_icon'); ?>
                <?php endif; ?>

                <?php if ($settings['title']) : ?>
                 <h3 class="title bdevselement-pricing-table-title"><?php echo bdevs_element_kses_basic($settings['title']); ?></h3>
                 <?php endif; ?>
                 <div class="net-speed">
                    <?php if( !empty($settings['sub_title']) ) : ?>
                    <h5><?php echo bdevs_element_kses_basic($settings['sub_title']); ?> <span><?php echo bdevs_element_kses_basic($settings['description']); ?></span></h5>
                    <?php endif; ?>
                 </div>
             </div>
             <div class="pricing-content">
                <?php if (!empty($settings['features_switch'])) : ?>
                <ul class="pricing-list bdevselement-pricing-table-features-list">
                    <?php foreach ($settings['features_list'] as $index => $feature) : ?>
                    <li>
                        <?php if (!empty($feature['icon']) || !empty($feature['selected_icon']['value'])) :
                                    bdevs_element_render_icon($feature, 'icon', 'selected_icon');
                                endif; ?> <?php echo bdevs_element_kses_intermediate($feature['text']); ?>
                                    
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <div class="price-wrap">
                    <?php if( !empty($settings['period_from']) ) : ?>
                    <span><?php echo bdevs_element_kses_basic($settings['period_from']); ?></span>
                     <?php endif; ?>
                    <h3 class="price bdevselement-pricing-table-period"><?php echo esc_html($currency); ?><?php echo bdevs_element_kses_basic($settings['price']); ?><sub><?php echo bdevs_element_kses_basic($settings['period']); ?></sub></h3>
                </div>
                <?php if( !empty($settings['button_text']) ) : ?>
                <div class="pricing-btn">
                    <a href="<?php echo esc_url($settings['button_link']['url']); ?>" class="btn s-btn btn-link bdevselement-pricing-table-btn"><?php echo bdevs_element_kses_basic($settings['button_text']); ?></a>
                </div>
                <?php endif; ?> 
             </div>
         </div>

    <?php endif; ?>

        <?php
    }
}
