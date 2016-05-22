<?php

// Initialisation du thème
function theme_shaky_setup() {
    
    // Supports wordpress
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
    $defaults = array(
        'default-image' => get_stylesheet_directory_uri() . '/img/logo-theo.png',
    );
    add_theme_support( 'custom-header', $defaults );
    
    //Menus
	register_nav_menus(array(
		'header' => __('Header', 'shaky'),
	));
    
    // Image size
    add_image_size('full-screen', 1920, NULL, false);
    add_image_size('logo-full', 1200, NULL, false);
    add_image_size('logo-header', 300, NULL, false);
    add_image_size('bloc-accueil', 1000, 700, true);
    add_image_size('galerie', 760, 380, true);
    add_image_size('slider', 1920, 300, true);
    add_image_size('slider-full', 1920, NULL, false);
    
    // Feuille de style pour l'éditeur du back-office
    add_editor_style('css/editor-style.css');
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,700,700italic,900,900italic,500,500italic' );
    add_editor_style( $font_url );

    remove_action('wp_head', 'wp_generator');
}
add_action('after_setup_theme', 'theme_shaky_setup');

function wpa_45815($arr){
    $arr['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4';
    return $arr;
  }
add_filter('tiny_mce_before_init', 'wpa_45815');

// Suppression de la version par défaut de jquery de wordpress chargée dans le header
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );
function remove_jquery_migrate( &$scripts)
{
    if(!is_admin())
    {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.11.1' );
    }
}
function jquery_cdn() {
   if (!is_admin()) {
      wp_deregister_script('jquery');
      wp_register_script('jquery', '', false, '1.8.3');
      wp_enqueue_script('jquery');
   }
}
add_action('init', 'jquery_cdn');

// Chargement des styles, scripts et fonts dans le front du thème
function theme_shaky_scripts_styles() {
    
    // Fonts google
    $args_google = array(
		'family' => 'Roboto:400,300,300italic,400italic,700,700italic,900,900italic,500,500italic',
		'subset' => 'latin,latin-ext',
	);
	wp_register_style('google_fonts', add_query_arg( $args_google, "https://fonts.googleapis.com/css" ), array(), null);
    wp_enqueue_style('google_fonts');
    
    // Styles
    wp_register_style('pure', 'http://yui.yahooapis.com/pure/0.6.0/pure-min.css');
    wp_enqueue_style('pure');
    wp_register_style('swiper', get_stylesheet_directory_uri().'/css/swiper.min.css');
    wp_enqueue_style('swiper');
	wp_register_style('style', get_stylesheet_directory_uri().'/css/style.min.css');
    wp_enqueue_style('style');
    
    // Scripts dans le footer
    wp_enqueue_script('jquery1','https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js',array(),false,false);
    wp_enqueue_script('others-js', get_stylesheet_directory_uri().'/js/others.min.js','',false,true);
    wp_enqueue_script('main-js', get_stylesheet_directory_uri().'/js/main.js','',false,true);
}
add_action('wp_enqueue_scripts', 'theme_shaky_scripts_styles');

/* ACF Options Page : Options pour la page d'accueil */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title'    => 'Shaky Prod',
		'menu_title'    => 'Shaky Prod',
		'menu_slug'     => 'options-generales',
		'capability'    => 'edit_posts',
		'redirect'      => true
	));
	acf_add_options_sub_page(array(
		'page_title'    => 'Logo',
		'menu_title'    => 'Logo',
		'parent_slug'   => 'options-generales',
	));
	acf_add_options_sub_page(array(
		'page_title'    => 'Page d\'accueil',
		'menu_title'    => 'Page d\'accueil',
		'parent_slug'   => 'options-generales',
	));
	acf_add_options_sub_page(array(
		'page_title'    => 'Footer',
		'menu_title'    => 'Footer',
		'parent_slug'   => 'options-generales',
	));
  acf_add_options_sub_page(array(
    'page_title'    => '404',
    'menu_title'    => '404',
    'parent_slug'   => 'options-generales',
  ));
}
/* ------------------------------------------------- */

function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

// Register Custom Taxonomy
function custom_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Types', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Types', 'text_domain' ),
    'all_items'                  => __( 'Tous les types', 'text_domain' ),
  );
  $rewrite = array(
    'slug'                       => 'realisations/type',
    'with_front'                 => true
  );
  $args = array(
    'labels'                     => $labels,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
    'query_var'                  => true,
    'rewrite'                    => $rewrite,
  );
  register_taxonomy( 'type', array( 'realisation' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );
// Register Custom Post Type
function custom_post_type() {

  $labels = array(
    'name'                  => _x( 'Réalisations', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Réalisation', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Réalisations', 'text_domain' ),
    'name_admin_bar'        => __( 'Réalisation', 'text_domain' ),
    'archives'              => __( 'Archives des réalisations', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent de la réalisation', 'text_domain' ),
    'all_items'             => __( 'Toutes les réalisations', 'text_domain' ),
    'add_new_item'          => __( 'Ajouter une nouvelle réalisation', 'text_domain' ),
    'add_new'               => __( 'Ajouter une nouvelle réalisation', 'text_domain' ),
    'new_item'              => __( 'Nouvelle réalisation', 'text_domain' ),
    'edit_item'             => __( 'Modifier la réalisation', 'text_domain' ),
    'update_item'           => __( 'Mettre à jour la réalisation', 'text_domain' ),
    'view_item'             => __( 'Voir la réalisation', 'text_domain' ),
    'search_items'          => __( 'Rechercher une réalisation', 'text_domain' ),
    'not_found'             => __( 'Pas de réalisation trouvée', 'text_domain' ),
    'not_found_in_trash'    => __( 'Pas de réalisation trouvée dans la corbeille', 'text_domain' ),
  );
  $rewrite = array(
    'slug'                       => 'realisations',
    'with_front'                 => true
  );
  $args = array(
    'label'                 => __( 'Réalisation', 'text_domain' ),
    'description'           => __( 'Les différentes réalisations de Shaky Prod', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title','editor' ),
    'taxonomies'            => array( 'type', ),
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => 'realisations',    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
    'rewrite'               => $rewrite,
  );
  register_post_type( 'realisation', $args );
  $labels = array(
    'name'                  => _x( 'Actualités', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Actualité', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Actualités', 'text_domain' ),
    'name_admin_bar'        => __( 'Actualité', 'text_domain' ),
    'archives'              => __( 'Archives des actualités', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent de l\'actualité', 'text_domain' ),
    'all_items'             => __( 'Toutes les actualités', 'text_domain' ),
    'add_new_item'          => __( 'Ajouter une nouvelle actualité', 'text_domain' ),
    'add_new'               => __( 'Ajouter une nouvelle actualité', 'text_domain' ),
    'new_item'              => __( 'Nouvelle actualité', 'text_domain' ),
    'edit_item'             => __( 'Modifier l\'actualité', 'text_domain' ),
    'update_item'           => __( 'Mettre à jour l\'actualité', 'text_domain' ),
    'view_item'             => __( 'Voir l\'actualité', 'text_domain' ),
    'search_items'          => __( 'Rechercher une actualité', 'text_domain' ),
    'not_found'             => __( 'Pas d\'actualité trouvée', 'text_domain' ),
    'not_found_in_trash'    => __( 'Pas dl\'actualité trouvée dans la corbeille', 'text_domain' ),
  );
  $rewrite = array(
    'slug'                       => 'actualites',
    'with_front'                 => true
  );
  $args = array(
    'label'                 => __( 'Actualité', 'text_domain' ),
    'description'           => __( 'Les actualités de Shaky Prod', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title','editor' ),
    'taxonomies'            => array( '', ),
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => 'actualites',    
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
    'rewrite'               => $rewrite,
  );
  register_post_type( 'actualite', $args );
}
add_action( 'init', 'custom_post_type', 0 );

function my_rewrite_flush() {
    custom_post_type();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_rewrite_flush' );

if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}
if (!class_exists("Custom_Post_Type_Archive_Menu_Links")) :
class Custom_Post_Type_Archive_Menu_Links {
  /* boot'er up */
  function init(){
    // Set-up Action and Filter Hooks
    add_action( 'admin_head-nav-menus.php', array(__CLASS__,'inject_cpt_archives_menu_meta_box' ));
    add_filter( 'wp_get_nav_menu_items', array(__CLASS__,'cpt_archive_menu_filter'), 10, 3 );
  }
  
  /* inject cpt archives meta box */
  
  function inject_cpt_archives_menu_meta_box() {
    add_meta_box( 'add-cpt', __( 'CPT Archives', 'default' ), array(__CLASS__,'wp_nav_menu_cpt_archives_meta_box'), 'nav-menus', 'side', 'default' );
  }
  /* render custom post type archives meta box */
  function wp_nav_menu_cpt_archives_meta_box() {
    /* get custom post types with archive support */
    $post_types = get_post_types( array( 'show_in_nav_menus' => true, 'has_archive' => true ), 'object' );
    /* hydrate the necessary object properties for the walker */
    foreach ( $post_types as &$post_type ) {
        $post_type->classes = array();
        $post_type->type = $post_type->name;
        $post_type->object_id = $post_type->name;
        $post_type->title = $post_type->labels->name . ' ' . __( 'Archive', 'default' );
        $post_type->object = 'cpt-archive';
    }
    $walker = new Walker_Nav_Menu_Checklist( array() );
    ?>
    <div id="cpt-archive" class="posttypediv">
      <div id="tabs-panel-cpt-archive" class="tabs-panel tabs-panel-active">
        <ul id="ctp-archive-checklist" class="categorychecklist form-no-clear">
          <?php
            echo walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', $post_types), 0, (object) array( 'walker' => $walker) );
          ?>
        </ul>
      </div><!-- /.tabs-panel -->
    </div>
    <p class="button-controls">
      <span class="add-to-menu">
        <img class="waiting" src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" alt="" />
        <input type="submit"<?php disabled( $nav_menu_selected_id, 0 ); ?> class="button-secondary submit-add-to-menu" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-ctp-archive-menu-item" id="submit-cpt-archive" />
      </span>
    </p>
    <?php
  }
  /* take care of the urls */
  function cpt_archive_menu_filter( $items, $menu, $args ) {
    /* alter the URL for cpt-archive objects */
    foreach ( $items as &$item ) {
      if ( $item->object != 'cpt-archive' ) continue;
      $item->url = get_post_type_archive_link( $item->type );
      
      /* set current */
      if ( get_query_var( 'post_type' ) == $item->type ) {
        $item->classes []= 'current-menu-item';
        $item->current = true;
      }
    }
    return $items;
  }
} // end class
endif;
/**
* Launch the whole plugin
*/
if (class_exists("Custom_Post_Type_Archive_Menu_Links")) Custom_Post_Type_Archive_Menu_Links::init(); 