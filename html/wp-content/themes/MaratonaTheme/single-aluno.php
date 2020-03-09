<?php get_header(); ?>
<div class="container">
<div class="primary">
    <div class="col-sm-12 blog-main">
    <div id="content" role="main">
        <div id="postbox">
    <?php while ( have_posts() ) : the_post();?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php $meta = get_post_meta( $post->ID, 'aluno_fields', true );
    $aluno_id = $post->ID;
    ?>
            <header class="entry-header">
                <strong>Nome: </strong><?php the_title(); ?>
                <br/>
                <strong>matricula: </strong><?php echo $meta['matricula']  ?>
                <br/>
                <strong>equipe: </strong>
                <?php echo esc_html( $meta['equipe'] ); ?>
                <br/>
                <strong>email: </strong>
                <?php echo esc_html( $meta['email'] ); ?>
                <br/>
                <strong>telefone: </strong>
                <?php echo esc_html( $meta['telefone'] ); ?>
                <br/>
                <strong>observacao: </strong>
                <?php echo esc_html( $meta['observacao'] ); ?>
                <br/>
            </header>
        </article>
    <?php endwhile; ?>
        <h2 class="center">Doações do aluno</h2>

        <?php
        $args = array(
            'numberposts'	=> -1,
            'post_type'		=> 'doacao',
            'meta_key'		=>  $meta['quantidade'],
	        'meta_value_num'	=> '1',
        );
        $the_query = new WP_Query( $args );
        ?>
        <?php if( $the_query->have_posts() ): ?>
            <ul class="listing">
            <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php $meta = get_post_meta( $post->ID, 'doacao_fields', true ); ?>
                <?php if(  $meta['representante'] == $aluno_id ): ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                    <p>
                        Doação: <?php echo esc_html( $meta['doacao'] ); ?>
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
            <?php endif; ?>

            <?php endwhile; ?>
            </ul>
        <?php endif;?>
        </div>
    </div>
</div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
