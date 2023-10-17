<!-- // Récupérer la référence de l'article -->
<?php
$article_reference = get_field('reference');

// Récupération de la catégorie de l'article
$categories = get_terms(array(
    'taxonomy' => 'categories',
    'hide_empty' => false,
));

?>



<div class="gallery-pic resize-pic">
		 
<div class="gallery-img">     
     <img class="" style="height:500px; width:500px" src="<?php echo get_field('url-photo'); ?>" />

     <div class="gallery-icons-hover">
           
            
            <a href="<?php echo get_post_permalink(); ?>">
                <img class="icon-eye" src="<?php echo get_template_directory_uri(); ?>./photos/Icon_eye.png"
                    alt="Icône oeil">
            </a>

            <div class="gallery-data" data-year=<?php $post_date = get_the_date('Y');
                echo $post_date; ?>>
                <p class="gallery-reference"><?php echo $article_reference;?></p>
                <p class="gallery-category"><?php echo the_terms(get_the_ID(), 'categorie', false); ?></p>
            </div>
        </div>


</div>
</div>


