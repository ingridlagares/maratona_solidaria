<?php get_header(); ?>
<style>
    tr {
        width: 1600px;
    }
    td {
        width: 70%;
    }
    select {
        width: 150px;
    }
    input[type="date"] {
        width: 150px;
    }
    input[type="button"] {
        width: 150px;
    }
    input[type="text"] {
        width: 600px;
    }
    .title {
        width: 50px;
    }
</style>
	<div class="primary primary-mobile-nav">
            <!-- New Post Form -->
            <div id="postbox" >
            <form id="new_post" name="new_post" method="post" action="">

            <!-- post name -->

            <input type="hidden" name="aluno_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

            <table>
                <h2 class="title-content">Adicionar doação</h2>

                <tr>
                    <td class="title">Doação</td>
                <td><input type="text" name="title" id="title" value=""></td>
                </tr>
                <tr>
            <td class="title">Tipo</td>
                <td><select name="doacao_fields[doacao]" id="doacao_fields[doacao]" style="width: 500px;">
                    <option value="absorvente">Absorvente (a cada 8 unidades)</option>
                    <option value="acucar">Açucar ( a cada 1 kg)</option>
                    <option value="apostila">Apostila</option>
                    <option value="arroz" >Arroz ( a cada 1 kg )</option>
                    <option value="biscoito">Biscoito</option>
                    <option value="brinquedo">Brinquedo</option>
                    <option value="caderno">Caderno</option>
                    <option value="cafe">Café ( a cada 500g )</option>
                    <option value="sangue">Doação de sangue</option>
                    <option value="escova">Escova de dente</option>
                    <option value="farinha">Farinha  ( a cada 1kg )</option>
                    <option value="fuba">Fubá  ( a cada 1kg )</option>
                    <option value="feijao">Feijão ( a cada 1 kg)</option>
                    <option value="fralda_geriatrica">Fralda geriátrica (a cada 8 unidades )</option>
                    <option value="fralda_infantil">Fralda infantils</option>
                    <option value="lacre">Garrafa pet com lacres</option>
                    <option value="escola">Kit escola (um lápis, uma caneta, uma borracha e um apontador)</option>
                    <option value="oleo">Lata de óleo ( a cada 1L )</option>
                    <option value="livro">Livro</option>
                    <option value="macarrao">Macarrão</option>
                    <option value="medula">Medula (cadastro)</option>
                    <option value="papel">Papel higiênico (12 unidades)</option>
                    <option value="pasta">Pasta dental</option>
                    <option value="racao">Ração para cães e gatos ( a cada 5kg)</option>
                    <option value="sabonete">Sabonete ( a cada 6 unidades)</option>
                    <option value="sal">Sal ( a cada 1kg)</option>
                    <option value="xampu">Xampu ( a cada 500ml)</option>
                    <option value="condicionador">Condicionador ( a cada 500ml)</option>


                </select></td>
    	        <tr>
            <td class="title">Equipe</td>
                <td><select name="doacao_fields[equipe]" id="doacao_fields[equipe]" style="width: 500px;">
                    <option value="estatistica">Estatística</option>
                    <option value="fisica">Física</option>
                    <option value="matcomp">Matemática Computacional</option>
                    <option value="mat">Matemática</option>
                    <option value="atuariais"> Ciências Atuariais</option>
                    <option value="quimica">Química</option>
                    <option value="ccsi">CC/SI</option>


                </select></td>
        </tr>
        <tr>
            <td class="title">Quantidade</td>
        <td ><input type="number" min="1" name="doacao_fields[quantidade]" value=""></td>
        </tr>

        <tr>
            <td class="title">Representante (Aluno)</td>
                <td><select name="doacao_fields[representante]" id="doacao_fields[representante]" style="width: 500px;">
             <?php
             $args = array('post_type' => 'aluno');
			 $myQuery = new WP_Query($args);
             if ($myQuery->have_posts()) :
             	while ($myQuery->have_posts()) : $myQuery->the_post();
                $post_id = get_the_ID();
                    ?>
                    <option value="<?php the_ID();?>" <?php if (is_array($meta) && isset($meta['representante'])) { selected( $meta['representante'], '<?php the_ID();?>' ); } ?>><?php the_title();?></option>
                    <?php
             	endwhile; wp_reset_postdata();
             endif;
             ?>
             </select></td>
        </tr>
                <tr>
            <td class="title">Data</td>
        <td><input type="date" name="doacao_fields[data]" value=""></td>
        </tr>
        <tr>
            <td class="title">Observação</td>
        <td><textarea style="width: 500px;" name="doacao_fields[observacao]" value="">
        </textarea></td>
        </tr>
    </table>


            <p align="center"><input type="submit"  value="Submeter" tabindex="6" id="submit" name="submit" /></p>

            <input type="hidden" name="action" value="new_doacao" />
            <?php wp_nonce_field( 'new-doacao' ); ?>
            </form>
            </div>
	</div> <!-- /.row -->
<?php get_footer(); ?>
