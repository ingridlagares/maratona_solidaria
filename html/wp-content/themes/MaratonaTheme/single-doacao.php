<?php get_header(); ?>
<div class="container">
<div class="primary">


    <div class="col-sm-8 blog-main">
    <div id="content" role="main">
        <div id="postbox">
    <?php while ( have_posts() ) : the_post();?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php $meta = get_post_meta( $post->ID, 'doacao_fields', true ); ?>
                <strong>Título: </strong><?php the_title(); ?>
                <br/>
                <strong>Doação: </strong><?php echo $meta['doacao'] ; ?>
                <br/>
                <strong>equipe: </strong>
                <?php echo esc_html( $meta['equipe'] ); ?>
                <br/>
                <strong>representante: </strong>
                <?php echo get_the_title( $meta['representante'] ); ?>

                <br/>
                <strong>quantidade: </strong>
                <?php echo esc_html( $meta['quantidade'] ); ?>
                <br/>
                <strong>data: </strong>
                <?php echo esc_html( $meta['data'] ); ?>
                <br/>
                <strong>Aprovado: </strong>
                <?php
                 if($meta['aprovado'] == 'on'):
                     echo "sim";
                 else:
                     echo "não";
                 endif;
                 ?>
                <br/>
        </article>
    <?php endwhile; ?>
        </div>
    </div>
    </div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
