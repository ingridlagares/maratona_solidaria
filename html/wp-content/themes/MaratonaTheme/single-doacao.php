<?php get_header(); ?>
<div class="primary">
    <div id="content" role="main">
    <?php while ( have_posts() ) : the_post();?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php $meta = get_post_meta( $post->ID, 'doacao_fields', true ); ?>
            <header class="entry-header">
                <strong>Título: </strong><?php the_title(); ?>
                <br/>
                <strong>Doação: </strong>
                <div><?php echo $meta['doacao']  ?></div>
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
                <strong>aprovado: </strong>
                <?php echo esc_html( $meta['aprovado'] ); ?>
                <br/>
            </header>
        </article>
    <?php endwhile; ?>
    </div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
