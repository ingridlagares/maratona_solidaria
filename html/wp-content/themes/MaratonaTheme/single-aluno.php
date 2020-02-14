<?php get_header(); ?>
<div id="primary">
    <div id="content" role="main">
    <?php while ( have_posts() ) : the_post();?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php $meta = get_post_meta( $post->ID, 'aluno_fields', true ); ?>
            <header class="entry-header">
                <strong>Nome: </strong><?php the_title(); ?>
                <br/>
                <strong>matricula: </strong>
                <div><?php echo $meta['matricula']  ?></div>
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
    </div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
