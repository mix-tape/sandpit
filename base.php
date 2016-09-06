<?php
// ==========================================================================
//
//   Base layout
//
// ==========================================================================

get_template_part('templates/head'); ?>

<body <?php body_class(); ?>>

<?php get_template_part('templates/header');?>

<?php include roots_template_path(); ?>

<?php get_template_part('templates/footer'); ?>

<?php wp_footer(); ?>

</body>
</html>
