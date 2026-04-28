<?php
/**
 * Default page template.
 *
 * @package PGroupChild
 */

get_header();
?>
<main class="pgroup-section">
    <div class="pgroup-container">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
                <div class="pgroup-content"><?php the_content(); ?></div>
            </article>
        <?php endwhile; ?>
    </div>
</main>
<?php get_footer(); ?>
