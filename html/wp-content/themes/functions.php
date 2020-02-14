<?php

//Enqueue scripts and styles

function Theme_scripts() {
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.4.0' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6' );
        wp_enqueue_style( 'css', get_template_directory_uri() . '/css/css', array());


	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
	wp_enqueue_script( 'js_46QBRjOrLIduAQd9upw-iO4T4u7vpinqR0n03aoa-d0', get_template_directory_uri() . '/js/js_46QBRjOrLIduAQd9upw-iO4T4u7vpinqR0n03aoa-d0.js', array( 'jquery' ));


}

add_action( 'wp_enqueue_scripts', 'Theme_scripts' );

function Theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );

}

add_action( 'after_setup_theme', 'Theme_setup' );

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'another-menu' => __( 'Another Menu' ),
      'an-extra-menu' => __( 'An Extra Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

function set_container_class($args) {
    $args['container_class'] = str_replace('','-',$args['theme_location']).'-nav';
    return $args;
}
add_filter('wp_nav_menu_args', 'set_container_class');

// Custom settings
function custom_settings_add_menu() {
	add_menu_page( 'Custom Settings', 'Custom Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99 );
}
add_action( 'admin_menu', 'custom_settings_add_menu' );

// Create Custom Global Settings
function custom_settings_page() { ?>
	<div class="wrap">
		<h1>Custom Settings</h1>
		<form method="post" action="options.php">
				<?php
						settings_fields( 'section' );
						do_settings_sections( 'theme-options' );
						submit_button();
				?>
		</form>
	</div>
<?php }
// Twitter
function setting_twitter() { ?>
	<input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php }

function setting_github() { ?>
	<input type="text" name="github" id="github" value="<?php echo get_option('github'); ?>" />
<?php }

function setting_facebook() { ?>
	<input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
<?php }

function custom_settings_page_setup() {
	add_settings_section( 'section', 'All Settings', null, 'theme-options' );
	add_settings_field( 'twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section' );
        add_settings_field( 'github', 'GitHub URL', 'setting_github', 'theme-options', 'section' );
        add_settings_field( 'facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section' );

	register_setting('section', 'twitter');
        register_setting('section', 'github');
        register_setting('section', 'facebook');
}
add_action( 'admin_init', 'custom_settings_page_setup' );

add_action( 'init', 'create_posts' );
function create_posts() {
  register_post_type( 'doacao',
        array(
            'labels' => array(
                'name' => 'Doações',
                'singular_name' => 'Doação',
                'add_new' => 'Adicionar Nova',
                'add_new_item' => 'Adicionar Nova Doação',
                'edit' => 'Editar',
                'edit_item' => 'Editar Doação',
                'new_item' => 'Nova Doação Review',
                'view' => 'Visualizar',
                'view_item' => 'Visualizar Doação',
                'search_items' => 'Procurar Doação',
                'not_found' => 'Nenhuma Doação encontrado',
                'not_found_in_trash' => 'Nenhuma Doação encontrado na lixeira',
                'parent' => 'Parent Doação'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title',),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-heart',
            'has_archive' => true
        )
    );

  register_post_type( 'aluno',
        array(
            'labels' => array(
                'name' => 'Alunos',
                'singular_name' => 'Aluno',
                'add_new' => 'Adicionar Nova',
                'add_new_item' => 'Adicionar Nova Aluno',
                'edit' => 'Editar',
                'edit_item' => 'Editar Aluno',
                'new_item' => 'Nova Aluno Review',
                'view' => 'Visualizar',
                'view_item' => 'Visualizar Aluno',
                'search_items' => 'Procurar Aluno',
                'not_found' => 'Nenhuma Aluno encontrado',
                'not_found_in_trash' => 'Nenhuma Aluno encontrado na lixeira',
                'parent' => 'Parent Aluno'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title',),
            'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-universal-access',
            'has_archive' => true
        )
    );
}

add_filter( 'template_include', 'include_template_function', 1 );
function include_template_function( $template_path ) {
    if ( get_post_type() == 'aluno' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-aluno.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-aluno.php';
            }
        }
    }
    if ( get_post_type() == 'doacao' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-doacao.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-doacao.php';
            }
        }
    }

}
?>