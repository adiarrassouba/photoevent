

<?php
/**
 * The template for displaying all single posts
 */
?>

<?php get_header(); ?>

<?php
/* Start the Loop - PHOTO */
while ( have_posts() ) :
	the_post();
?>
<div>
    <ul class="info-pic">
        <div class="info part">

		
      <li>
                <h2 class="title-pic"> <?php echo the_title(); ?></h2>
            </li>
            <li>
                <p class="info-margin ref">RÉFÉRENCE : <span id="reference"><?php echo get_field('référence'); ?></span>
                </p>
            </li>
            <li>
                <p class="info-margin">CATÉGORIE : <?php echo get_the_terms(get_the_ID(), 'categorie')[0]->name; ?></p>
            </li>

            <li>
                <p class="info-margin">FORMAT : <?php echo get_the_terms(get_the_ID(), 'format') [0]->name; ?></p>
            </li>
            <li>
                <p class="info-margin">TYPE : <?php echo get_field('type'); ?></p>
            </li>
            <li>
                <p class="info-margin year">ANNÉE : <?php echo get_the_date('Y'); ?></p>
            </li>
        </div>
		<div class="gallery-img-single part pic-container">
		<img class="" src="<?php echo get_field('url-photo'); ?>" />
        </div>
        
    </ul>
</div>

<?php
endwhile; // End of the loop.
?>

<?php 

$previousPhoto = get_previous_post();
$nextPhoto = get_next_post();
?>

<?php get_template_part( 'template_parts/modal' ); ?>

<div class="is-interested">
    <div class="is-interested-text-button">
        <p class="is-interested-text">Cette photo vous intéresse ?</p>
        <button class="button modal-js">Contact</button>
    </div>

	<div class="is-interested-slider">
        <div class="is-interested-arrows">
            <?php if (!empty($previousPhoto)) {
				$urlPreviousPhoto = get_field('url-photo', $previousPhoto->ID);
				$previousPhotoLink = get_permalink($previousPhoto); ?>
            <a href="<?php echo $previousPhotoLink; ?>">
                <img class="arrow arrow_left"
                    src="<?php echo get_template_directory_uri(); ?>./photos/flechegauche.png"
                    alt="Flèche vers la gauche" />
            </a>
            <?php } else { ?>
            <img style="opacity:0; cursor: auto;"
                src="<?php echo get_template_directory_uri(); ?>./photos/flechegauche.png"
                alt="Flèche vers la gauche" />
            <?php }
			if (!empty($nextPhoto)) {
				$urlNextPhoto = get_field('url-photo', $nextPhoto->ID);
				$nextPhotoLink = get_permalink($nextPhoto); ?>
            <a href="<?php echo $nextPhotoLink; ?>">
                <img class="arrow arrow_right"
                    src="<?php echo get_template_directory_uri(); ?>./photos/flechedroite.png"
                    alt="Flèche vers la droite" />
            </a>
            <?php } else { ?>
            <img style="opacity:0; cursor: auto;"
                src="<?php echo get_template_directory_uri(); ?>./photos/flechedroite.png"
                alt="Flèche vers la droite" />
            <?php } ?>
        </div>
		<div class="img-container">
                <?php
                $urlNextPhoto = ''; 
                if(!empty($nextPhoto)) {$urlNextPhoto = get_field('url-photo', $nextPhoto->ID);}
                
                $urlPreviousPhoto = '';
                if(!empty($previousPhoto)) {$urlPreviousPhoto = get_field('url-photo', $previousPhoto->ID);}

				if (isset($urlPreviousPhoto ) && !empty($urlPreviousPhoto )) {
					// Afficher l'image précédente
					echo '<img class="previous-img" src="' .  $urlPreviousPhoto . '" alt="afficher la photo précédente" />';
				}
				?>
                <?php
				
				if (isset($urlNextPhoto) && !empty($urlNextPhoto)) {
					// Afficher l'image suivante seulement si image precedente n'existe pas (une seule image à la fois)
					if (isset($urlPreviousPhoto ) && !empty($urlPreviousPhoto )) {
						echo '<img style="display:none" class= "next-img" src="' .  $urlNextPhoto. '" alt="afficher la photo suivante" />';
					} else {
					echo '<img class= "next-img" src="' .  $urlNextPhoto. '" alt="afficher la photo suivante" />';
				}
				}
				?>
		</div>	

	</div>  
</div>


 <!-- photo apparentée -->
 
<div class="gallery">
    <h3 class="you-may-also-like">VOUS AIMEREZ AUSSI</h3>
    <div class="gallery-container">

        <?php
        $category = strip_tags(get_the_term_list($post->ID, 'categorie'));
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $morePics = new WP_Query(array(
            'post_type' => 'photo',
            'post__not_in' => array(get_the_ID()),
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 2,
            'paged' => $paged,
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $category,
                ),
            ),

        ));

        $countPictures = $morePics->post_count;
            if ($countPictures > 0) {
                show_gallery($morePics);
            } else {
                echo '<p>Il n\'y a pas d\'autres photos dans cette catégorie.</p>';
            }


            ?>
    </div>
</div>

<div class="button-container">
     <a href="<?php echo home_url('/'); ?>">
        <button class="button all-pics-button">Toutes les photos</button>
    </a>
</div>

<?php get_template_part( 'template_parts/lightbox' ); ?>

<?php get_footer(); ?>

