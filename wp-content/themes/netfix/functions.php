<?php

/**
 * netfix functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package netfix
 */

if ( !function_exists( 'netfix_setup' ) ):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function netfix_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on netfix, use a find and replace
         * to change 'netfix' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'netfix', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( [
            'main-menu' => esc_html__( 'Main Menu', 'netfix' ),
            'category-menu' => esc_html__( 'Category Menu', 'netfix' ),
            'header-search-menu' => esc_html__( 'Search Menu', 'netfix' ),
        ] );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ] );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'netfix_custom_background_args', [
            'default-color' => 'ffffff',
            'default-image' => '',
        ] ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        //Enable custom header
        add_theme_support( 'custom-header' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', [
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ] );

        /**
         * Enable suporrt for Post Formats
         *
         * see: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', [
            'image',
            'audio',
            'video',
            'gallery',
            'quote',
        ] );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        // enable woocommerce
        add_theme_support('woocommerce');


        remove_theme_support( 'widgets-block-editor' );

        add_image_size( 'netfix-case-details', 1170, 600, [ 'center', 'center' ] );
        add_image_size( 'netfix-post-thumb', 500, 350, [ 'center', 'center' ] );
        add_image_size( 'netfix-case-thumb', 700, 544, [ 'center', 'center' ] );
    }
endif;
add_action( 'after_setup_theme', 'netfix_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function netfix_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'netfix_content_width', 640 );
}
add_action( 'after_setup_theme', 'netfix_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function netfix_widgets_init() {

    $footer_style_2_switch = get_theme_mod( 'footer_style_2_switch', true );
    $footer_style_3_switch = get_theme_mod( 'footer_style_3_switch', false );

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'netfix' ),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="sidebar-widget-title">',
        'after_title'   => '</h4>',
    ] );

    register_sidebar( [
        'name'          => esc_html__( 'Product Sidebar', 'netfix' ),
        'id'            => 'product-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="sidebar-widget-title">',
        'after_title'   => '</h4>',
    ] );

    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );


    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'netfix' ), $num ),
            'id'            => 'footer-' . $num,
            'before_widget' => '<div id="%1$s" class="footer-widget footer-col-'.$num.' mb-50 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="fw-title"><h4 class="title">',
            'after_title'   => '</h4></div>',
        ] );
    }
   
    // footer 2
    if ( $footer_style_2_switch ) {
        for( $num=1; $num <= $footer_widgets; $num++ ) {
            register_sidebar( array(
                'name'          => esc_html__( 'Footer Style 2: '. $num, 'netfix'),
                'id'            => 'footer-2-'. $num,
                'before_widget' => '<div id="%1$s" class="footer-widget footer-col-2-'.$num.' %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="fw-title"><h4 class="title">',
                'after_title'   => '</h4></div>',
            ) );            
        }
    }

    /**
     * Service Widget
     */
    register_sidebar(
        [
            'name'          => esc_html__( 'Service Sidebar', 'netfix' ),
            'id'            => 'services-sidebar',
            'description'   => esc_html__( 'Widgets in this area will be shown on Service Details Sidebar.', 'netfix' ),
            'before_widget' => '<div class="services__widget grey-bg-20 mb-40 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="services__widget-title"><h4>',
            'after_title'   => '</h4></div>',
        ]
    );

    /**
     * Portfolio Widget
     */
    register_sidebar(
        [
            'name'          => esc_html__( 'Portfolio Sidebar', 'netfix' ),
            'id'            => 'portfolio-sidebar',
            'description'   => esc_html__( 'Widgets in this area will be shown on Portfolio Details Sidebar.', 'netfix' ),
            'before_title'  => '<div class="widget-title-box mb-30"><h3 class="widget-title">',
            'after_title'   => '</h3></div>',
            'before_widget' => '<div class="service-widget sidebar-wrap widget mb-50 %2$s">',
            'after_widget'  => '</div>',
        ]
    );
}
add_action( 'widgets_init', 'netfix_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

define( 'NETFIX_THEME_DIR', get_template_directory() );
define( 'NETFIX_THEME_URI', get_template_directory_uri() );
define( 'NETFIX_THEME_CSS_DIR', NETFIX_THEME_URI . '/assets/css/' );
define( 'NETFIX_THEME_JS_DIR', NETFIX_THEME_URI . '/assets/js/' );
define( 'NETFIX_THEME_INC', NETFIX_THEME_DIR . '/inc/' );

/**
 * netfix_scripts description
 * @return [type] [description]
 */
function netfix_scripts() {

    /**
     * all css files
     */

    wp_enqueue_style( 'netfix-fonts', netfix_fonts_url(), [], null );

     if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', NETFIX_THEME_CSS_DIR.'bootstrap.rtl.min.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', NETFIX_THEME_CSS_DIR . 'bootstrap.min.css', [] );
    }

    
    wp_enqueue_style( 'animate', NETFIX_THEME_CSS_DIR . 'animate.min.css', [] );
    wp_enqueue_style( 'flaticon', NETFIX_THEME_CSS_DIR . 'flaticon.css', [] );
    wp_enqueue_style( 'fontawesome-all', NETFIX_THEME_CSS_DIR . 'fontawesome-all.min.css', [] );
    wp_enqueue_style( 'jquery-flipster', NETFIX_THEME_CSS_DIR . 'jquery.flipster.css', [] );
    wp_enqueue_style( 'jquery-ui', NETFIX_THEME_CSS_DIR . 'jquery-ui.css', [] );
    wp_enqueue_style( 'magnific-popup', NETFIX_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'nice-select', NETFIX_THEME_CSS_DIR .'nice-select.css', array() );
    wp_enqueue_style( 'odometer', NETFIX_THEME_CSS_DIR . 'odometer.css', [] );
    wp_enqueue_style( 'owl-carousel', NETFIX_THEME_CSS_DIR . 'owl.carousel.min.css', [] );
    wp_enqueue_style( 'slick', NETFIX_THEME_CSS_DIR . 'slick.css', [] );
    wp_enqueue_style( 'netfix-shop', NETFIX_THEME_CSS_DIR . 'netfix-shop.css', [] );
    wp_enqueue_style( 'netfix-default', NETFIX_THEME_CSS_DIR . 'netfix-default.css', [] );
    wp_enqueue_style( 'netfix-core', NETFIX_THEME_CSS_DIR . 'netfix-core.css', [] );
    wp_enqueue_style( 'netfix-unit', NETFIX_THEME_CSS_DIR . 'netfix-unit.css', [] );
    wp_enqueue_style( 'netfix-custom', NETFIX_THEME_CSS_DIR . 'netfix-custom.css', [] );
    wp_enqueue_style( 'netfix-style', get_stylesheet_uri() );
    wp_enqueue_style( 'netfix-responsive', NETFIX_THEME_CSS_DIR . 'responsive.css', [] );

    // all js
    wp_enqueue_script( 'bootstrap', NETFIX_THEME_JS_DIR . 'bootstrap.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jarallax', NETFIX_THEME_JS_DIR . 'jarallax.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-appear', NETFIX_THEME_JS_DIR . 'jquery.appear.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-nice-select', NETFIX_THEME_JS_DIR . 'jquery.nice-select.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-flipster', NETFIX_THEME_JS_DIR . 'jquery.flipster.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-magnific-popup', NETFIX_THEME_JS_DIR . 'jquery.magnific-popup.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-odometer', NETFIX_THEME_JS_DIR . 'jquery.odometer.min.js', [ 'jquery-ui-core' ], false, true );
    wp_enqueue_script( 'owl-carousel', NETFIX_THEME_JS_DIR . 'owl.carousel.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'slick', NETFIX_THEME_JS_DIR . 'slick.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'wow', NETFIX_THEME_JS_DIR . 'wow.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'netfix-main', NETFIX_THEME_JS_DIR . 'main.js', [ 'jquery' ], false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

}
add_action( 'wp_enqueue_scripts', 'netfix_scripts' );

/*
Register Fonts
 */
function netfix_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'netfix' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap';   
    }
    return $font_url;
}

// wp_body_open
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * Implement the Custom Header feature.
 */
require NETFIX_THEME_INC . 'custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require NETFIX_THEME_INC . 'template-functions.php';

/**
 * Custom template helper function for this theme.
 */
require NETFIX_THEME_INC . 'template-helper.php';

/**
 * initialize kirki customizer class.
 */
include_once NETFIX_THEME_INC . 'kirki-customizer.php';
include_once NETFIX_THEME_INC . 'class-netfix-kirki.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require NETFIX_THEME_INC . 'jetpack.php';
}


// Woo Check
if (!defined('NETFIX_WOOCOMMERCE_ACTIVED')) {
    define('NETFIX_WOOCOMMERCE_ACTIVED', in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))));
}

define('NETFIX_WISHLIST_ACTIVED', in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins'))));

define('NETFIX_QUICK_VIEW_ACTIVED', in_array('yith-woocommerce-quick-view/init.php', apply_filters('active_plugins', get_option('active_plugins'))));

if (NETFIX_WOOCOMMERCE_ACTIVED) {
    require_once NETFIX_THEME_INC . 'netfix-woocommerce.php';
}

/**
 * include netfix functions file
 */
require_once NETFIX_THEME_INC . 'class-breadcrumb.php';
require_once NETFIX_THEME_INC . 'class-navwalker.php';
require_once NETFIX_THEME_INC . 'class-tgm-plugin-activation.php';
require_once NETFIX_THEME_INC . 'add_plugin.php';

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function netfix_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'netfix_pingback_header' );

/**
 *
 * comment section
 *
 */
add_filter( 'comment_form_default_fields', 'netfix_comment_form_default_fields_func' );

function netfix_comment_form_default_fields_func( $default ) {

    $default['author'] = '<div class="row">
    <div class="col-xl-6 col-md-6">
    	<div class="post-input">
        	<input type="text" name="author" placeholder="' . esc_attr__( 'Your Name', 'netfix' ) . '">
        </div>
    </div>';
    $default['email'] = '<div class="col-xl-6 col-md-6">
		<div class="post-input">
        <input type="text" name="email" placeholder="' . esc_attr__( 'Your Email', 'netfix' ) . '">
    	</div>
    </div>';
    // $default['url'] = '';
    $defaults['comment_field'] = '';

    $default['url'] = '<div class="col-xl-12">
		<div class="post-input">
        <input type="text" name="url" placeholder="' . esc_attr__( 'Website', 'netfix' ) . '">
    	</div>
    </div>';
    return $default;
}

add_action( 'comment_form_top', 'netfix_add_comments_textarea' );
function netfix_add_comments_textarea() {
    if ( !is_user_logged_in() ) {
        echo '<div class="row"><div class="col-xl-12"><div class="post-input"><textarea id="comment" name="comment" cols="60" rows="6" placeholder="' . esc_attr__( 'Write your comment here...', 'netfix' ) . '" aria-required="true"></textarea></div></div></div>';
    }
}

add_filter( 'comment_form_defaults', 'netfix_comment_form_defaults_func' );

function netfix_comment_form_defaults_func( $info ) {
    if ( !is_user_logged_in() ) {
        $info['comment_field'] = '';
        $info['submit_field'] = '%1$s %2$s</div>';
    } else {
        $info['comment_field'] = '<div class="post-input"><textarea id="comment" name="comment" cols="30" rows="10" placeholder="' . esc_attr__( 'Comment *', 'netfix' ) . '"></textarea>';
        $info['submit_field'] = '%1$s %2$s</div>';
    }

    $info['submit_button'] = '<div class="col-xl-12"><button class="btn c-border-btn" type="submit">' . esc_html__( 'Post Comment', 'netfix' ) . ' </button></div>';

    $info['title_reply_before'] = '<div class="post-comments-title">
                                        <h2>';
    $info['title_reply_after'] = '</h2></div>';
    $info['comment_notes_before'] = '';

    return $info;
}

if ( !function_exists( 'netfix_comment' ) ) {
    function netfix_comment( $comment, $args, $depth ) {
        $GLOBAL['comment'] = $comment;
        extract( $args, EXTR_SKIP );
        $args['reply_text'] = 'Reply <i class="fal fa-reply"></i>';
        $replayClass = 'comment-depth-' . esc_attr( $depth );
        ?>
			<li id="comment-<?php comment_ID();?>">
				<div class="comments-box">
					<div class="comments-avatar">
						<?php print get_avatar( $comment, 102, null, null, [ 'class' => [] ] );?>
					</div>
					<div class="comments-text">
						<div class="avatar-name">
							<h5><?php print get_comment_author_link();?></h5>
							<span><?php comment_time( get_option( 'date_format' ) );?></span>
						</div>
						<?php comment_text();?>
						<?php comment_reply_link( array_merge( $args, [ 'depth' => $depth, 'max_depth' => $args['max_depth'] ] ) );?>
					</div>
				</div>
		<?php
}
}

/**
 * shortcode supports for removing extra p, spance etc
 *
 */
add_filter( 'the_content', 'netfix_shortcode_extra_content_remove' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function netfix_shortcode_extra_content_remove( $content ) {

    $array = [
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
    ];
    return strtr( $content, $array );

}

// netfix_search_filter_form
if ( !function_exists( 'netfix_search_filter_form' ) ) {
    function netfix_search_filter_form( $form ) {

        $form = sprintf(
            '<div class="sidebar__widget-px"><div class="search-px"><form class="sidebar-search-form" action="%s" method="get">
      	<input type="text" value="%s" required name="s" placeholder="%s">
      	<button type="submit"> <i class="far fa-search"></i>  </button>
		</form></div></div>',
            esc_url( home_url( '/' ) ),
            esc_attr( get_search_query() ),
            esc_html__( 'Search', 'netfix' )
        );

        return $form;
    }
    add_filter( 'get_search_form', 'netfix_search_filter_form' );
}

add_action( 'admin_enqueue_scripts', 'netfix_admin_custom_scripts' );

function netfix_admin_custom_scripts() {
    wp_enqueue_media();
    wp_register_script( 'netfix-admin-custom', get_template_directory_uri() . '/inc/js/admin_custom.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'netfix-admin-custom' );
}