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

  <?php if ( get_option('googletagmanager')) { ?>

  <!-- Google Tag Manager -->
  <noscript><iframe src="//www.googletagmanager.com/ns.html?id=<?php echo get_option('googletagmanager'); ?>"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','<?php echo get_option('googletagmanager'); ?>');</script>
  <!-- End Google Tag Manager -->

  <?php } ?>

</body>
</html>
