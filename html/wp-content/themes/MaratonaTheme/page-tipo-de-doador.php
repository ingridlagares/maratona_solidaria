<?php get_header(); ?>
<div class="primary">
    <div id="content" role="main">
         <a href="/adicionar-doacao" ><button type="button" class="block-button">Aluno doador possui cadastro</button></a></br>
         <a href="/adicionar-aluno" ><button type="button" class="block-button">Aluno doador não possui cadastro </button></a></br>
         <a href="/adicionar-doador-externo" ><button type="button" class="block-button">Doador externo e representante possui cadastro</button></a></br>
    </div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
<script>
function myFunction() {
  document.getElementById("demo").innerHTML = "Hello World";
}
</script>
