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
	<div class=".primary-mobile-nav primary">
		<div class="col-sm-8 blog-main">
            <!-- New Post Form -->
            <div id="postbox">
            <form id="new_post" name="new_post" method="post" action="">

            <!-- post name -->

            <input type="hidden" name="aluno_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

            <table>
                <tr>
                    <td class="title">Nome completo</td>
                <td><input type="text" name="title" id="title" value=""></td>
                </tr>
                <tr>
                    <td class="title">Matrícula</td>
                <td ><input type="number" min="0" name="aluno_fields[matricula]" value=""></td>
                </tr>
                    <td class="title">Curso</td>
                        <td><select name="aluno_fields[equipe]" id="aluno_fields[equipe]" style="width: 500px;">
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
                    <td class="title">Email</td>
                <td><input type="text" name="aluno_fields[email]" value=""></td>
                </tr>
                        <tr>
                    <td class="title">Telefone</td>
                <td><input type="number" name="aluno_fields[telefone]" value=""></td>
                </tr>
                <tr>
                    <td class="title">Observação</td>
                <td><textarea style="width: 500px;" name="aluno_fields[observacao]" value="">
                </textarea></td>
                </tr>
            </table>


            <p align="right"><input type="submit" value="Publish" tabindex="6" id="submit" name="submit" /></p>

            <input type="hidden" name="action" value="new_aluno" />
            <?php wp_nonce_field( 'new-aluno' ); ?>
            </form>
            </div>
		</div> <!-- /.blog-main -->
	</div> <!-- /.row -->
<?php get_footer(); ?>
