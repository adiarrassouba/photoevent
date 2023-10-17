<?php
/**
 * The template : page d'accueil
 *
 *
 *
 * 
 */
?>


<div class="hero">
    <h1 class="site-title"> Photographe event  </h1>

    <div class="slider">
        <?php 
        // Affichage d'une image aléatoire à partir des articles de type "photo"
		$homePicture = new WP_Query(array(
			'post_type' => 'photo',
			'orderby' => 'rand',
			'posts_per_page' => 1,
			'paged' => $paged,
			'tax_query' => array(
				array(
					'taxonomy' => 'format',
					'field' => 'slug',
					'terms' => 'paysage',
				),
			),
		
		));
        ?>
        <?php 
        if ($homePicture->have_posts()) :
            while ($homePicture->have_posts()) :
                $homePicture->the_post(); 
                ?>
        <img src="<?php echo get_field('url-photo'); ?>" alt="<?php the_title_attribute(); ?>">
        <?php
            endwhile;
        endif; 
        ?>
    </div>
</div>

<section class="gallery-home">

    <div class="filters-container">
        <!-- Fonction pour récupéter et afficher les catégories -->

        <?php function showCategories($taxonomy)
        {
            if ($terms = get_terms(array(
                'taxonomy' => $taxonomy,
                'orderby' => 'name'
            ))) {
                foreach ($terms as $term) {
                    echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                }
            }
        }

        ?>

        <div class="category-format-filters">

            <!-- Filter Categories -->

            <div class="categories-filter">
                <form class="filter-column">
                    <select id="categories">
                        <option value="all">CATÉGORIES</option>
                        <?php
                        $categories = get_terms(array(
                            "taxonomy" => "categorie", // as in CPT UI
                            "hide_empty" => false,
                        ));
                        foreach ($categories as $categorie) {
                            echo '<option value="' . $categorie->slug . '">' . mb_convert_case($categorie->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                        }
                        ?>
                    </select>
                </form>
            </div>

            <!-- Filter Formats -->

            <div class="formats-filter">
                <form class="filter-column">
                    <select id="formats">
                        <option value="all">FORMATS</option>
                        <?php
                        $formats = get_terms(array(
                            "taxonomy" => "format", // as in CPT UI
                            "hide_empty" => false,
                        ));
                        foreach ($formats as $format) {
                            echo '<option value="' . $format->slug . '">' . mb_convert_case($format->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                        }
                        ?>
                    </select>
                </form>

            </div>

        </div>

        <!-- Filter Sort By Date -->

        <div class="sort-by-date-filter">
            <form class="filter-column">
                <select id="sort-by-date">
                    <option value="all">TRIER PAR</option>
                    <option value="DESC">Les Plus Récentes</option>
                    <option value="ASC">Les Plus Anciennes</option>
                </select>
            </form>
        </div>
    </div>




<!-- images gallerie  -->

 <div class="gallery-container">
        <?php 
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $gallery = new WP_Query(array(
            'post_type' => 'photo',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 12,
            'paged' => $paged,
        ));

        show_gallery($gallery, false);
    ?>
    </div> 
     
     <!-- PAGINATION-->

    <div class="button-container-home">
        <a id="load-more" data-current-index="1" href="#!"><button class="button">Charger plus</button></a>
    </div>
 </section>