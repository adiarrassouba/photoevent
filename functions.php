<?php
function register_my_menu(){
     register_nav_menus( array(
    'main' => 'Menu principal',
    'footer' => 'Footer Menu',
) );
 }
 add_action('after_setup_theme', 'register_my_menu');

 add_action( 'wp_enqueue_scripts', 'theme_enqueue_script' );
 function theme_enqueue_script() {
    wp_register_script( 'jQuery', 'https://code.jquery.com/jquery-3.7.1.min.js', null, null, true );
     wp_register_script( 'script-js', get_stylesheet_directory_uri() . '/script.js', null, null, true);
     wp_register_script( 'pagination-js', get_stylesheet_directory_uri() . '/pagination.js', null, null, true);

     wp_enqueue_script('jQuery');
     wp_enqueue_script('script-js');
     wp_enqueue_script('pagination-js');
 }

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css' ); 
}

function show_gallery($my_query)
{
    if ($my_query->have_posts()){
        while ($my_query->have_posts()){
            $my_query->the_post(); // This is where the post's data is set up
            get_template_part( 'template_parts/photo_block' );
        }
    } 
}

// REQUÊTE AJAX POUR CHARGER PLUS DE CONTENU SUR LA PAGE D'ACCUEIL avec le parametre $paged
//les autres parametres sont les filtres


function filter_photos()
{
    // On récupère avec les parametres avec la méthode POST, 
    $paged = $_POST['paged'];
    $format = $_POST['format'];
    $category = $_POST['category'];
    $sortDate = $_POST['sortDate'];
    
    // on récupère les publications de type "photo"
    $ajaxposts = new WP_Query([
        'post_type' => 'photo',
        'orderby' => 'date',
        'order' => $sortDate,
        'posts_per_page' => 12,
        'paged' => $paged,
        'tax_query' => array(
            array(
                'relation' => 'AND',
                $category != "all" ?
                    array(
                        'taxonomy' => 'categorie', // as in CPT UI
                        'field' => 'slug',
                        'terms' => $category,
                    )
                    : '',
                    $format != "all" ?
                    array(
                        'taxonomy' => 'format', // as in CPT UI
                        'field' => 'slug',
                        'terms' =>$format,
                    )
                    : '',
            ),
        ),
    ]);

    $response = ''; // on initialise la variable qu'on utilisera pour stocker le code HTML des images

    if ($ajaxposts->have_posts()) {
        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
            $response .=  get_template_part( 'template_parts/photo_block' );
        endwhile;
    } else {
        $response = '';
    }

    echo $response; // on affiche le contenu récupéré
    exit;
}
add_action('wp_ajax_filter_photos', 'filter_photos'); // utilisateur connecté
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos'); // utilisateur anonyme
   
 