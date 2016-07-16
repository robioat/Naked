<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package naked
 */



get_header();
include(locate_template('global-templates/page-borders.php')); 
include(locate_template('global-templates/header-nav.php'));
?>
<div class="body-main-content">
<?php get_template_part( 'content', 'page' ); ?>
</div>
<?php get_footer(); ?>
