  <header class="main">

    <div class="container">

      <a class="brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>

      <nav class="primary-navigation">

        <?php if (has_nav_menu('primary')) wp_nav_menu(array('theme_location' => 'primary_navigation')); ?>

      </nav>

    </div>

  </header>
