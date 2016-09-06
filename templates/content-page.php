
  <section class="page">

    <div class="container">

      <?php while (have_posts()) : the_post(); ?>

        <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

          <div class="page_content">

            <h1><?php the_title(); ?></h1>

            <?php the_content(); ?>

          </div>

        </article>

      <?php endwhile; ?>

    </div>

  </section>
