<?php get_header(); ?>
<div class="container-main  centralize">
<div class="primary primary-mobile-nav ">
		<div class="blog-main col-sm-12">
			<div id="postbox">
			<?php if (have_posts()): ?>
                        <?php while ( have_posts() ):the_post(); ?>
                        <?php
			  get_template_part('content',get_post_format());
			?>
			<?php the_content(); ?>
			<?php endwhile; ?>


                       <?php endif; ?>
			</div>
	</div> <!-- /.row -->
</div> <!-- /.row -->
<?php get_footer(); ?>
