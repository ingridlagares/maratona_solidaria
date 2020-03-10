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
        list ($equipe["pt_total"], $equipe["tam"], $equipe["pt_final"],$equipe["equipe"])  = calcular_pontuacao( wp_get_current_user() );
        ?>
        <h3><?php echo $equipe["equipe"];?></h3>
        <p>Pontuação total da sua equipe: <?php echo $equipe["pt_total"];?></p>
        <p>Quantidade de membros: <?php  echo $equipe["tam"]; ?></p>
        <p>Pontuação final: <?php  echo $equipe["pt_final"];?></p>
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
