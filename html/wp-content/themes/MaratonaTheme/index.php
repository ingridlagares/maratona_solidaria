<?php get_header(); ?>
	<div class="container">
		<div class="col-sm-8 blog-main">
			<?php if (have_posts()): ?>
                        <?php while ( have_posts() ):the_post(); ?>
                        <?php
			  get_template_part('content',get_post_format());
			?>
			<?php endwhile; ?>


                       <?php endif; ?>
		</div> <!-- /.blog-main -->
	</div> <!-- /.row -->
<?php get_footer(); ?>
