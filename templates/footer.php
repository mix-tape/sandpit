<footer class="main">
  <?php dynamic_sidebar('sidebar-footer'); ?>
  <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/jquery-1.12.4.min.js"><\/script>')</script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/global.min.js"></script>

<?php if(WP_DEBUG): ?>
<!-- Grunt liverelaod -->
<script src="//localhost:35729/livereload.js"></script>
<?php endif; ?>

<?php wp_footer(); ?>
