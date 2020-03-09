<?php get_header(); ?>
<div class="container">
<div class="primary">
    <div id="content" role="main">
        <h2 class="center">Doações da sua equipe</h2>
        <?php

        // args
        $args = array(
        	'numberposts'	=> -1,
        	'post_type'		=> 'doacao',
            'author'        => $user_ID,
        );


        // query
        $the_query = new WP_Query( $args );
        calcular_pontuacao( wp_get_current_user());
        ?>
        <?php if( $the_query->have_posts() ): ?>
        	<ul class="listing">
        	<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php $meta = get_post_meta( $post->ID, 'doacao_fields', true ); ?>

        		<li>
        			<a href="<?php the_permalink(); ?>">
        				<?php the_title(); ?>
        			</a>
                    <p>
                        Representante: <?php echo get_the_title( $meta['representante'] ); ?>
                        | Quantidade: <?php echo esc_html( $meta['quantidade'] ); ?>
                        | Aprovado:
                        <?php
                         if($meta['aprovado'] == 'on'):
                             echo "sim";
                         else:
                             echo "não";
                         endif;
                         ?>
                        | Data: <?php echo esc_html( $meta['data'] ); ?>
                    </p>
        		</li>
        	<?php endwhile; ?>
        	</ul>
        <?php endif; ?>


        <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>
    </div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
