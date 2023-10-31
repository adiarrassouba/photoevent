<!-- // Récupérer la référence de l'article -->
<?php

// Récupération de la catégorie de l'article
$categories = get_terms(array(
    'taxonomy' => 'categories',
    'hide_empty' => false,
));

?>



<div class="gallery-pic resize-pic">
		 
    <div class="gallery-img"> 
        <p class="gallery-id"><?php echo get_the_ID(); ?></p>    
        <img class="img-full" id="img-full" style="height:500px; width:500px" src="<?php echo get_field('url-photo'); ?>" />

        <div class="gallery-icons-hover">
            <a href="#">
                <img class="icon-full"
                    src="<?php echo get_template_directory_uri(); ?>./photos/Icon_fullscreen.png"
                    alt="Icône plein écran" />
            </a>
            
            <a href="<?php echo get_post_permalink(); ?>">
                <img class="icon-eye" src="<?php echo get_template_directory_uri(); ?>./photos/Icon_eye.png"
                    alt="Icône oeil">
            </a>

            <div>
              <p class="gallery-titre"><?php echo the_title(); ?></p>
                <p class="gallery-reference"><?php echo get_field('référence');?></p>
                <p class="gallery-category"><?php echo the_terms(get_the_ID(), 'categorie', false); ?></p>
                
            </div>
        </div>


    </div>
</div>


