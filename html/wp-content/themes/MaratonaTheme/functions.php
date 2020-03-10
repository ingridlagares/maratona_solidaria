<?php

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
            'supports' => array( 'title', 'author'),
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
            'supports' => array( 'title', 'author'),
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
    return $template_path;
}


add_action( 'admin_init', 'doacao_admin' );
function doacao_admin() {
    add_meta_box(
    'doacao_meta_box',
    'Doação Detalhes',
    'display_doacao_meta_box',
    'doacao',
    'normal',
    'high'
    );
}

function display_doacao_meta_box( $doacao ) {
    global $post;

    $meta = get_post_meta( $post->ID, 'doacao_fields', true );?>
    <style>
        tr {
            width: 1600px;
        }
        td {
        	width: 70%;
        }
        select {
            width: 150px;
        }
        input[type="date"] {
            width: 150px;
        }
        input[type="button"] {
            width: 150px;
        }
        input[type="text"] {
            width: 600px;
        }
        .title {
            width: 50px;
        }
    </style>
    <input type="hidden" name="doacao_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

    <table>
    	        <tr>
            <td class="title">Tipo</td>
                <td><select name="doacao_fields[doacao]" id="doacao_fields[doacao]" style="width: 500px;">
                    <option value="absorvente" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'absorvente' ); } ?>>Absorvente (a cada 8 unidades)</option>
                    <option value="acucar" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'acucar' ); } ?>>Açucar ( a cada 1 kg)</option>
                    <option value="apostila" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'apostila' ); } ?>>Apostila</option>
                    <option value="arroz" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'arroz' ); } ?>>Arroz ( a cada 1 kg )</option>
                    <option value="biscoito" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'biscoito' ); } ?>>Biscoito</option>
                    <option value="brinquedo" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'brinquedo' ); } ?>>Brinquedo</option>
                    <option value="caderno" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'caderno' ); } ?>>Caderno</option>
                    <option value="cafe" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'cafe' ); } ?>>Café ( a cada 500g )</option>
                    <option value="sangue" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'sangue' ); } ?>>Doação de sangue</option>
                    <option value="escova" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'escova' ); } ?>>Escova de dente</option>
                    <option value="farinha" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'farinha' ); } ?>>Farinha  ( a cada 1kg )</option>
                    <option value="fuba" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'fuba' ); } ?>>Fubá  ( a cada 1kg )</option>
                    <option value="feijao" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'feijao' ); } ?>>Feijão ( a cada 1 kg)</option>
                    <option value="fralda_geriatrica" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'fralda_geriatrica' ); } ?>>Fralda geriátrica (a cada 8 unidades )</option>
                    <option value="fralda_infantil" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'fralda_infantil' ); } ?>>Fralda infantils</option>
                    <option value="lacre" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'lacre' ); } ?>>Garrafa pet com lacres</option>
                    <option value="escola" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'escola' ); } ?>>Kit escola (um lápis, uma caneta, uma borracha e um apontador)</option>
                    <option value="oleo" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'oleo' ); } ?>>Lata de óleo ( a cada 1L )</option>
                    <option value="livro" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'livro' ); } ?>>Livro</option>
                    <option value="macarrao" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'macarrao' ); } ?>>Macarrão</option>
                    <option value="medula" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'medula' ); } ?>>Medula (cadastro)</option>
                    <option value="papel" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'papel' ); } ?>>Papel higiênico (12 unidades)</option>
                    <option value="pasta" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'pasta' ); } ?>>Pasta dental</option>
                    <option value="racao" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'racao' ); } ?>>Ração para cães e gatos ( a cada 5kg)</option>
                    <option value="sabonete" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'sabonete' ); } ?>>Sabonete ( a cada 6 unidades)</option>
                    <option value="sal" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'sal' ); } ?>>Sal ( a cada 1kg)</option>
                    <option value="xampu" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'xampu' ); } ?>>Xampu ( a cada 500ml)</option>
                    <option value="condicionador" <?php if (is_array($meta) && isset($meta['doacao'])) { selected( $meta['doacao'], 'condicionador' ); } ?>>Condicionador ( a cada 500ml)</option>


                </select></td>

        <tr>
            <td class="title">Quantidade</td>
        <td ><input type="number" min="1" name="doacao_fields[quantidade]" value="<?php if (is_array($meta) && isset($meta['quantidade'])) {  echo $meta['quantidade']; } ?>"></td>
        </tr>

        <tr>
            <td class="title">Representante (Aluno)</td>
                <td><select name="doacao_fields[representante]" id="doacao_fields[representante]" style="width: 500px;">
             <?php
             $args = array('post_type' => 'aluno');
			 $myQuery = new WP_Query($args);
             if ($myQuery->have_posts()) :
             	while ($myQuery->have_posts()) : $myQuery->the_post();
                $post_id = get_the_ID();
                    ?>
                    <option value="<?php the_ID();?>" <?php if (is_array($meta) && isset($meta['representante'])) { selected( $meta['representante'], '<?php the_ID();?>' ); } ?>><?php the_title();?></option>
                    <?php
             	endwhile; wp_reset_postdata();
             endif;
             ?>
             </select></td>
        </tr>
		<tr>
            <td class="title">Doador (Externo)</td>
        <td><input type="text" name="doacao_fields[doador]" value="<?php if (is_array($meta) && isset($meta['doador'])) {  echo $meta['doador']; } ?>"></td>
        </tr>
                <tr>
            <td class="title">Data</td>
        <td><input type="date" name="doacao_fields[data]" value="<?php if (is_array($meta) && isset($meta['data'])) {  echo $meta['data']; } ?>"></td>
        </tr>
    </tr>
            <tr>
        <td class="title">Aprovado</td>
    <td><input type="checkbox" name="doacao_fields[aprovado]" <?php if (is_array($meta) && isset($meta['aprovado'])) {  echo "checked"; } ?>></td>
    </tr>
        <tr>
            <td class="title">Observação</td>
        <td><textarea style="width: 500px;" name="doacao_fields[observacao]" value="<?php if (is_array($meta) && isset($meta['observacao'])) {  echo $meta['observacao']; } ?>">
        </textarea></td>
        </tr>
    </table>
    <?php
}

function change_default_title( $title ){
    $screen = get_current_screen();

    // For CPT 1
    if  ( 'aluno' == $screen->post_type ) {
        $title = 'Insira o nome completo';
    }
    return $title;
}

add_filter( 'enter_title_here', 'change_default_title' );

add_action( 'save_post', 'save_doacao_fields_meta' );
function save_doacao_fields_meta( $post_id ) {
  // verify nonce
  if ( isset($_POST['doacao_meta_box_nonce'])
      && !wp_verify_nonce( $_POST['doacao_meta_box_nonce'], basename(__FILE__) ) ) {
      return $post_id;
    }
  // check autosave
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return $post_id;
  }
  // check permissions
  if (isset($_POST['post_type'])) { //Fix 2
        if ( 'page' === $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
    }

  $old = get_post_meta( $post_id, 'doacao_fields', true );
    if (isset($_POST['doacao_fields'])) { //Fix 3
      $new = $_POST['doacao_fields'];
      if ( $new && $new !== $old ) {
        update_post_meta( $post_id, 'doacao_fields', $new );
      } elseif ( '' === $new && $old ) {
        delete_post_meta( $post_id, 'doacao_fields', $old );
      }
    }
}

add_action( 'admin_init', 'aluno_admin' );
function aluno_admin() {
    add_meta_box(
    'aluno_meta_box',
    'Detalhes do aluno',
    'display_aluno_meta_box',
    'aluno',
    'normal',
    'high'
    );
}

function display_aluno_meta_box( $aluno ) {
    global $post;

    $meta = get_post_meta( $post->ID, 'aluno_fields', true );?>
    <style>
        tr {
            width: 1600px;
        }
        td {
        	width: 70%;
        }
        select {
            width: 150px;
        }
        input[type="date"] {
            width: 150px;
        }
        input[type="button"] {
            width: 150px;
        }
        input[type="text"] {
            width: 600px;
        }
        .title {
            width: 50px;
        }
    </style>
    <input type="hidden" name="aluno_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

    <table>

        <tr>
            <td class="title">Matrícula</td>
        <td ><input type="number" min="0" name="aluno_fields[matricula]" value="<?php if (is_array($meta) && isset($meta['matricula'])) {  echo $meta['matricula']; } ?>"></td>
        </tr>
            <td class="title">Curso</td>
                <td><select name="aluno_fields[equipe]" id="aluno_fields[equipe]" style="width: 500px;">
                    <option value="estatistica" <?php if (is_array($meta) && isset($meta['equipe'])) { selected( $meta['equipe'], 'estatistica' ); } ?>>Estatística</option>
                    <option value="fisica" <?php if (is_array($meta) && isset($meta['equipe'])) { selected( $meta['equipe'], 'fisica' ); } ?>>Física</option>
                    <option value="matcomp" <?php if (is_array($meta) && isset($meta['equipe'])) { selected( $meta['equipe'], 'matcomp' ); } ?>>Matemática Computacional</option>
                    <option value="mat" <?php if (is_array($meta) && isset($meta['equipe'])) { selected( $meta['equipe'], 'mat' ); } ?>>Matemática</option>
                    <option value="atuariais" <?php if (is_array($meta) && isset($meta['equipe'])) { selected( $meta['equipe'], 'atuariais' ); } ?>> Ciências Atuariais</option>
                    <option value="quimica" <?php if (is_array($meta) && isset($meta['equipe'])) { selected( $meta['equipe'], 'quimica' ); } ?>>Química</option>
                    <option value="ccsi" <?php if (is_array($meta) && isset($meta['equipe'])) { selected( $meta['equipe'], 'ccsi' ); } ?>>CC/SI</option>


                </select></td>
        </tr>



		<tr>
            <td class="title">Email</td>
        <td><input type="text" name="aluno_fields[email]" value="<?php if (is_array($meta) && isset($meta['email'])) {  echo $meta['email']; } ?>"></td>
        </tr>
                <tr>
            <td class="title">Telefone</td>
        <td><input type="number" name="aluno_fields[telefone]" value="<?php if (is_array($meta) && isset($meta['telefone'])) {  echo $meta['telefone']; } ?>"></td>
        </tr>
        <tr>
            <td class="title">Observação</td>
        <td><textarea style="width: 500px;" name="aluno_fields[observacao]">
            <?php if (is_array($meta) && isset($meta['observacao'])) {  echo $meta['observacao']; } ?>
        </textarea></td>
        </tr>
    </table>
    <?php
}

add_action( 'save_post', 'save_aluno_fields_meta' );
function save_aluno_fields_meta( $post_id) {
  // verify nonce
  if ( isset($_POST['aluno_meta_box_nonce'])
      && !wp_verify_nonce( $_POST['aluno_meta_box_nonce'], basename(__FILE__) ) ) {
      return $post_id;
    }
  // check autosave
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return $post_id;
  }
  // check permissions
  if (isset($_POST['post_type'])) { //Fix 2
        if ( 'page' === $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
    }

  $old = get_post_meta( $post_id, 'aluno_fields', true );
    if (isset($_POST['aluno_fields'])) { //Fix 3
      $new = $_POST['aluno_fields'];
      if ( $new && $new !== $old ) {
        update_post_meta( $post_id, 'aluno_fields', $new );
      } elseif ( '' === $new && $old ) {
        delete_post_meta( $post_id, 'aluno_fields', $old );
      }
    }
}

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_doacao") {

    // Do some minor form validation to make sure there is content
    if (isset ($_POST['title'])) {
        $title =  $_POST['title'];
    } else {
        echo 'Please enter a  title';
    }
    // Add the content of the form to $post as an array
    $new_post = array(
        'post_title'    => $title,
        'post_status'   => 'publish',
        'post_type' => 'doacao',
    );
    //save the new post
    $pid = wp_insert_post($new_post);
    $old = get_post_meta( $pid, 'doacao_fields', true );
    $new = $_POST['doacao_fields'];
    update_post_meta( $pid ,'doacao_fields', $new);
}

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_aluno") {

    // Do some minor form validation to make sure there is content
    if (isset ($_POST['title'])) {
        $title =  $_POST['title'];
    } else {
        echo 'Please enter a  title';
    }
    // Add the content of the form to $post as an array
    $new_post = array(
        'post_title'    => $title,
        'post_status'   => 'publish',
        'post_type' => 'aluno',
    );
    //save the new post
    $pid = wp_insert_post($new_post);
    $old = get_post_meta( $pid, 'aluno_fields', true );
    $new = $_POST['aluno_fields'];
    update_post_meta( $pid ,'aluno_fields', $new);
}

add_filter( 'manage_edit-doacao_columns', 'my_edit_doacao_columns' ) ;

function my_edit_doacao_columns( $columns ) {

	$columns = array(
		'cb' => '&lt;input type="checkbox" />',
		'title' => __( 'Doação' ),
        'author' => __( 'Equipe' ),
		'aprovado' => __( 'Aprovado' ),
		'date' => __( 'Date' )
	);

	return $columns;
}
add_action( 'manage_doacao_posts_custom_column', 'my_manage_doacao_columns', 10, 2 );

function my_manage_doacao_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'aprovado' column. */
		case 'aprovado' :

			/* Get the post meta. */
			$meta = get_post_meta( $post->ID, 'doacao_fields', true );
            $aprova = $meta['aprovado'];
			/* If no aprovado is found, output a default message. */
			if ( empty( $aprova ) )
				echo __( 'Não aprovado' );

			/* If there is a aprovado, append 'minutes' to the text string. */
			else
				printf( __( 'Aprovado'));

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}
add_filter( 'manage_edit-doacao_sortable_columns', 'my_doacao_sortable_columns' );

function my_doacao_sortable_columns( $columns ) {

	$columns['author'] = 'author';

	return $columns;
}

function clp_login_head() {

    echo '<style>'; //Begin custom styles
    echo '.login #nav a, .login #backtoblog a { color: # !important; }'; //Login page link color
    echo '.login h1 a { background:url("' . get_bloginfo('stylesheet_directory') . '/images/maratona_logo.png"); background-repeat: no-repeat; background-size: contain; width: 1200px;}'; //Login page logo
    echo '.login .button-primary { background:#; border-color:#; }'; //Login page button color
    echo '</style>'; //End custom styles
    echo '<h1>Maratona Solidária do ICEx</h1>';
$current_color = get_user_option( 'admin_color' );
$custom_logo_id = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
echo '<img src="'.$image[0].'">';
echo $current_color;
}
add_action('login_head', 'clp_login_head');

function my_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if ( in_array( 'administrator', $user->roles ) ) {
            // redirect them to the default place
            return $redirect_to;
        } else {
            $url = home_url();
            $adicionar_doacao = $url . "/incluir-doacao";
            return $adicionar_doacao;
        }
    } else {
        return home_url();
    }
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

function posts_for_current_author($query) {
    global $pagenow;

    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;

    if( !current_user_can( 'edit_others_posts' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');
function tamanho_equipe($user){
    $equipe = $user->user_login;
    $args = array(
        'numberposts'	=> -1,
        'post_type'		=> 'aluno',
    );
    $tamanho = 0;
    $the_query = new WP_Query( $args );
    if( $the_query->have_posts() ):
        while( $the_query->have_posts() ) : $the_query->the_post();
            $post_id = get_the_ID();
            $meta = get_post_meta( $post_id, 'aluno_fields', true );
            if(  $meta['equipe'] == $equipe ):
                $tamanho = $tamanho +1;
            endif;
        endwhile;
    endif;

    return $tamanho;
}
function calcular_pontuacao($user) {
    $score = 0;
    $args = array(
        'numberposts'	=> -1,
        'post_type'		=> 'doacao',
        'author'        => $user->ID
    );
    $the_query = new WP_Query( $args );
    if( $the_query->have_posts() ):
        while( $the_query->have_posts() ) : $the_query->the_post();
            $post_id = get_the_ID();
            $meta = get_post_meta( $post_id, 'doacao_fields', true );

            if( $meta['aprovado']):
                if( $meta['doacao'] == 'oleo' || $meta['doacao'] == 'papel' || $meta['doacao'] == 'escola'   ):
                    $pontos = $meta['quantidade'] * 20;
                    $score = $score + $pontos;

                elseif ($meta['doacao'] == 'farinha' || $meta['doacao'] == 'fuba' || $meta['doacao'] == 'sal' || $meta['doacao'] == 'escova' || $meta['doacao'] == 'pasta'):
                    $pontos = $meta['quantidade'] * 5;
                    $score = $score + $pontos;
                elseif ($meta['doacao'] == 'arroz' || $meta['doacao'] == 'macarrao' || $meta['doacao'] == 'acucar' || $meta['doacao'] == 'sabonete' || $meta['doacao'] == 'feijao' || $meta['doacao'] == 'xampu' || $meta['doacao'] == 'condicionador' || $meta['doacao'] == 'cafe'  || $meta['doacao'] == 'condicionador' || $meta['doacao'] == 'absorvente' ):
                    $pontos = $meta['quantidade'] * 10;
                    $score = $score + $pontos;
                elseif ($meta['doacao'] == 'biscoito'):
                    $pontos = $meta['quantidade'] * 15;
                    $score = $score + $pontos;
                elseif ($meta['doacao'] == 'caderno'):
                    $pontos = $meta['quantidade'] * 30;
                    $score = $score + $pontos;
                elseif ($meta['doacao'] == 'livro'):
                    $pontos = $meta['quantidade'] * 40;
                    $score = $score + $pontos;
                elseif ($meta['doacao'] == 'apostila'):
                    $pontos = $meta['quantidade'] * 60;
                    $score = $score + $pontos;
                elseif ($meta['doacao'] == 'fralda_geriatrica'):
                    $pontos = $meta['quantidade'] * 80;
                    $score = $score + $pontos;
                elseif ($meta['doacao'] == 'racao'):
                    $pontos = $meta['quantidade'] * 100;
                    $score = $score + $pontos;
                elseif ($meta['doacao'] == 'brinquedo' || $meta['doacao'] == 'lacre'):
                    $pontos = $meta['quantidade'] * 50;
                    $score = $score + $pontos;
                elseif ($meta['doacao'] == 'medula' || $meta['doacao'] == 'sangue'):
                    $pontos = $meta['quantidade'] * 150;
                    $score = $score + $pontos;
                elseif ($meta['doacao'] == 'fralda_infantil'):
                    $pontos = $meta['quantidade'] * 200;
                    $score = $score + $pontos;
                endif;
            endif;
        endwhile;
    endif;
    $tamanho = tamanho_equipe($user);
    if($tamanho):
        $final =  $score/$tamanho;
    else:
        $final = 0;
    endif;
    return array ( $score, $tamanho, $final, $user->user_firstname);
}
function points_compare($element1, $element2) {
    $datetime1 = $element1['pt_final'];
    $datetime2 = $element2['pt_final'];
    return $datetime1 - $datetime2;
}

function ordenar_equipes($equipes) {
    usort($equipes, 'points_compare');
    return array_reverse($equipes);
}

?>
